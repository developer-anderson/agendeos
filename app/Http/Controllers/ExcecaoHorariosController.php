<?php

namespace App\Http\Controllers;

use App\Models\ExcecaoHorarios;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExcecaoHorariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  string|null  $filter
     * @return \Illuminate\Http\Response
     */
    public function getAll($id, $filter = null)
    {
        $user = Auth::user();
        $query = ExcecaoHorarios::where('user_id', $user->id)->where("funcionario_id", $id)->where('data', '>=', date("Y-m-d"));

        if ($filter) {
            $query->where(function ($q) use ($filter) {
                $q->where('data', 'like', '%' . $filter . '%')
                    ->orWhere('horario', 'like', '%' . $filter . '%');
                $q->orWhereHas('funcionario', function ($query) use ($filter) {
                    $query->where('funcionario_id', 'like', '%' . $filter . '%')
                        ->orWhere('nome', 'like', '%' . $filter . '%');
                });
            });
        }
        $query->orderBy("horario", "asc");
        $result = $query->with('funcionario')->orderBy('id', 'desc')->get();


        return response()->json($result, 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $post = $request->all();
        foreach($post["datas"] as $item){
            $data = [
                'data' => $item["data"],
                'horario' => $item["horario"],
                'funcionario_id' => $post["funcionario_id"],
                'user_id' => $user->id,
            ];
            ExcecaoHorarios::create($data);

        }


        return response()->json([
            "erro" => false,
            "mensagem" => "Cadastrado com sucesso",
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agendamento  $agendamento
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $excecaoHorario = ExcecaoHorarios::where('id', $id)
            ->with('funcionario')->orderBy('id', 'desc')
            ->first();

        return response()->json($excecaoHorario, 200);
    }

    public function delete($id)
    {
        $excecaoHorario = ExcecaoHorarios::where('id', $id)->delete();

        return response()->json([
            "erro" => false,
            "mensagem" => "Excluido com sucesso",
        ], 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $funcionario_id)
    {


        $user = Auth::user();
        ExcecaoHorarios::where('funcionario_id', $funcionario_id)->delete();
        $post = $request->all();
        foreach($post["datas"] as $item){
            $data = [
                'data' => $item["data"],
                'horario' => $item["horario"],
                'funcionario_id' => $funcionario_id,
                'user_id' => $user->id,
            ];
            ExcecaoHorarios::create($data);
        }
        return [
            "erro" => false,
            "mensagem" => "Editado com sucesso!"
        ];
    }
}
