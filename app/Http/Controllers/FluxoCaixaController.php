<?php

namespace App\Http\Controllers;

use App\Models\fluxo_caixa;
use Illuminate\Http\Request;

class FluxoCaixaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll($id, $incio, $fim)
    {
        //
       
        return response()->json(
            fluxo_caixa::where('user_id',$id)->where('data', '>=',$incio)->where('data', '<=',$fim)->get()
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

        $registro = fluxo_caixa::find($fluxo_caixa);
        return response()->json(
            $registro
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
    public function update(Request $request, fluxo_caixa $fluxo_caixa)
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
        //dd($post);
        fluxo_caixa::find($fluxo_caixa)->first()->fill($post)->save();
        return response()->json(
             [
                "erro" => false,
                "mensagem" => "Editado com  sucesso!"
            ]
        , 200);
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
