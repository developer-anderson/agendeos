<?php

namespace App\Http\Controllers;

use App\Models\funcionarios;
use Illuminate\Http\Request;
use App\Models\Clientes;
use App\Models\whatsapp;
use App\Models\token;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class FuncionariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll($id, $filter = null)
    {
        //
        $user = Auth::user();
        $query = funcionarios::where('user_id', $id);

        if ($filter) {
            $query->where(function ($q) use ($filter) {
                $q->where('nome', 'like', '%'.$filter.'%')
                    ->orWhere('cpf', 'like', '%'.$filter.'%')
                    ->orWhere('telefone', 'like', '%'.$filter.'%');
            });
        }

        $result = $query->orderBy('id', 'desc')->get();

        return response()->json($result, 200);

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
        $user = Auth::user();

        $post = $request->all();
        if($post['celular']){
            $telefone  = "55".str_replace(array("(", ")", ".", "-", " "), "", $post['celular']);
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
        $clientes = funcionarios::create( $post);
        return response()->json([
            "erro" => false,
            "mensagem" => "Funcionário cadastrado com  sucesso!",
            'id' => $clientes->id
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\funcionarios  $funcionarios
     * @return \Illuminate\Http\Response
     */
    public function show($funcionarios)
    {
        //
        $registro = funcionarios::where('id', $funcionarios)->first();
        return response()->json(
            $registro
        , 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\funcionarios  $funcionarios
     * @return \Illuminate\Http\Response
     */
    public function edit(funcionarios $funcionarios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\funcionarios  $funcionarios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dados = $request->all();
        $funcionarios = funcionarios::find($id);

        if (!$funcionarios) {
            return [
                "erro" => true,
                "mensagem" => "funcionarios não encontrado!"
            ];
        }

        $funcionarios->fill($dados);
        $funcionarios->save();

        return [
            "erro" => false,
            "mensagem" => "funcionarios editado com sucesso!"
        ];

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\funcionarios  $funcionarios
     * @return \Illuminate\Http\Response
     */
    public function destroy(funcionarios $funcionarios)
    {
        //
        funcionarios::find($funcionarios)->delete();
        return response()->json(
            [
                "erro" => false,
                "mensagem" => "Funcionário deletado com  sucesso!"
            ]
        , 200);
    }
}
