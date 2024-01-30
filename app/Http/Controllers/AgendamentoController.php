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
                    ->orWhere('funcionario_id', 'like', '%' . $filter . '%')
                    ->orWhere('clientes_id', 'like', '%' . $filter . '%')
                    ->orWhere('email', 'like', '%' . $filter . '%');
            });
        }
        $result = $query->with('cliente', 'situacao', 'formaPagamento', 'funcionario', 'agendamentoItens', 'agendamentoItens.funcionario', 'agendamentoItens.servico')->orderBy('id', 'desc')->paginate();


        return response()->json($result->load('cliente', 'situacao', 'formaPagamento', 'funcionario'), 200);
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
                'funcionarios_id' => $item['funcionarios_id'],
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
            'email' => 'required|email',
            'telefone' => 'required',
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
                        'funcionarios_id' => $item['funcionarios_id'],
                        'quantidade' => $item['quantidade'] ?? 1,
                        'valor' => $item['valor'] ?? Servicos::query()->find($item['servicos_id'])->valor,
                        'agendamento_id' => $agendamento->id,
                    ]);
                }
                $itens = AgendamentoItem::where('agendamento_id', $agendamento->id)
                    ->with('agendamento', 'funcionario', 'servico')
                    ->get();
            }

        }
        return response()->json([
            "erro" => false,
            "mensagem" => "Agendamento cadastrado com sucesso!",
            'id' => $agendamento->id,
            'itens' => $itens,
            'agendamento' => $agendamento->load('cliente', 'situacao', 'formaPagamento')
        ], 200);
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
            ->with('cliente', 'situacao', 'formaPagamento', 'funcionario')
            ->firstOrFail();

        $itens = AgendamentoItem::where('agendamento_id', $agendamento->id)
            ->with('funcionario', 'servico')
            ->get();

        return response()->json([
            'agendamento' => $agendamento,
            'itens' => $itens
        ], 200);
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
            'email' => 'required|email',
            'telefone' => 'required',
            'data_agendamento' => 'required',
            'forma_pagamento_id' => 'required',

        ]);

        $agendamento = Agendamento::find($id);

        if (!$agendamento) {
            return [
                "erro" => true,
                "mensagem" => "Agendamento não encontrado!"
            ];
        }
        if($agendamento){
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
                            'funcionarios_id' => $item['funcionarios_id'],
                            'quantidade' => $item['quantidade'],
                            'valor' => $item['valor'],
                            'agendamento_id' => $agendamento->id,
                        ]);
                    }
                }

                $itens = AgendamentoItem::where('agendamento_id', $agendamento->id)
                    ->with('agendamento', 'funcionario', 'servico')
                    ->get();
            }

        }
        $agendamento->update($request->all());

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

        $proprietario = Usuarios::where('id', $user_id)->first();
        $empresa = Empresas::where('id',$proprietario->empresa_id)->first();
        $carbonDate = Carbon::parse($data);
        $diaSemana = $carbonDate->format('l');
        $diaSemana = $this->getDiaSemana(strtolower($diaSemana));
        $horarioInicio = new DateTime($empresa->{$diaSemana. '_horario_inicio'});
        $horarioFim = new DateTime($empresa->{$diaSemana. '_horario_fim'});
        $ultimo_horario = $horarioInicio;
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
        $agenda_atual_funcionario = OrdemServicos::where("id_funcionario", $funcionario_id)
            ->where("user_id", $user_id)
            ->whereDate('inicio_os', '=', $data)
            ->orderBy("inicio_os", "asc")
            ->get();
        $horaInicial = DateTime::createFromFormat('H:i:s', $tempoTotal->tempo_total);
        $intervalo = $horaInicial->diff(new DateTime('00:00:00'));
        $representacaoFormatada = 'PT' . $intervalo->format('%H') . 'H' . $intervalo->format('%I') . 'M';
        $horasASomar = new DateInterval($representacaoFormatada);
        $mediador = $ultimo_horario->format('H:i:s');
        if(isset($agenda_atual_funcionario) && !empty($agenda_atual_funcionario)){
            logger("Aqui");
            foreach ($agenda_atual_funcionario as $agenda){
                $horario = date("H:i", strtotime($agenda->inicio_os));
                $horarios[] = ["horario" => $horario, "disponivel" => 0];
            }
            while ($ultimo_horario < $horarioFim) {
                $ultimo_horario->add($horasASomar);
                $verificadorUm = date("Y-m-d H:i:s", strtotime($data." ".$mediador));
                $verificadorDois = date("Y-m-d H:i:s", strtotime($data." ".$ultimo_horario->format("H:i:s")));
                $ordensServicoExists = OrdemServicos::where('user_id', $user_id)
                    ->where('id_funcionario', $funcionario_id)
                    ->whereBetween('inicio_os', [$verificadorUm, $verificadorDois])
                    ->exists();
                if(!$ordensServicoExists ){
                    $horarios[] = ["horario" => $ultimo_horario->format('H:i'), "disponivel" => 1];
                }
                $mediador = $ultimo_horario->format("H:i:s");
            }
            ksort($horarios);
        }
        else{

            while ($ultimo_horario < $horarioFim) {
                $horarios[] = ["horario" => $ultimo_horario->format('H:i'), "disponivel" => 1];
                $ultimo_horario->add($horasASomar);
            }
        }
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
