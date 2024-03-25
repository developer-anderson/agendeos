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
        $query = ExcecaoHorarios::where('user_id', $user->id)->where("funcionario_id", $id);

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

        $request->validate([
            'data' => 'required',
            'horario' => 'required',
            'funcionario_id' => 'required',
        ]);
        $post = $request->all();

        $post["user_id"] = $user->id;
        $excecaoHorario = ExcecaoHorarios::create($post);

        return response()->json([
            "erro" => false,
            "mensagem" => "Error",
            "excecaoHorario" => $excecaoHorario
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

    public function delete($funcionario_id)
    {
        $excecaoHorario = ExcecaoHorarios::where('id', $funcionario_id)->delete();

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
    public function update(Request $request, $id)
    {
        $request->validate([
            'data' => 'required',
            'horario' => 'required',
        ]);

        $excecaoHorario = ExcecaoHorarios::find($id);
        if (!$excecaoHorario) {
            return response()->json(["erro" => true, "mensagem" => "não encontrado!"], 404);
        }
        $excecaoHorario->update($request->all());


        return [
            "erro" => false,
            'excecaoHorario' => $excecaoHorario->load('funcionario'),
            "mensagem" => "Editado com sucesso!"
        ];
    }
}
