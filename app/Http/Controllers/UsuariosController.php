<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuarios;
class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['Usuarios'] = Usuarios::all();

        return $data;
    }


    public function store(Request $request)
    {
        $dados = $request->all();
        Usuarios::create($dados);
        return [
            "erro" => false,
            "mensagem" => "Usuário cadastrado com  sucesso!"
        ];
    }
    public function show($id)
    {
        $registro = Usuarios::find($id);
        return $registro;
    }


    public function update(Request $request, $id)
    {
        $dados = $request->all();
        Usuarios::find($id)->update($dados);
        return [
            "erro" => false,
            "mensagem" => "Usuário editado com  sucesso!"
        ];
    }

    public function delete($id)
    {
        Usuarios::find($id)->delete();
        $response = [
            "erro" => false,
            "mensagem" => "Usuário apagado com sucesso!"
        ];
        return  $response;
    }
}
