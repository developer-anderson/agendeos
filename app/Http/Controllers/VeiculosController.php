<?php

namespace App\Http\Controllers;

use App\Models\Veiculos;
use Illuminate\Http\Request;

class VeiculosController extends Controller
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
        Veiculos::create( $post);
        return [
            "erro" => false,
            "mensagem" => "Veiculo cadastrado com  sucesso!"
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Veiculos  $veiculos
     * @return \Illuminate\Http\Response
     */
    public function show(Veiculos $veiculos)
    {
        //
        $registro = Veiculos::find($veiculos);
        return $registro;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Veiculos  $veiculos
     * @return \Illuminate\Http\Response
     */
    public function edit(Veiculos $veiculos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Veiculos  $veiculos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Veiculos $veiculos)
    {
        //
        $dados = $request->all();
        Veiculos::find($veiculos)->update($dados);
        return [
            "erro" => false,
            "mensagem" => "Veiculo editado com  sucesso!"
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Veiculos  $veiculos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Veiculos $veiculos)
    {
        //
        Veiculos::find($veiculos)->delete();
        $response = [
            "erro" => false,
            "mensagem" => "Veiculo apagado com sucesso!"
        ];
    }
}
