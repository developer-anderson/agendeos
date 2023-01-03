<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\whatsapp;
use App\Models\token;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll($id)
    {
        //
        $user = Auth::user();
        return response()->json([
            Clientes::where('user_id',$id)->get()
        ], 200);
       
    }
    public function getAllclientByType($type = "PF", $id)
    {
        
        return response()->json(
            Clientes::where('tipo_cliente',$type)->where('user_id',$id)->get()
        , 200);
    }
    public function viewToken()
    {
        return  response()->json(csrf_token());
    }
    public function store(Request $request)
    {
        //
        $user = Auth::user();
 
        $post = $request->all();
        if($post['celular_f']){
            $telefone  = "55".str_replace(array("(", ")", ".", "-", " "), "", $post['celular_f']);
        }
        elseif($post['celular_rj']){
            $telefone  = "55".str_replace(array("(", ")", ".", "-", " "), "", $post['celular_rj']);
        }
        $vetor = array(
            "messaging_product" => "whatsapp",
            "to" => $telefone,
            "type" => 'template',
            "template" => array(
                "name" => "bem_vindo",
                "language" => array(
                    "code" => "pt_BR"
                )
            )
        );
        whatsapp::sendMessage($vetor, token::token());
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
        //dd($dados);
        Clientes::find($clientes)->first()->fill($dados)->save();
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
