<?php

namespace App\Http\Controllers;

use App\Models\OrdemServicos;
use App\Models\ordem_servico_servico;
use App\Models\Empresas;
use App\Models\fluxo_caixa;
use App\Models\RetornoPagamento;
use App\Models\UsuarioAssinatura;
use Illuminate\Http\Request;
use App\Models\Servicos;
use App\Models\Clientes;
use App\Models\FormaPagamento;
use App\Models\Situacao;
use App\Models\funcionarios;
use App\Models\whatsapp;
use App\Models\token;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Usuarios;
use App\Models\Veiculos;
use Exception;
use Illuminate\Support\Facades\Log;
use PagSeguro\Configuration\Configure;

use PagSeguro\Domains\Requests\DirectPayment\OnlineDebit;
use PagSeguro\Domains\Requests\DirectPayment\CreditCard;
class OrdemServicosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cron()
    {
        //
        $os = OrdemServicos::where('inicio_os', '>=', date("Y-m-d") . ' 00:00:00')->where('inicio_os', '<=',   date("Y-m-d") . ' 23:59:59')->where('remarketing', 0)->orderBy('id', 'desc')->get();
        //dd($os);
        foreach($os as $key => $value)
        {

            Log::info($this->notifyClient($value['id'],'remarketing'));
        }

    }
    public function getEstabelecimento($slug){
        $estabelecimento  =  Empresas::where('situacao', 1)->where('razao_social', $slug)->first();
        if(empty($slug) or  !$estabelecimento)
        {
            return response()->json(['error' => true, 'message' => "Estabelecimento Não encontrado"], 404);
        }
        $administrador  = User::where('empresa_id', $estabelecimento->id)->first();
        $data['funcionarios']   = funcionarios::where('user_id', $administrador->id)->get();
        $data['servicos']       = Servicos::where('user_id', $administrador->id)->get();
        $data['estabelecimento']       = $estabelecimento;
        $data['administrador']       = $administrador;
       return view('agendamento')->with($data);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getServicosOs($os_id)
    {
        return response()->json(ordem_servico_servico::where('os_id', $os_id)->get(), 200);
    }
    public function getAll($id, $incio, $fim = null, $funcionario_id = null)
    {
        $data = array();
        $query = DB::table('ordem_servicos')->where('ordem_servicos.user_id', $id);
        if($fim){
            $query->where('inicio_os', '>=', $incio . " 00:00:00")
                ->where('inicio_os', '<=', $fim . " 23:59:59")
                ->orWhere('previsao_os', '>=', $incio . " 00:00:00")
                ->where('previsao_os', '<=', $fim . " 23:59:59")
                ->where('ordem_servicos.user_id', $id);
        }
        else{
            $query->whereDate('inicio_os', '=', $incio . " 00:00:00")
                ->whereDate('previsao_os', '=', $incio . " 23:59:59")
                ->where('ordem_servicos.user_id', $id);
        }
        if($funcionario_id){
            $query->where('ordem_servicos.id_funcionario', $funcionario_id);
        }
        $os = $query->orderBy('id', 'desc')->get();

        foreach($os as $key => $value)
        {
            $value = get_object_vars($value);
           // dd($value);
            $data[$key] = $value;
            $ids_servicos = ordem_servico_servico::where('os_id', $value['id'])->select('id_servico')->get();
            $data[$key]['ids_servicos'] =  $ids_servicos ;
            $servicos = [];
            foreach($ids_servicos as  $id){

                $servicos[]= Servicos::where('id',$id['id_servico'])->first();
            }
            $data[$key]['servicos'] =  $servicos ;
            $data[$key]['cliente'] = Clientes::where('id', $value['id_cliente'])->first();

            if($value['id_funcionario']){
                $data[$key]['funcionario'] = funcionarios::where('id', $value['id_funcionario'])->first();
            }
            if($value['id_veiculo']){
                $data[$key]['veiculo'] = Veiculos::where('id', $value['id_veiculo'])->first();
            }

            $data[$key]['situacao'] = Situacao::where('referencia_id', $value['situacao'])->select("referencia_id as id", "nome")->first();
            if($value['id_forma_pagamento']){
                $data[$key]['forma_pagamento'] = FormaPagamento::where('id', $value['id_forma_pagamento'])->first();
            }
            $inicio_os = explode(" ",  $value["inicio_os"]);
            $previsao_os = explode(" ",  $value["previsao_os"]);
            $data[$key]["inicio_os"] = $inicio_os[0];
            $data[$key]["inicio_os_time"] =$inicio_os[1];
            $data[$key]["previsao_os"] =$previsao_os[0];
            $data[$key]["previsao_os_time"] =$previsao_os[1];


        }

        return response()->json($data, 200);

    }
    public function getModeloMensagem($os_id)
    {
        //
        $os = DB::table('ordem_servicos')->join('clientes', 'clientes.id', '=', 'ordem_servicos.id_cliente')->join('ordem_servico_servicos', 'ordem_servico_servicos.os_id', '=', 'ordem_servicos.id')
            ->join('servicos', 'servicos.id', '=', 'ordem_servico_servicos.id_servico')->join('users', 'users.id', '=', 'ordem_servicos.user_id')->where('ordem_servicos.id', $os_id)
            ->select('ordem_servicos.*', 'clientes.nome_f', 'clientes.razao_social',  'servicos.nome', 'servicos.valor', 'users.name as loja')->get();
        return  $os;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try{
            $post = $request->all();
            $os_servicos = $post['id_servico'];
            if(isset($post["validar"])){
                $cliente = Clientes::where('email', $post['email'])->first();
                if($cliente and !empty($post['email'])){
                    $post["id_cliente"] = $cliente->id;
                }
                else{
                    $cliente = Clientes::create(["nome_f" => $post["nome"], "email_f" =>$post["email"], "telefone_f" =>$post["telefone"], "celular_f" =>$post["telefone"] ]);
                    $post["id_cliente"] = $cliente->id;
                }
            }
            $post['id_servico'] = 0;
            $post['inicio_os'] = $post['inicio_os'] . " " . $post['inicio_os_time'];
            $post['previsao_os'] = $post['previsao_os'] . " " . $post['previsao_os_time'];
            $os =  OrdemServicos::create($post);
            $post['os_id'] = $os->id;
            foreach ($os_servicos as $id_servico) {
                $data = array(
                    "os_id"      => $os->id,
                    "id_servico" => $id_servico
                );
                ordem_servico_servico::create($data);
            }

            $post['id_servico'] = $os_servicos;
            $this->addReceita($post);
    /*
            if ($post['remarketing']) {
                $this->remarketing($post);
            }*/
            //$this->notifyClient($os->id);
            return [
                "erro" => false,
                'id' =>$os->id,
                'zap' => $this->notifyClient($os->id),
                "mensagem" => "Ordem de Servicos com  sucesso!"
            ];
        }catch( Exception $e){
            echo ($e->getMessage());
        }

    }
    public function remarketing($post)
    {
        //
        $post['situacao'] = 5;
        $remarketing = $post['remarketing'];
        $post['remarketing'] = 0;
        $post['previsao_os'] = date('Y-m-d H:i:s', strtotime("+$remarketing days", strtotime($post['inicio_os'])));
        $post['inicio_os'] = date('Y-m-d H:i:s', strtotime("+$remarketing days", strtotime($post['inicio_os'])));
        $os_servicos = $post['id_servico'];
        $post['id_servico'] = 0;
        $os = OrdemServicos::create($post);
        $this->addReceita($post);
        foreach ($os_servicos as $id_servico) {
            $data = array(
                "os_id"      => $os->id,
                "id_servico" => $id_servico
            );
            ordem_servico_servico::create($data);
        }
    }
    public function getServico($id)
    {
        $registro = Servicos::where('id',$id)->first();
        return  $registro;
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrdemServicos  $ordemServicos
     * @return \Illuminate\Http\Response
     */
    public function show($ordemServicos, $tipo = false)
    {


        $os = OrdemServicos::where('id',$ordemServicos)->first();
        $ids_servicos = ordem_servico_servico::where('os_id', $ordemServicos)->select('id_servico')->get();
        $os['ids_servicos'] =  $ids_servicos ;
        $servicos = [];
        $inicio_os = explode(" ",  $os["inicio_os"]);
        $previsao_os = explode(" ",  $os["previsao_os"]);
        $os["inicio_os"] = $inicio_os[0];
        $os["inicio_os_time"] =$inicio_os[1];
        $os["previsao_os"] =$previsao_os[0];
        $os["previsao_os_time"] =$previsao_os[1];
        foreach($ids_servicos as  $id){

            $servicos[]= Servicos::where('id',$id['id_servico'])->first();
        }

        $os['servicos'] =  $servicos ;
        $os['cliente'] = Clientes::where('id', $os->id_cliente)->get();
        if($os->id_funcionario){
            $os['funcionario'] = funcionarios::where('id', $os->id_funcionario)->get();
        }
        if($os->id_veiculo){
            $os['veiculo'] = Veiculos::where('id', $os->id_veiculo)->get();
        }
        $os['situacao'] = Situacao::where('referencia_id',$os->situacao)->first();

        if($os->id_forma_pagamento){
            $os['forma_pagamento'] = FormaPagamento::where('id', $os->id_forma_pagamento)->first();
        }
        if($tipo){
            return $os;
        }
        return response()->json($os, 200);
    }
    public function addReceita($data)
    {
        $data['cliente_id'] = $data['id_cliente'];
        $data['os_id'] = $data['os_id'];
        $data['valor'] = 0;
        foreach ($data['id_servico'] as $id_servico) {
            $servico = $this->getServico($id_servico);
            $data['valor'] += $servico->valor;
        }
        $data['nome'] = "Ordem de Serviço #" . $data['os_id'];
        $data['produto_id'] = null;
        if ($data['situacao'] <> 1) {
            $data['valor'] = 0;
        }
        if ($data['situacao'] >= 2 and $data['situacao'] <= 4) {
            $data['pagamento_id'] = 1;
        } elseif ($data['situacao'] == 0 or $data['situacao'] == 6) {
            $data['pagamento_id'] = $data['situacao'];
        } else {
            $data['pagamento_id'] = 0;
        }
        $data['data'] = date("Y-m-d");
        $data['tipo_id'] = 1;
        fluxo_caixa::create($data);
        return true;
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
    public function notifyClient($ordemServicos, $tipo = "nova_ordem_servico")
    {
        $situacao = "";
        $values = array();
        $data = $this->show($ordemServicos, true);
        $extras = $this->getServicosNotifyClint($data['servicos']);
        $cliente = $data['cliente'][0];

        if ($cliente['celular_f']) {
            $nome_cliente = $cliente['nome_f'];
            $telefone  = "55" . str_replace(array("(", ")", ".", "-", " "), "", $cliente['celular_f']);
        } elseif ( $cliente['celular_rj']) {
            $telefone  = "55" . str_replace(array("(", ")", ".", "-", " "), "",   $cliente['celular_rj']);
            $nome_cliente = $cliente['razao_social'];
        }

        $situacao = Situacao::where('referencia_id',$data['situacao'])->first()->nome;
        if($tipo == 'nova_ordem_servico'){
            $values = [
                "0" => [
                    "type" => "text",
                    "text" => $nome_cliente
                ],
                "1" => [
                    "type" => "text",
                    "text" => $ordemServicos
                ],
                "2" => [
                    "type" => "text",
                    "text" => $extras['nomes']
                ],
                "3" => [
                    "type" => "text",
                    "text" => number_format($extras['total'], 2, ".", ",")
                ],
                "5" => [
                    "type" => "text",
                    "text" => $situacao
                ],
                "6" => [
                    "type" => "text",
                    "text" =>  FormaPagamento::where('id', $data['id_forma_pagamento'])->first()->nome
                ]
            ];
        }
        elseif($tipo == 'atualizacao_ordem_servico'){
            $id_origem = ($ordemServicos-1);
            $dias_remarketing = OrdemServicos::where('id',$id_origem)->first();

            $values = [
                "0" => [
                    "type" => "text",
                    "text" => $ordemServicos
                ],
                "1" => [
                    "type" => "text",
                    "text" => $nome_cliente
                ],
                "2" => [
                    "type" => "text",
                    "text" => $situacao
                ]
            ];
        }
        elseif($tipo == 'remarketing'){
            $id_origem = ($ordemServicos-1);
            $dias_remarketing = OrdemServicos::where('id',$id_origem)->first();

            $values = [
                "0" => [
                    "type" => "text",
                    "text" => $nome_cliente
                ],
                "1" => [
                    "type" => "text",
                    "text" => $dias_remarketing->remarketing
                ]
            ];
        }
        $vetor = array(
            "messaging_product" => "whatsapp",
            "to"           => $telefone,
            "type"         => 'template',
            "template"     => array(
                "name"     => $tipo,
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
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrdemServicos  $ordemServicos
     * @return \Illuminate\Http\Response
     */
    public function edit(OrdemServicos $ordemServicos)
    {
        //
    }

    public function relatorio($id, $inicio = null, $fim = null)
    {
        $data = [];
        if(!$inicio and !$fim){
            $inicio  = date("Y-m-01");
            $fim     = date("Y-m-31");
        }

        $quantidade_os_funcionario = DB::select("
    SELECT funcionarios.nome, COUNT(ordem_servicos.id) as total_os
    FROM funcionarios
    JOIN ordem_servicos ON funcionarios.id = ordem_servicos.id_funcionario
    WHERE ordem_servicos.user_id = ?
        AND ordem_servicos.created_at >= '$inicio 00:00:00' and ordem_servicos.situacao = 1
        AND ordem_servicos.created_at <= '$fim 23:59:59'
    GROUP BY funcionarios.nome
", [$id]);

$receita_funcionario = DB::select("
    SELECT funcionarios.nome, SUM(servicos.valor) as receita_total,
           SUM(CASE WHEN ordem_servicos.situacao = 1 THEN servicos.valor * funcionarios.comissao / 100 ELSE 0 END) as comissao_funcionario
    FROM funcionarios
    JOIN ordem_servicos ON funcionarios.id = ordem_servicos.id_funcionario
    JOIN ordem_servico_servicos ON ordem_servicos.id = ordem_servico_servicos.os_id
    JOIN servicos ON ordem_servico_servicos.id_servico = servicos.id
    WHERE ordem_servicos.user_id = ? and ordem_servicos.situacao = 1
        AND ordem_servicos.created_at >= '$inicio 00:00:00'
        AND ordem_servicos.created_at <= '$fim 23:59:59'
    GROUP BY funcionarios.nome
", [$id]);


$receita_cliente = DB::select("
    SELECT clientes.nome_f, SUM(servicos.valor) as total_valor
    FROM clientes
    JOIN ordem_servicos ON clientes.id = ordem_servicos.id_cliente
    JOIN ordem_servico_servicos ON ordem_servicos.id = ordem_servico_servicos.os_id
    JOIN servicos ON ordem_servico_servicos.id_servico = servicos.id
    WHERE ordem_servicos.user_id = ?
        AND ordem_servicos.created_at >= ?
        AND ordem_servicos.created_at <= ?  and ordem_servicos.situacao = 1
    GROUP BY clientes.nome_f
", [$id, $inicio . ' 00:00:00', $fim . ' 23:59:59']);

        $resultados = DB::table('ordem_servicos')
        ->join('ordem_servico_servicos', 'ordem_servicos.id', '=', 'ordem_servico_servicos.os_id')
        ->join('servicos', 'ordem_servico_servicos.id_servico', '=', 'servicos.id')
        ->selectRaw('YEAR(ordem_servicos.created_at) AS ano, MONTH(ordem_servicos.created_at) AS mes, SUM(servicos.valor) AS valor_total')
        ->where('ordem_servicos.user_id', $id)
         ->where('ordem_servicos.situacao', 1)
        ->groupBy('ano', 'mes')
        ->orderBy('ano', 'asc')
        ->orderBy('mes', 'asc')
        ->get();

    $resultadosFormatados = [];

    // Cria um array com todos os meses do ano
    $mesesDoAno = array(
        'janeiro', 'fevereiro', 'março', 'abril', 'maio', 'junho',
        'julho', 'agosto', 'setembro', 'outubro', 'novembro', 'dezembro'
    );

    foreach ($resultados as $resultado) {
        $ano = $resultado->ano;
        $mes = Carbon::createFromFormat('!m', $resultado->mes)->locale('pt_BR')->monthName;
        $valorTotal = $resultado->valor_total;

        if (!isset($resultadosFormatados[$ano])) {
            $resultadosFormatados[$ano] = array_fill_keys($mesesDoAno, 0);
        }

        $resultadosFormatados[$ano][$mes] = $valorTotal;
    }

    // Ordena os meses
    foreach ($resultadosFormatados as &$resultadosAno) {
        uksort($resultadosAno, function ($mes1, $mes2) use ($mesesDoAno) {
            return array_search($mes1, $mesesDoAno) - array_search($mes2, $mesesDoAno);
        });
    }

    // Agora $resultadosFormatados contém os valores para todos os meses, incluindo aqueles com valor 0 e ordenados corretamente




        $data['receita_por_funcionario'] = $receita_funcionario;
        $data['quantidade_os_funcionario'] = $quantidade_os_funcionario;
        $data['receita_por_cliente'] = $receita_cliente;
        $data['faturamento'] = $resultadosFormatados;
        return response()->json([$data], 200);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrdemServicos  $ordemServicos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $ordemServicos)
    {
        //

        $dados = $request->all();
        $os_servicos = $dados['id_servico'];
        $dados['id_servico'] = 0;
        $dados['inicio_os'] = $dados['inicio_os']." ".$dados['inicio_os_time'];
        $dados['previsao_os'] =$dados['previsao_os']." ".$dados['previsao_os_time'];
        //dd($dados);
        ordem_servico_servico::where('os_id', $ordemServicos)->delete();
        //OrdemServicos::find($ordemServicos)->first()->fill($dados)->save();
        $OrdemServicos = OrdemServicos::find($ordemServicos);

        $OrdemServicos->fill($dados);
        $OrdemServicos->save();
        $valor_total = 0;
        foreach ($os_servicos as $id_servico) {
            $servico = $this->getServico($id_servico);
            $valor_total += $servico->valor;
            $data = array(
                "os_id"      => $ordemServicos,
                "id_servico" => $id_servico
            );
            ordem_servico_servico::create($data);
        }
        $caixa = fluxo_caixa::where('os_id', $ordemServicos)->first();
        if($caixa){
            if($dados['situacao'] <> 1){
                $caixa->valor = 0;
            }
            else{
                $caixa->valor = $valor_total;
            }

            $caixa->save();
        }


        return response()->json(
            [
                'zap' => $this->notifyClient($ordemServicos, "atualizacao_ordem_servico"),
                "erro" => false,
                "mensagem" => "Ordem de Servicos editado com  sucesso!"
            ],
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrdemServicos  $ordemServicos
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrdemServicos $ordemServicos)
    {
        //
        OrdemServicos::find($ordemServicos)->delete();
        $response = [
            "erro" => false,
            "mensagem" => "Serviço apagado com sucesso!"
        ];
        return  $response;
    }
    public function retornoPagamento(Request $request)
    {
        $dataAtual = Carbon::now();
        $dataFutura = $dataAtual->addDays(30);
        $dataAtualFormatada = $dataAtual->format('Y-m-d');
        $dataFuturaFormatada = $dataFutura->format('Y-m-d');
        $dados = $request->all();
        if(str_contains($dados["event"], 'subscription')){
            $assinatura = UsuarioAssinatura::query()->where("id", $dados["resource"]["reference_id"])->first();
            if($dados["resource"]["current_invoice"]["payments"]["status"] == "DENIED"){
                $assinatura->ativo = false;
            }
            else{
                $assinatura->ativo = true;
                $assinatura->data_renovacao = $dataFuturaFormatada;
            }
            $assinatura->save();
        }
        RetornoPagamento::query()->create(["retorno" => $request->all()]);
    }
}
