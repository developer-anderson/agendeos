<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\fluxo_caixa;
use App\Models\OrdemServicos;
use App\Models\Tipo;
use Illuminate\Http\Request;
use App\Models\FormaPagamento;
use App\Models\Situacao;
class FluxoCaixaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll($id, $incio, $fim, $filter = null)
    {
        //

       $registros =   fluxo_caixa::where('user_id',$id)->where('data', '>=',$incio)->where('data', '<=',$fim)->orderBy('id', 'DESC')->get();
       foreach ($registros as $registro){
           $registro->situacao = Situacao::where('referencia_id',$registro->situacao)->select("referencia_id as id", "nome")->first();
           $registro->forma_pagamento = FormaPagamento::where('id', $registro->pagamento_id)->first() ?? null;
           $registro->valor_final = $registro->valor - ($registro->desconto ?? 0.00);
           $registro->cliente = Clientes::where('id', $registro->cliente_id)->first();
           $registro->os = OrdemServicos::where('id', $registro->os_id)->first();
           if($registro->os and !$registro->forma_pagamento){
               $registro->forma_pagamento = FormaPagamento::where('id', $registro->os->id_forma_pagamento)->first();
           }
           $registro->tipo = Tipo::where('id', $registro->tipo_id)->first();
       }
        return response()->json(
            $registros
        , 200);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        if (strlen($post['valor']) >= 7) {
            $post['valor'] = str_replace(".", "",   $post['valor'] );
            $post['valor'] = str_replace(",", ".",   $post['valor'] );
        }
        else{
            $post['valor'] = str_replace(",", ".",   $post['valor'] );
        }
        if (strlen($post['desconto']) >= 7) {
            $post['desconto'] = str_replace(".", "",   $post['desconto'] );
            $post['desconto'] = str_replace(",", ".",   $post['desconto'] );
        }
        else{
            $post['desconto'] = str_replace(",", ".",   $post['desconto'] );
        }
        $post['valor'] = $post['valor']  * $post['quantidade'];
        fluxo_caixa::create( $post);
        return response()->json(
            [
                "erro" => false,
                "mensagem" => "Sucesso!"
            ]
        , 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\fluxo_caixa  $fluxo_caixa
     * @return \Illuminate\Http\Response
     */
    public function show($fluxo_caixa)
    {
        //
        $fluxo_caixa = fluxo_caixa::where('id',$fluxo_caixa)->first();
        $fluxo_caixa['situacao'] = Situacao::where('referencia_id',$fluxo_caixa->situacao)->select("referencia_id as id", "nome")->first();
        $fluxo_caixa->forma_pagamento = FormaPagamento::where('id', $fluxo_caixa->pagamento_id)->first() ?? null;
        $fluxo_caixa->valor_final = $fluxo_caixa->valor - ($fluxo_caixa->desconto ?? 0.00);
        $fluxo_caixa->cliente = Clientes::where('id', $fluxo_caixa->cliente_id)->first();
        $fluxo_caixa->os = OrdemServicos::where('id', $fluxo_caixa->os_id)->first();
        $fluxo_caixa->tipo = Tipo::where('id', $fluxo_caixa->tipo_id)->first();
        if($fluxo_caixa->os and !$fluxo_caixa->forma_pagamento){
            $fluxo_caixa->forma_pagamento = FormaPagamento::where('id', $fluxo_caixa->os->id_forma_pagamento)->first();
        }
        if(!$fluxo_caixa){
            return response()->json(
                [
                   "erro" => true,
                   "mensagem" => "Transação não encontrada"
               ]
           , 404);
        }
        return response()->json(
            $fluxo_caixa
        , 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\fluxo_caixa  $fluxo_caixa
     * @return \Illuminate\Http\Response
     */
    public function edit(fluxo_caixa $fluxo_caixa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\fluxo_caixa  $fluxo_caixa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $fluxo_caixa)
    {
        //
        $post = $request->all();
        if (strlen($post['valor']) >= 7) {
            $post['valor'] = str_replace(".", "",   $post['valor'] );
            $post['valor'] = str_replace(",", ".",   $post['valor'] );
        }
        else{
            $post['valor'] = str_replace(",", ".",   $post['valor'] );
        }
        if (strlen($post['desconto']) >= 7) {
            $post['desconto'] = str_replace(".", "",   $post['desconto'] );
            $post['desconto'] = str_replace(",", ".",   $post['desconto'] );
        }
        else{
            $post['desconto'] = str_replace(",", ".",   $post['desconto'] );
        }

        $post['valor'] = $post['valor']  * $post['quantidade'];
        $fluxo_caixa = fluxo_caixa::find($fluxo_caixa);

        if (!$fluxo_caixa) {
            return [
                "erro" => true,
                "mensagem" => "Transação  não encontrado!"
            ];
        }

        $fluxo_caixa->fill($post);
        $fluxo_caixa->save();
        return [
            "erro" => false,
            "mensagem" => "Transação editada com  sucesso!"
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\fluxo_caixa  $fluxo_caixa
     * @return \Illuminate\Http\Response
     */
    public function destroy(fluxo_caixa $fluxo_caixa)
    {
        //
    }
}
