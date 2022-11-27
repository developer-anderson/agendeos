<?php

namespace App\Http\Controllers;

use App\Models\OrdemServicos;
use Illuminate\Http\Request;

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
      
        return response()->json(
            OrdemServicos::where('user_id',$id)->get()
        , 200);
       
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
        OrdemServicos::create( $post);
        return [
            "erro" => false,
            "mensagem" => "Ordem de Servicos com  sucesso!"
        ];
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
    public function update(Request $request, OrdemServicos $ordemServicos)
    {
        //
        $dados = $request->all();
        OrdemServicos::find($ordemServicos)->update($dados);
        return [
            "erro" => false,
            "mensagem" => "Ordem de Servicos editado com  sucesso!"
        ];
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
