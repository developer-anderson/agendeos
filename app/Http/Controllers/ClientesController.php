<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        //
        return Clientes::all();
    }
    public function store(Request $request)
    {
        //
        $post = $request->all();
        Clientes::create( $post);
        return [
            "erro" => false,
            "mensagem" => "Cliente cadastrado com  sucesso!"
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function show(Clientes $clientes)
    {
        //
        $registro = Clientes::find($clientes);
        return $registro;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clientes $clientes)
    {
        //
        $dados = $request->all();
        Clientes::find($clientes)->update($dados);
        return [
            "erro" => false,
            "mensagem" => "Cliente editado com  sucesso!"
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clientes $clientes)
    {
        //
        Clientes::find($clientes)->delete();
        $response = [
            "erro" => false,
            "mensagem" => "Cliente apagado com sucesso!"
        ];
        return  $response;
    }
}
