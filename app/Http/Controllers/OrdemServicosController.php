<?php

namespace App\Http\Controllers;

use App\Models\OrdemServicos;
use App\Models\ordem_servico_servico;
use App\Models\fluxo_caixa;
use Illuminate\Http\Request;
use App\Models\Servicos;
use Illuminate\Support\Facades\DB;
class OrdemServicosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getServicosOs($os_id){
        return response()->json( ordem_servico_servico::where('os_id', $os_id)->get() , 200);
    }
    public function getAll($id, $incio, $fim)
    {
        //
        $os = DB::table('ordem_servicos')->join('clientes', 'clientes.id', '=', 'ordem_servicos.id_cliente')->join('veiculos', 'veiculos.id', '=', 'ordem_servicos.id_veiculo')->join('ordem_servico_servicos', 'ordem_servico_servicos.os_id', '=', 'ordem_servicos.id')->join('servicos', 'servicos.id', '=', 'ordem_servico_servicos.id_servico')->where('ordem_servicos.user_id',$id)
        ->select('ordem_servicos.*', 'clientes.nome_f', 'clientes.razao_social' , 'veiculos.placa', 'veiculos.modelo', 'servicos.nome', 'servicos.valor')->where('inicio_os', '>=',$incio." 00:00:00")->where('inicio_os', '<=',$fim." 23:59:59")->get();
        return response()->json( $os , 200);
    }

    public function pdf($id, $os_id)
    {
        //
        $os = DB::table('ordem_servicos')->join('clientes', 'clientes.id', '=', 'ordem_servicos.id_cliente')->join('veiculos', 'veiculos.id', '=', 'ordem_servicos.id_veiculo')->join('ordem_servico_servicos', 'ordem_servico_servicos.os_id', '=', 'ordem_servicos.id')->join('servicos', 'servicos.id', '=', 'ordem_servico_servicos.id_servico')->join('users', 'users.id', '=', 'ordem_servicos.user_id')->where('ordem_servicos.user_id',$id)
        ->select('ordem_servicos.*', 'clientes.nome_f', 'clientes.razao_social', 'veiculos.placa', 'veiculos.modelo', 'servicos.nome', 'servicos.valor', 'users.nome_fantasia',
         'users.logradouro as logradouro_loja', 'users.numero as numero_loja', 'users.complemento as complemento_loja',
         'users.bairro as bairro_loja', 'users.estado as estado_loja', 'users.cidade as cidade_loja', 'users.cep as cep_loja',  'clientes.logradouro as logradouro_cli', 'clientes.numero as numero_cli', 'clientes.complemento as complemento_cli',
         'clientes.bairro as bairro_cli', 'clientes.estado as estado_cli', 'clientes.cidade as cidade_cli', 'clientes.cep as cep_cli')->where('ordem_servicos.id', '=',$os_id)->get();
        return response()->json( $os , 200);
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
        $post['inicio_os'] = $post['inicio_os'] ." ".$post['inicio_os_time'];
        $post['previsao_os'] = $post['previsao_os'] ." ".$post['previsao_os_time'];
        $os=  OrdemServicos::create( $post);
        $post['os_id'] = $os->id;
        foreach($os_servicos as $id_servico)
        {
            $data = array(
                "os_id"      => $os->id,
                "id_servico" => $id_servico
            );
            ordem_servico_servico::create($data);
        }
        $post['id_servico'] = $os_servicos;
        $this->addReceita($post);
        if($post['remarketing'])
        {
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
        $post['remarketing'] = null;
        $post['previsao_os'] = date('Y-m-d H:i:s', strtotime("+$remarketing days",strtotime($post['inicio_os'])));
        $post['inicio_os'] = date('Y-m-d H:i:s', strtotime("+$remarketing days",strtotime($post['inicio_os'])));
        $os_servicos = $post['id_servico'];
        $post['id_servico'] = 0;
        $os = OrdemServicos::create($post);
        foreach($os_servicos as $id_servico)
        {
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
    public function show(OrdemServicos $ordemServicos)
    {
        //
        $registro = OrdemServicos::find($ordemServicos);
        return response()->json(
            $registro
        , 200);
    }
    public function addReceita($data)
    {
        $data['cliente_id'] = $data['id_cliente'];
        $data['os_id'] = $data['os_id'];
        $data['valor'] =0;
        foreach($data['id_servico'] as $id_servico)
        {
            $servico = $this->getServico($id_servico);
            $data['valor'] += $servico->valor;
        }
        $data['nome'] = "Ordem de Serviço #".$data['os_id'];
        $data['produto_id'] = null;
        if($data['situacao'] >= 2 and $data['situacao'] <= 4)
        {
            $data['pagamento_id'] = 1;
        }
        elseif($data['situacao'] == 0 or $data['situacao'] == 6){
            $data['pagamento_id'] = $data['situacao'];
        }
        else{
            $data['pagamento_id'] = 0;
        }
        $data['data'] = date("Y-m-d");
        $data['tipo_id'] = 1;
        fluxo_caixa::create($data);
 
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
        OrdemServicos::find($ordemServicos)->first()->fill($dados)->save();
        $valor_total = 0;
        foreach($os_servicos as $id_servico)
        {
            $servico = $this->getServico($id_servico);
            $valor_total += $servico->valor;
            $data = array(
                "os_id"      => $ordemServicos,
                "id_servico" => $id_servico
            );
            ordem_servico_servico::create($data);
        }
        $caixa = fluxo_caixa::where('os_id', $ordemServicos)->first();
        $caixa->valor = $valor_total;
        $caixa->save();
        return response()->json(
             [
                "erro" => false,
                "mensagem" => "Ordem de Servicos editado com  sucesso!"
            ]
        , 200);
     
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
