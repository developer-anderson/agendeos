<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use App\Models\AgendamentoItem;
use App\Models\Clientes;
use App\Models\Empresas;
use App\Models\FormaPagamento;
use App\Models\OrdemServicos;
use App\Models\Servicos;
use App\Models\Situacao;
use App\Models\token;
use App\Models\User;
use App\Models\Usuarios;
use App\Models\whatsapp;
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
        $post = $request->all();
        if(isset($post["validar"])){
            $cliente = Clientes::where('email_f', $post['email'])->first();
            if($cliente and !empty($post['email'])){
                $post["clientes_id"] = $cliente->id;
            }
            else{
                $cliente = Clientes::create(["nome_f" => $post["nome"], "email_f" =>$post["email"], "telefone_f" =>$post["telefone"], "celular_f" =>$post["telefone"], "user_id" => $post["user_id"] ]);
                $post["clientes_id"] = $cliente->id;
            }
        }

        $agendamento = Agendamento::create($post);

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
                        'quantidade' => isset($item['quantidade']) ? $item['quantidade'] : 1,
                        'valor' => isset($item['valor']) ? $item['valor'] : Servicos::query()->find($item['servicos_id'])->valor,
                        'agendamento_id' => $agendamento->id,
                    ]);
                }
                $itens = AgendamentoItem::where('agendamento_id', $agendamento->id)
                    ->with('agendamento', 'funcionario', 'servico')
                    ->get();
            }
            $administrador  = User::where('id', $agendamento->user_id)->first();
            $estabelecimento  =  Empresas::where('situacao', 1)->where('id', $administrador->empresa_id)->first();


            return response()->json([
                "erro" => false,
                "mensagem" => "Agendamento cadastrado com sucesso!",
                "zap" => $this->notifyClient($agendamento->id),
                "zap_adm" => $this->notifyClient($agendamento->id, $estabelecimento->telefone),
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
        $dadosServicos = $request->input('servicos'); // Obtém os dados dos serviços do request
        $idsServicos = []; // Inicializa um array para armazenar os IDs dos serviços

// Verifica se os dados dos serviços foram fornecidos e se é um array
        if ($dadosServicos && is_array($dadosServicos)) {
            // Itera sobre cada serviço
            foreach ($dadosServicos as $servico) {
                // Verifica se o serviço contém a chave 'id' e se é um número
                if (isset($servico['id']) && is_numeric($servico['id'])) {
                    // Adiciona o ID do serviço ao array de IDs
                    $idsServicos[] = $servico['id'];
                }
            }
        }
        $tempoTotal = DB::table('servicos')
            ->whereIn('id', $idsServicos)
            ->select(DB::raw('SEC_TO_TIME(SUM(TIME_TO_SEC(tempo_estimado))) as tempo_total'))
            ->first();

        $horarios = [];


        $horasASomar = Carbon::createFromFormat('H:i:s', $tempoTotal->tempo_total);
        $horasASomar->addHours($horasASomar->hour * ($quantidade - 1));
        $horasASomar->addMinutes($horasASomar->minute * ($quantidade - 1));
        $horasASomar->addSeconds($horasASomar->second * ($quantidade - 1));

        $horarioInicio = Carbon::createFromFormat('H:i:s', $horarioInicio);
        $anterior = $horarioInicio;
        $proximo  = $horarioInicio ;
        while ($horarioInicio->lessThan($ultimo_horario)) {
            $agendamentoExists = Agendamento::where('user_id', $user_id)
                ->where('funcionario_id', $funcionario_id)
                ->where('data_agendamento', $data)
                ->where('hora_agendamento', ">=", $anterior->format('H:i'))
                ->where('hora_agendamento', "<=", $proximo->format('H:i'))
                ->exists();
            if (!$agendamentoExists) {
                $horarios[] = ["horario" => $horarioInicio->format('H:i'), "disponivel" => 1];
            }
            else{
                $horarios[] = ["horario" => $horarioInicio->format('H:i'), "disponivel" => 0];
            }
            $anterior = $horarioInicio;
            $horarioInicio->addHours($horasASomar->hour);
            $horarioInicio->addMinutes($horasASomar->minute);
            $horarioInicio->addSeconds($horasASomar->second);
            $proximo = $horarioInicio;
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
    public function getServicosNotifyClint($dados)
    {
        $data = array();
        $nomes = "";
        $total = 0;
        foreach ($dados as $item) {

            $nomes .= " | " . $item->nome;
            $total += ($item->valor/100);
        }
        return array("nomes" => $nomes, "total" => $total);
    }
    public function notifyClient($id, $telefone_empresa = null)
    {
        $data = Agendamento::query()->where("id", $id)->first();
        $itens = AgendamentoItem::where('agendamento_id', $id)
            ->with('servico')
            ->get();
        $extras = $this->getServicosNotifyClint($itens->servico);


        $telefone  = "55" . str_replace(array("(", ")", ".", "-", " "), "",   $telefone_empresa ?? $data->telefone);
        $nome_cliente = $data->nome;
        $situacao = Situacao::where('referencia_id',$data->situacao_id)->first()->nome;

        $values = [
            "1" => [
                "type" => "text",
                "text" => $nome_cliente
            ],
            "2" => [
                "type" => "text",
                "text" => $id
            ],
            "3" => [
                "type" => "text",
                "text" => $extras['nomes']
            ],
            "4" => [
                "type" => "text",
                "text" => number_format($extras['total'], 2, ".", ",")
            ],
            "5" => [
                "type" => "text",
                "text" => $situacao
            ],
            "6" => [
                "type" => "text",
                "text" =>  FormaPagamento::where('id', $data->forma_pagamento_id)->first()->nome
            ]
            ,
            "7" => [
                "type" => "text",
                "text" =>  date("d/m/Y H:i", strtotime($data->data_agendamento." ".$data->hora_agendamento))
            ]
        ];
        $vetor = array(
            "messaging_product" => "whatsapp",
            "to"           => $telefone,
            "type"         => 'template',
            "template"     => array(
                "name"     => "agendamento",
                "language" => array(
                    "code" => "pt_BR",
                    "policy" => "deterministic"
                ),
                "components"     =>
                    array(
                        array(
                            "type"       => "body",
                            "parameters" => $values
                        )
                    )
            ),


        );

        $zap =  whatsapp::sendMessage($vetor, token::token());
        return [$vetor,$zap];
    }

}
