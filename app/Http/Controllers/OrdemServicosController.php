<?php

namespace App\Http\Controllers;

use App\Models\OrdemServicos;
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
    public function getAll($id)
    {
        //
        $os = DB::table('ordem_servicos')->join('clientes', 'clientes.id', '=', 'ordem_servicos.id_cliente')->join('veiculos', 'veiculos.id', '=', 'ordem_servicos.id_veiculo')->join('servicos', 'servicos.id', '=', 'ordem_servicos.id_servico')->where('ordem_servicos.user_id',$id)
        ->select('ordem_servicos.*', 'clientes.nome_f', 'clientes.razao_social' , 'veiculos.placa', 'veiculos.modelo', 'servicos.nome', 'servicos.valor')->get();
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
        $post['inicio_os'] = $post['inicio_os'] ." ".$post['inicio_os_time'];
        $post['previsao_os'] = $post['previsao_os'] ." ".$post['previsao_os_time'];
   
       $os=  OrdemServicos::create( $post);
       $post['os_id'] = $os->id;
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
        
        OrdemServicos::create($post);
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
        $servico = $this->getServico($data['id_servico']);
        $data['valor'] = $servico->valor;
        $data['nome'] = $servico->nome;
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
        //dd($ordemServicos);
        OrdemServicos::find($ordemServicos)->first()->fill($request->all())->save();
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
