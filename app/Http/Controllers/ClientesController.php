<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        return response()->json([
            Clientes::all()
        ], 200);
       
    }
    public function getAllclientByType($type = "PF")
    {
        return response()->json(
            Clientes::where('tipo_cliente',$type)->get()
        , 200);
    }
    public function viewToken()
    {
        return  response()->json(csrf_token());
    }
    public function store(Request $request)
    {
        //
        $post = $request->all();
       
        $clientes = Clientes::create( $post);
        return response()->json([
            "erro" => false,
            "mensagem" => "Cliente cadastrado com  sucesso!",
            'id' => $clientes->id
        ], 200);
     
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
        return response()->json(
            $registro
        , 200);
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
        $dados = $request->all();
        Clientes::find($clientes)->first()->fill($request->all())->save();
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
