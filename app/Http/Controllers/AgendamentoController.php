<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use App\Models\AgendamentoItem;
use App\Models\Empresas;
use App\Models\OrdemServicos;
use App\Models\Servicos;
use App\Models\User;
use App\Models\Usuarios;
use Carbon\Carbon;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AgendamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  string|null  $filter
     * @return \Illuminate\Http\Response
     */
    public function getAll($id, $filter = null)
    {
        $user = Auth::user();
        $query = Agendamento::where('user_id', $id);

        if ($filter) {
            $query->where(function ($q) use ($filter) {
                $q->where('nome', 'like', '%' . $filter . '%')
                    ->orWhere('telefone', 'like', '%' . $filter . '%')
                    ->orWhere('data_agendamento', 'like', '%' . $filter . '%')
                    ->orWhere('clientes_id', 'like', '%' . $filter . '%')
                    ->orWhere('email', 'like', '%' . $filter . '%');
                $q->orWhereHas('funcionario', function ($query) use ($filter) {
                    $query->where('funcionario_id', 'like', '%' . $filter . '%')
                        ->orWhere('nome', 'like', '%' . $filter . '%');
                });
            });
        }
        $result = $query->with('cliente', 'situacao', 'formaPagamento', 'funcionario', 'agendamentoItens', 'agendamentoItens.servico')->orderBy('id', 'desc')->get();


        return response()->json($result, 200);
    }
    public function adicionarItens(Request $request, $agendamentoId)
    {
        $user = Auth::user();
        $agendamento = Agendamento::find($agendamentoId);

        if (!$agendamento) {
            return response()->json(["erro" => true, "mensagem" => "Agendamento não encontrado!"], 404);
        }

        // Obter os itens do request
        $itens = $request->input('itens');
        if (!$itens || !is_array($itens)) {
            return response()->json(["erro" => true, "mensagem" => "Itens não fornecidos ou no formato incorreto!"], 400);
        }

        // Criar os itens de agendamento
        foreach ($itens as $item) {
            AgendamentoItem::create([
                'servicos_id' => $item['servicos_id'],
                'funcionarios_id' => $item['funcionarios_id'] ?? 0,
                'agendamento_id' => $agendamento->id,
            ]);
        }

        // Carregar os relacionamentos após a criação dos itens
        $itens = AgendamentoItem::where('agendamento_id', $agendamento->id)
            ->with('agendamento', 'funcionario', 'servico')
            ->get();

        return response()->json(["erro" => false, "mensagem" => "Itens de agendamento adicionados com sucesso!", 'itens' => $itens], 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nome' => 'required',
            'data_agendamento' => 'required',
            'forma_pagamento_id' => 'required',
        ]);

        $agendamento = Agendamento::create($request->all());

        if($agendamento){
            $itens = $request->input('itens');
            if($itens){
                if (!$itens || !is_array($itens)) {
                    return response()->json(["erro" => true, "mensagem" => "Itens não fornecidos ou no formato incorreto!"], 400);
                }
                foreach ($itens as $item) {
                    AgendamentoItem::create([
                        'servicos_id' => $item['servicos_id'],
                        'funcionarios_id' => $item['funcionarios_id'] ?? 0,
                        'quantidade' => $item['quantidade'] ?? 1,
                        'valor' => $item['valor'] ?? Servicos::query()->find($item['servicos_id'])->valor,
                        'agendamento_id' => $agendamento->id,
                    ]);
                }
                $itens = AgendamentoItem::where('agendamento_id', $agendamento->id)
                    ->with('agendamento', 'funcionario', 'servico')
                    ->get();
            }
            return response()->json([
                "erro" => false,
                "mensagem" => "Agendamento cadastrado com sucesso!",
                'id' => $agendamento->id
            ], 200);
        }
        return response()->json([
            "erro" => true,
            "mensagem" => "Error",
        ], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agendamento  $agendamento
     * @return \Illuminate\Http\Response
     */
    public function show($id, $agendamentoId)
    {
        $agendamento = Agendamento::where('id', $agendamentoId)
            ->where('user_id', $id)
            ->with('cliente', 'situacao', 'formaPagamento', 'funcionario', 'agendamentoItens', 'agendamentoItens.servico')->orderBy('id', 'desc')
            ->first();

        return response()->json($agendamento, 200);
    }


    public function updateStatusAgendamento(Agendamento $agendamento, $situacao_id){
        $agendamento->update(['situacao_id' => $situacao_id]);

        return response()->json($agendamento, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required',
            'data_agendamento' => 'required',
            'forma_pagamento_id' => 'required',
        ]);

        $agendamento = Agendamento::find($id);
        if (!$agendamento) {
            return response()->json(["erro" => true, "mensagem" => "não encontrado!"], 404);
        }
        $agendamento->update($request->all());

        $itens = $request->input('itens');
        if($itens){
            if (!$itens || !is_array($itens)) {
                return response()->json(["erro" => true, "mensagem" => "Itens não fornecidos ou no formato incorreto!"], 400);
            }
            else{
                AgendamentoItem::where("agendamento_id",$agendamento->id )->delete();
                foreach ($itens as $item) {
                    AgendamentoItem::create([
                        'servicos_id' => $item['servicos_id'],
                        'funcionarios_id' =>$item['funcionarios_id'] ?? 0,
                        'quantidade' => $item['quantidade'],
                        'valor' => $item['valor'],
                        'agendamento_id' => $agendamento->id,
                    ]);
                }
            }
        }

        return [
            "erro" => false,
            'agendamento' => $agendamento->load('cliente', 'situacao', 'formaPagamento'),
            "mensagem" => "Agendamento editado com sucesso!"
        ];
    }
    public function getDiaSemana($dia){
        $diasDaSemana = [
            'sunday' => 'domingo',
            'monday' => 'segunda',
            'tuesday' => 'terca',
            'wednesday' => 'quarta',
            'thursday' => 'quinta',
            'friday' => 'sexta',
            'saturday' => 'sabado',
        ];
        return $diasDaSemana[$dia];
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agendamento  $agendamento
     * @return \Illuminate\Http\Response
     */
    public function getHorariosDisponiveis(Request $request, $user_id, $funcionario_id, $data)
    {
        $quantidade = $request->input('quantidade') ?? 1;
        $proprietario = Usuarios::where('id', $user_id)->first();
        $empresa = Empresas::where('id',$proprietario->empresa_id)->first();
        $carbonDate = Carbon::parse($data);
        $diaSemana = $carbonDate->format('l');
        $diaSemana = $this->getDiaSemana(strtolower($diaSemana));
        $horarioInicio = $empresa->{$diaSemana. '_horario_inicio'};
        $horarioFim = $empresa->{$diaSemana. '_horario_fim'};
        $ultimo_horario = $horarioFim;
        if(!$empresa->{$diaSemana}){
            return response()->json(['error' => true, 'message' => "Estabelecimento Fechado"]);
        }
        if(!$horarioInicio or !$horarioFim){
            return response()->json(['error' => true, 'message' => "Estabelecimento não informou horário de funcionamento."]);
        }
        $idsServicos = $request->input('servicos');
        $tempoTotal = DB::table('servicos')
            ->whereIn('id', $idsServicos)
            ->select(DB::raw('SEC_TO_TIME(SUM(TIME_TO_SEC(tempo_estimado))) as tempo_total'))
            ->first();

        $horarios = [];
        $agenda_atual_funcionario = Agendamento::where("funcionario_id", $funcionario_id)
            ->where("user_id", $user_id)
            ->whereDate('data_agendamento', '=', $data)
            ->orderBy("hora_agendamento", "asc")
            ->get();

        $horasASomar = Carbon::createFromFormat('H:i:s', $tempoTotal->tempo_total);
        $horasASomar->addHours($horasASomar->hour * ($quantidade - 1));
        $horasASomar->addMinutes($horasASomar->minute * ($quantidade - 1));
        $horasASomar->addSeconds($horasASomar->second * ($quantidade - 1));
        if(isset($agenda_atual_funcionario) && !$agenda_atual_funcionario->isEmpty()){
            foreach ($agenda_atual_funcionario as $agenda){
                $horario = date("H:i", strtotime($agenda->hora_agendamento));
                $horarios[] = ["horario" => $horario, "disponivel" => 0];
                $horarioFim = $agenda->hora_agendamento;
            }
            $horarioFim = Carbon::createFromFormat('H:i:s', $horarioFim);
            while ($horarioFim->lessThan($ultimo_horario)) {
                $agendamentoExists = Agendamento::where('user_id', $user_id)
                    ->where('funcionario_id', $funcionario_id)
                    ->where('hora_agendamento', $horarioFim->format("H:i:s"))
                    ->exists();

                if (!$agendamentoExists) {
                    $horarios[] = ["horario" => $horarioFim->format('H:i'), "disponivel" => 1];
                }
                $horarioFim->addHours($horasASomar->hour);
                $horarioFim->addMinutes($horasASomar->minute);
                $horarioFim->addSeconds($horasASomar->second);
            }
        }
        else{
            $horarioFim = Carbon::createFromFormat('H:i:s', $horarioFim);
            while ($horarioFim->lessThan($ultimo_horario)) {
                $horarios[] = ["horario" => $ultimo_horario->format('H:i'), "disponivel" => 1];
                $horarioFim->addHours($horasASomar->hour);
                $horarioFim->addMinutes($horasASomar->minute);
                $horarioFim->addSeconds($horasASomar->second);
            }
        }
        ksort($horarios);
        return $horarios;
    }
    public function compararHorarios($a, $b) {
        return strtotime($a) - strtotime($b);
    }
    public function destroy(Agendamento $agendamento)
    {
        $agendamento->delete();

        return [
            "erro" => false,
            "mensagem" => "Agendamento apagado com sucesso!"
        ];
    }
}
