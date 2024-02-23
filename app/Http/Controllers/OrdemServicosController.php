<?php

namespace App\Http\Controllers;

use App\Models\OrdemServicos;
use App\Models\ordem_servico_servico;
use App\Models\Empresas;
use App\Models\fluxo_caixa;
use App\Models\RetornoPagamento;
use App\Models\UsuarioAssinatura;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Servicos;
use App\Models\Clientes;
use App\Models\FormaPagamento;
use App\Models\Situacao;
use App\Models\funcionarios;
use App\Models\whatsapp;
use App\Models\token;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
        $estabelecimento  =  Empresas::where('situacao', 1)->where('slug', $slug)->first();
        if(empty($slug) or  !$estabelecimento)
        {
            return response()->json(['error' => true, 'message' => "Estabelecimento Não encontrado"], 404);
        }
        $administrador  = User::where('empresa_id', $estabelecimento->id)->first();
        $data['funcionarios']   = funcionarios::where('user_id', $administrador->id)->where("ativo", 1)->get();
        $data['servicos']       = Servicos::where('user_id', $administrador->id)->where("ativo", 1)->get();
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
    public function getAll($id, $inicio, $fim = null, $funcionario_id = null)
    {
        $user = Auth::user();
        $data = [];

        $query = DB::table('ordem_servicos');
        $this->applyDateFilters($query, $inicio, $fim);
        $this->applyUserFilters($query, $user, $id, $funcionario_id);

        $os = $query->orderBy('id', 'desc')->get();

        foreach ($os as $key => $value) {
            $data[$key] = $this->transformOsData($value);
        }

        return response()->json($data, 200);
    }

    private function applyDateFilters($query, $inicio, $fim)
    {
        if ($fim) {
            $query->where(function ($query) use ($inicio, $fim) {
                $query->whereBetween('inicio_os', ["$inicio 00:00:00", "$fim 23:59:59"])
                    ->orWhereBetween('previsao_os', ["$inicio 00:00:00", "$fim 23:59:59"]);
            });
        } else {
            $query->whereDate('inicio_os', '=', "$inicio 00:00:00")
                ->whereDate('previsao_os', '=', "$inicio 23:59:59");
        }
    }

    private function applyUserFilters($query, $user, $id, $funcionario_id)
    {
        if ($funcionario_id || $user->funcionario_id) {
            $query->where('ordem_servicos.id_funcionario', "=", $funcionario_id ?? $user->funcionario_id);
        } else {
            $query->where('ordem_servicos.user_id', $id);
        }
    }

    private function transformOsData($osData)
    {
        $osData = get_object_vars($osData);
        $osData['ids_servicos'] = $this->getIdsServicos($osData['id']);
        $osData['servicos'] = $this->getServicos($osData['ids_servicos']);
        $osData['cliente'] = Clientes::find($osData['id_cliente']);
        $osData['funcionario'] = $osData['id_funcionario'] ? Funcionarios::find($osData['id_funcionario']) : null;
        $osData['veiculo'] = $osData['id_veiculo'] ? Veiculos::find($osData['id_veiculo']) : null;
        $osData['situacao'] = Situacao::where('referencia_id', $osData['situacao'])->select("referencia_id as id", "nome")->first();
        $osData['forma_pagamento'] = $osData['id_forma_pagamento'] ? FormaPagamento::find($osData['id_forma_pagamento']) : null;

        $this->formatDateFields($osData);

        return $osData;
    }

    private function getIdsServicos($osId)
    {
        return ordem_servico_servico::where('os_id', $osId)->pluck('id_servico');
    }

    private function getServicos($idsServicos)
    {
        return Servicos::whereIn('id', $idsServicos)->get();
    }

    private function formatDateFields(&$osData)
    {

        $inicio = explode(" ", $osData['inicio_os']);
        $fim = explode(" ", $osData['previsao_os']);
        $osData["inicio_os"] = $inicio[0];
        $osData["inicio_os_time"] =$inicio[1];
        $osData["previsao_os"] =$fim[0];
        $osData["previsao_os_time"] =$fim[1];
    }

    private function formatDateTimeField($dateTime)
    {
        $dateTimeParts = explode(" ", $dateTime);
        return [
            'date' => $dateTimeParts[0],
            'time' => $dateTimeParts[1]
        ];
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
            $post['inicio_os'] = $post['inicio_os'] . " " . $post['inicio_os_time'];
            if(isset($post["validar"])){
                $cliente = Clientes::where('email_f', $post['email'])->first();
                if($cliente and !empty($post['email'])){
                    $post["id_cliente"] = $cliente->id;
                }
                else{
                    $cliente = Clientes::create(["nome_f" => $post["nome"], "email_f" =>$post["email"], "telefone_f" =>$post["telefone"], "celular_f" =>$post["telefone"] ]);

                    $post["id_cliente"] = $cliente->id;
                }
                $post['previsao_os'] = $post['inicio_os'];
            }
            else{

                $post['previsao_os'] = $post['previsao_os'] . " " . $post['previsao_os_time'];
            }
            $post['id_servico'] = 0;

            $post['valor'] = 0;
            $os =  OrdemServicos::create($post);
            $post['os_id'] = $os->id;
            foreach ($os_servicos as $item) {
                $valor_temp = Servicos::query()->where('id', $item['servicos_id'])->first()->valor;
                $post['valor'] += $valor_temp;
                $data = array(
                    "os_id"      => $os->id,
                    "id_servico" => $item['servicos_id'],
                    "quantidade" => $item['quantidade'] ?? 1,
                    "valor" => $valor_temp
                );
                ordem_servico_servico::create($data);
            }

            $post['id_servico'] = $os_servicos;
            $this->addReceita($post);
            return response()->json( ["erro" => false, 'id' =>$os->id, 'zap' => $this->notifyClient($os->id), "mensagem" => "Ordem de Servicos com  sucesso!"], 200);
        }catch( Exception $e){
            echo ($e->getMessage()." linha ". $e->getLine(). " arquivo ". $e->getFile());
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

        $inicio_os = explode(" ",  $os["inicio_os"]);
        $previsao_os = explode(" ",  $os["previsao_os"]);
        $os["inicio_os"] = $inicio_os[0];
        $os["inicio_os_time"] =$inicio_os[1];
        $os["previsao_os"] =$previsao_os[0];
        $os["previsao_os_time"] =$previsao_os[1];


        $os['servicos'] =   Servicos::whereIn('id', $ids_servicos)
            ->leftJoin("ordem_servico_servicos", function($join) use ($os) {
                $join->on('servicos.id', '=', 'ordem_servico_servicos.id_servico')
                    ->where('ordem_servico_servicos.os_id', '=', $os->id);
            })
            ->select("servicos.id", "servicos.nome", "ordem_servico_servicos.quantidade", "ordem_servico_servicos.valor")
            ->get();
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
    public function pedidoPagamento($ordemServicos)
    {


        $os = OrdemServicos::where('id',$ordemServicos)->first();
        $ids_servicos = ordem_servico_servico::where('os_id', $ordemServicos)->select('id_servico')->get();

        $inicio_os = explode(" ",  $os["inicio_os"]);
        $previsao_os = explode(" ",  $os["previsao_os"]);
        $os["inicio_os"] = $inicio_os[0];
        $os["inicio_os_time"] =$inicio_os[1];
        $os["previsao_os"] =$previsao_os[0];
        $os["previsao_os_time"] =$previsao_os[1];


        $os['servicos'] =  Servicos::whereIn('id',$ids_servicos)->get();
        $os['total'] = Servicos::whereIn('id', $ids_servicos)->sum('valor');
        $os["taxa"] = 100;
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
        return view('pagamento', compact('os'));
    }
    public function addReceita($data)
    {
        $data['cliente_id'] = $data['id_cliente'];
        $data['os_id'] = $data['os_id'];

        $data['nome'] = "Ordem de Serviço #" . $data['os_id'];
        $data['produto_id'] = null;

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
    public function gerarPDF($id, $inicio, $fim = null, $funcionario_id = null)
    {
        $user = Auth::user();
        $funcionario = funcionarios::query()->find($funcionario_id);
        $administrador = User::query()->find($id);
        $empresa = Empresas::query()->find($administrador->empresa_id);
        $query = DB::table('ordem_servicos');
        $this->applyDateFilters($query, $inicio, $fim);
        $this->applyUserFilters($query, $user, $id, $funcionario_id);
        $comissao = $funcionario->comissao / 100;
        $total = 0;
        $os = $query->orderBy('id', 'desc')->pluck("id");
        $caixa = fluxo_caixa::query()->whereIn("os_id", $os)->get();
        foreach ($caixa as $registro){
            $registro->valor_receber = "R$ ". number_format((($registro->valor / 100) * ($comissao / 100)), 2, ",", ".");
            $total += (($registro->valor / 100) * ($comissao / 100));
        }
       $total = "R$ ". number_format($total, 2, ",", ".");
        $data = [
            "caixa" =>  $caixa,
            "funcionario" => $funcionario,
            "empresa" => $empresa,
            "comissao" => $comissao,
            "inicio" => date("d/m/Y", strtotime($inicio)),
            "fim" => date("d/m/Y", strtotime($fim)),
            "total" => $total
        ];
        $pdf = PDF::loadView('outros.recibo', $data);
        return $pdf->download('recibo.pdf');
    }
    public function relatorio($id, $inicio = null, $fim = null)
    {
        $data = [];
        if(!$inicio and !$fim){
            $inicio  = date("Y-m-01");
            $fim     = date("Y-m-31");
        }
        $quantidade_os_funcionario = DB::table('funcionarios')
            ->select('funcionarios.nome', 'funcionarios.id', DB::raw('COUNT(ordem_servicos.id) as total_os'))
            ->join('ordem_servicos', 'funcionarios.id', '=', 'ordem_servicos.id_funcionario')
            ->where('ordem_servicos.user_id', '=', $id)
            ->where('ordem_servicos.situacao', '=', 1)
            ->whereBetween('ordem_servicos.created_at', ["$inicio 00:00:00", "$fim 23:59:59"])
            ->groupBy('funcionarios.nome', 'funcionarios.id')
            ->get();
        $receita_funcionario = DB::table('funcionarios')
            ->select('funcionarios.nome', 'funcionarios.id', DB::raw('SUM(servicos.valor) as receita_total'),
                DB::raw('SUM(CASE WHEN ordem_servicos.situacao = 1 THEN servicos.valor * funcionarios.comissao / 100 ELSE 0 END) as comissao_funcionario'))
            ->join('ordem_servicos', 'funcionarios.id', '=', 'ordem_servicos.id_funcionario')
            ->join('ordem_servico_servicos', 'ordem_servicos.id', '=', 'ordem_servico_servicos.os_id')
            ->join('servicos', 'ordem_servico_servicos.id_servico', '=', 'servicos.id')
            ->where('ordem_servicos.user_id', '=', $id)
            ->where('ordem_servicos.situacao', '=', 1)
            ->whereBetween('ordem_servicos.created_at', ["$inicio 00:00:00", "$fim 23:59:59"])
            ->groupBy('funcionarios.nome', 'funcionarios.id')
            ->get();
        $receita_cliente = DB::table('clientes')
            ->select('clientes.nome_f', DB::raw('SUM(servicos.valor) as total_valor'))
            ->join('ordem_servicos', 'clientes.id', '=', 'ordem_servicos.id_cliente')
            ->join('ordem_servico_servicos', 'ordem_servicos.id', '=', 'ordem_servico_servicos.os_id')
            ->join('servicos', 'ordem_servico_servicos.id_servico', '=', 'servicos.id')
            ->where('ordem_servicos.user_id', '=', $id)
            ->where('ordem_servicos.situacao', '=', 1)
            ->whereBetween('ordem_servicos.created_at', [$inicio . ' 00:00:00', $fim . ' 23:59:59'])
            ->groupBy('clientes.nome_f')
            ->get();
        $receita_produtos = DB::table('fluxo_caixas')
            ->select('produtos.nome', DB::raw('SUM(fluxo_caixas.valor) as total_valor'))
            ->join('fluxo_caixas_produtos', 'fluxo_caixas_produtos.fluxo_caixas_id', '=', 'fluxo_caixas.id')
            ->join('produtos', 'produtos.id', '=', 'fluxo_caixas_produtos.produto_id')
            ->where('produtos.user_id', '=', $id)
            ->where('fluxo_caixas.user_id', '=', $id)
            ->whereBetween('fluxo_caixas.created_at', [$inicio . ' 00:00:00', $fim . ' 23:59:59'])
            ->groupBy('produtos.nome')
            ->get();
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
        foreach ($resultadosFormatados as &$resultadosAno) {
            uksort($resultadosAno, function ($mes1, $mes2) use ($mesesDoAno) {
                return array_search($mes1, $mesesDoAno) - array_search($mes2, $mesesDoAno);
            });
        }
        $fechamento_caixa = fluxo_caixa::select('forma_pagamento.nome as nome', DB::raw('SUM(fluxo_caixas.valor) as total_valor'))
            ->join('ordem_servicos', 'fluxo_caixas.os_id', '=', 'ordem_servicos.id')
            ->join('forma_pagamento', 'ordem_servicos.id_forma_pagamento', '=', 'forma_pagamento.id')
            ->where('ordem_servicos.user_id', $id)
            ->where('fluxo_caixas.user_id', $id)
            ->whereBetween('fluxo_caixas.data', [$inicio, $fim])
            ->groupBy('forma_pagamento.nome')
            ->get();
        $receita = fluxo_caixa::where('tipo_id', 1)->where('user_id', $id)->where('situacao', '<>', 6)
            ->whereBetween('data', [$inicio, $fim])->sum('valor');
        $desconto = fluxo_caixa::where('tipo_id', 1)->where('user_id', $id)->where('situacao', '<>', 6)
            ->whereBetween('data', [$inicio, $fim])->sum('desconto');
        $despesa = fluxo_caixa::where('tipo_id', 2)->where('user_id', $id)->where('situacao', '<>', 6)
            ->whereBetween('data', [$inicio, $fim])->sum('valor');
        $data['receita_por_funcionario'] = $receita_funcionario;
        $data['quantidade_os_funcionario'] = $quantidade_os_funcionario;
        $data['receita_por_cliente'] = $receita_cliente;
        $data['receita_por_produto'] = $receita_produtos;
        $data['faturamento'] = $resultadosFormatados;
        $data['fechamento_caixa'] = $fechamento_caixa;
        $data['receita'] = $receita;
        $data['desconto'] = $desconto;
        $data['despesa'] = $despesa;
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
        $dados = $request->all();
        $os_servicos = $dados['id_servico'];
        $dados['id_servico'] = 0;
        $dados['inicio_os'] = $dados['inicio_os']." ".$dados['inicio_os_time'];
        $dados['previsao_os'] =$dados['previsao_os']." ".$dados['previsao_os_time'];
        ordem_servico_servico::where('os_id', $ordemServicos)->delete();
        $OrdemServicos = OrdemServicos::find($ordemServicos);
        $OrdemServicos->fill($dados);
        $OrdemServicos->save();
        $valor_total = 0;
        foreach ($os_servicos as $id_servico) {
            $servico = $this->getServico($id_servico);
            $valor_total += $servico->valor;
            $data = array(
                "os_id"      => $ordemServicos,
                "id_servico" => $id_servico,
                'valor' => $servico->valor
            );
            ordem_servico_servico::create($data);
        }
        $caixa = fluxo_caixa::where('os_id', $OrdemServicos->id)->first();
        if($caixa){
            $caixa->valor = $valor_total;
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
