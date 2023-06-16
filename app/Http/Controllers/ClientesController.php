<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\whatsapp;
use App\Models\Empresas;
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
    public function getAll($id, $filter = null)
    {
        $user = Auth::user();
        $query = Clientes::where('user_id', $id);

        if ($filter) {
            $query->where(function ($q) use ($filter) {
                $q->where('email', 'like', '%'.$filter.'%')
                    ->orWhere('cpf', 'like', '%'.$filter.'%')
                    ->orWhere('name', 'like', '%'.$filter.'%');
            });
        }

        $result = $query->orderBy('id', 'desc')->get();

        return response()->json($result, 200);
    }

    public function getAllclientByType($type = "PF", $id, $filter = null)
    {


        $query = Clientes::where('tipo_cliente',$type)->where('user_id',$id);

        if ($filter) {
            $query->where(function ($q) use ($filter) {
                $q->where('email_f', 'like', '%'.$filter.'%')
                    ->orWhere('cpf', 'like', '%'.$filter.'%')
                    ->orWhere('email_j', 'like', '%'.$filter.'%')
                    ->orWhere('nome_j', 'like', '%'.$filter.'%')
                    ->orWhere('telefone_j', 'like', '%'.$filter.'%')
                    ->orWhere('telefone_f', 'like', '%'.$filter.'%')
                    ->orWhere('nome_f', 'like', '%'.$filter.'%');
            });
        }

        $result =  $query->orderBy('id', 'desc')->get();

        return response()->json($result, 200);
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
        $zap = whatsapp::sendMessage($vetor, token::token());
        $clientes = Clientes::create( $post);
        return response()->json([
            "erro" => false,
            "mensagem" => "Cliente cadastrado com  sucesso!",
            'id' => $clientes->id,
            'zap' => $zap
        ], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function exibirCliente(Clientes $id)
    {

        //$registro = Clientes::find($id)->first();
        return response()->json(
            $id
        , 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dados = $request->all();

        $cliente = Clientes::find($id);

        if (!$cliente) {
            return [
                "erro" => true,
                "mensagem" => "Cliente não encontrado!"
            ];
        }

        $cliente->fill($dados);
        $cliente->save();

        return [
            "erro" => false,
            "mensagem" => "Cliente editado com sucesso!"
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
