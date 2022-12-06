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
    public function index()
    {
        //
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
        fluxo_caixa::create( $post);
        return response()->json(
            [
                "erro" => false,
                "mensagem" => "Ordem de Servicos com  sucesso!"
            ]
        , 200);
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\fluxo_caixa  $fluxo_caixa
     * @return \Illuminate\Http\Response
     */
    public function show(fluxo_caixa $fluxo_caixa)
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
        fluxo_caixa::find($fluxo_caixa)->first()->fill($request->all())->save();
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
