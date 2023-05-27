<?php

namespace App\Http\Controllers;

use App\Models\OrdemServicos;
use App\Models\ordem_servico_servico;
use App\Models\fluxo_caixa;
use Illuminate\Http\Request;
use App\Models\Servicos;
use App\Models\Clientes;
use App\Models\whatsapp;
use App\Models\token;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

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
        $os = OrdemServicos::where('inicio_os', '>=', date("Y-m-d") . ' 00:00:00')->where('inicio_os', '<=',   date("Y-m-d") . ' 23:59:59')->where('remarketing', 0)->get();

        foreach($os as $key => $value)
        {
            Log::info($this->notifyClient($value['id'],'remarketing'));
        }

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
    public function getAll($id, $incio, $fim = null, $filter = null)
    {
        //
        $query = DB::table('ordem_servicos')->leftJoin('clientes', 'clientes.id', '=', 'ordem_servicos.id_cliente')->leftJoin('veiculos', 'veiculos.id', '=', 'ordem_servicos.id_veiculo')
        ->leftJoin('ordem_servico_servicos', 'ordem_servico_servicos.os_id', '=', 'ordem_servicos.id')->leftJoin('servicos', 'servicos.id', '=', 'ordem_servico_servicos.id_servico')
        ->where('ordem_servicos.user_id', $id)->select('ordem_servicos.*', 'clientes.nome_f', 'clientes.razao_social', 'veiculos.placa', 'veiculos.modelo', 'servicos.nome', 'servicos.valor');
        if($fim){
            $query->where('inicio_os', '>=', $incio . " 00:00:00")->where('inicio_os', '<=', $incio . " 23:59:59")->orWhere('previsao_os', '>=', $incio . " 00:00:00")->where('previsao_os', '>=', $incio . " 23:59:59");
        }
        else{
            $query->whereDate('inicio_os', '=', $incio . " 00:00:00")->whereDate('previsao_os', '=', $incio . " 23:59:59");
        }
        $os = $query->get();

        return response()->json($os, 200);
    }
    public function getModeloMensagem($os_id)
    {
        //
        $os = DB::table('ordem_servicos')->join('clientes', 'clientes.id', '=', 'ordem_servicos.id_cliente')->join('veiculos', 'veiculos.id', '=', 'ordem_servicos.id_veiculo')->join('ordem_servico_servicos', 'ordem_servico_servicos.os_id', '=', 'ordem_servicos.id')
            ->join('servicos', 'servicos.id', '=', 'ordem_servico_servicos.id_servico')->join('users', 'users.id', '=', 'ordem_servicos.user_id')->where('ordem_servicos.id', $os_id)
            ->select('ordem_servicos.*', 'clientes.nome_f', 'clientes.razao_social', 'veiculos.placa', 'veiculos.modelo', 'servicos.nome', 'servicos.valor', 'users.name as loja')->get();
        return  $os;
    }
    public function pdf($id, $os_id)
    {
        //
        $os = DB::table('ordem_servicos')->join('clientes', 'clientes.id', '=', 'ordem_servicos.id_cliente')->join('veiculos', 'veiculos.id', '=', 'ordem_servicos.id_veiculo')->join('ordem_servico_servicos', 'ordem_servico_servicos.os_id', '=', 'ordem_servicos.id')->join('servicos', 'servicos.id', '=', 'ordem_servico_servicos.id_servico')->join('users', 'users.id', '=', 'ordem_servicos.user_id')->where('ordem_servicos.user_id', $id)
            ->select(
                'ordem_servicos.*',
                'clientes.nome_f',
                'clientes.razao_social',
                'veiculos.placa',
                'veiculos.modelo',
                'servicos.nome',
                'servicos.valor',
                'users.nome_fantasia',
                'users.logradouro as logradouro_loja',
                'users.numero as numero_loja',
                'users.complemento as complemento_loja',
                'users.bairro as bairro_loja',
                'users.estado as estado_loja',
                'users.cidade as cidade_loja',
                'users.cep as cep_loja',
                'clientes.logradouro as logradouro_cli',
                'clientes.numero as numero_cli',
                'clientes.complemento as complemento_cli',
                'clientes.bairro as bairro_cli',
                'clientes.estado as estado_cli',
                'clientes.cidade as cidade_cli',
                'clientes.cep as cep_cli'
            )->where('ordem_servicos.id', '=', $os_id)->get();
        return response()->json($os, 200);
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
        $post = $request->all();
        $os_servicos = $post['id_servico'];
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
        $this->notifyClient($os->id);
        $post['id_servico'] = $os_servicos;
        $this->addReceita($post);
        if ($post['remarketing']) {
            $this->remarketing($post);
        }

        return [
            "erro" => false,
            "mensagem" => "Ordem de Servicos com  sucesso!"
        ];
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
        $registro = Servicos::find($id);
        return  $registro;
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrdemServicos  $ordemServicos
     * @return \Illuminate\Http\Response
     */
    public function show($ordemServicos)
    {
        //
        $os = DB::table('ordem_servicos')->leftJoin('clientes', 'clientes.id', '=', 'ordem_servicos.id_cliente')->leftJoin('veiculos', 'veiculos.id', '=', 'ordem_servicos.id_veiculo')
        ->leftJoin('ordem_servico_servicos', 'ordem_servico_servicos.os_id', '=', 'ordem_servicos.id')
        ->select('ordem_servicos.*', 'clientes.nome_f', 'clientes.razao_social', 'veiculos.placa', 'veiculos.modelo', 'servicos.nome as nome_servico', 'servicos.valor as valor_servicos', 'ordem_servico_servicos.id_servico as id_servico')
        ->leftJoin('servicos', 'servicos.id', '=', 'ordem_servico_servicos.id_servico')->where('ordem_servicos.id', $ordemServicos)
        ->get();

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
    }
    public function getServicosNotifyClint($dados)
    {
        $data = array();
        $nomes = "";
        $total = 0;
        foreach ($dados as $item) {

            $nomes .= " " . $item->nome;
            $total += $item->valor;
        }
        return array("nomes" => $nomes, "total" => $total);
    }
    public function notifyClient($ordemServicos, $tipo = "nova_ordem_servico")
    {
        $dados = $this->getModeloMensagem($ordemServicos);
        $extras = $this->getServicosNotifyClint($dados);

        $situacao = "";
        $values = array();
        foreach ($dados as $item) {
            $cliente = Clientes::find($item->id_cliente);
            if ($cliente->celular_f) {
                $nome_cliente = $cliente->nome_f;
                $telefone  = "55" . str_replace(array("(", ")", ".", "-", " "), "", $cliente->celular_f);
            } elseif ($cliente->celular_rj) {
                $telefone  = "55" . str_replace(array("(", ")", ".", "-", " "), "",   $cliente->celular_rj);
                $nome_cliente = $cliente->razao_social;
            }
            if ($item->situacao) {

                $situacao = 'Aguardando Pagamento';
            } elseif ($item->situacao == 1) {

                $situacao = 'Pago';
            } elseif ($item->situacao == 2) {

                $situacao = 'Pago - serviço iniciado';
            } elseif ($item->situacao == 3) {

                $situacao = 'Pago - Aguardando retirada do Cliente';
            } elseif ($item->situacao == 4) {
                $situacao = 'Pago - Remarketing';
            } elseif ($item->situacao == 5) {
                $situacao = 'Remarketing';
            } elseif ($item->situacao == 6) {
                $situacao = 'Cancelado';
            }
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
                        "text" => "Pagamento na loja"
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

        $quantidade_os_funcionario = DB::table('funcionarios')->select('funcionarios.nome', DB::raw('count(ordem_servicos.id) as total_os'))
        ->join('ordem_servicos', 'funcionarios.id', '=', 'ordem_servicos.id_funcionario')->where('ordem_servicos.user_id', $id)
        ->whereBetween('ordem_servicos.created_at', [$inicio, $fim])->groupBy('funcionarios.nome')->get();

        $receita_funcionario = DB::table('funcionarios')->select('funcionarios.nome', DB::raw('SUM(servicos.valor) as total_valor'))->join('ordem_servicos', 'funcionarios.id', '=', 'ordem_servicos.id_funcionario')
        ->join('ordem_servico_servicos', 'ordem_servicos.id', '=', 'ordem_servico_servicos.os_id')->join('servicos', 'ordem_servico_servicos.id_servico', '=', 'servicos.id')->where('ordem_servicos.user_id', $id)
        ->whereBetween('ordem_servicos.created_at', [$inicio, $fim])->groupBy('funcionarios.nome')->get();

        $receita_cliente = DB::table('clientes')->select('clientes.nome_f', DB::raw('SUM(servicos.valor) as total_valor'))->join('ordem_servicos', 'clientes.id', '=', 'ordem_servicos.id_cliente')
        ->join('ordem_servico_servicos', 'ordem_servicos.id', '=', 'ordem_servico_servicos.os_id')->join('servicos', 'ordem_servico_servicos.id_servico', '=', 'servicos.id')->where('ordem_servicos.user_id', $id)
        ->whereBetween('ordem_servicos.created_at', [$inicio, $fim])->groupBy('clientes.nome_f')->get();

        $data['receita_por_funcionario'] = $receita_funcionario;
        $data['quantidade_os_funcionario'] = $quantidade_os_funcionario;
        $data['receita_por_cliente'] = $receita_cliente;
        return response()->json($data, 200);
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
            $caixa->valor = $valor_total;
            $caixa->save();
        }


        return response()->json(
            [
                'zap' => $this->notifyClient($ordemServicos, "nova_ordem_servico"),
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
}
