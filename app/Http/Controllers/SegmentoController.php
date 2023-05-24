<?php

namespace App\Http\Controllers;

use App\Models\Segmento;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class SegmentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        //
        $user = Auth::user();
        return response()->json([
            Segmento::where('situacao',1)->get()
        ], 200);

    }

    public function store(Request $request)
    {
        //
        $user = Auth::user();

        $post = $request->all();

        $Segmento = Segmento::create( $post);
        return response()->json([
            "erro" => false,
            "mensagem" => "Plano cadastrada com  sucesso!",
            'id' => $Segmento->id
        ], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Segmento  $Segmento
     * @return \Illuminate\Http\Response
     */
    public function show(Segmento $Segmento)
    {
        //
        $registro = Segmento::where('id',$Segmento)->get();
        return response()->json(
            $registro
        , 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Segmento  $Segmento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Segmento $Segmento)
    {
        $dados = $request->all();
        //dd($dados);
        Segmento::find($Segmento)->first()->fill($dados)->save();
        return [
            "erro" => false,
            "mensagem" => "Empresa editada com  sucesso!"
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Segmento  $Segmento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Segmento $Segmento)
    {
        //
        Segmento::find($Segmento)->delete();
        $response = [
            "erro" => false,
            "mensagem" => "Segmento apagada com sucesso!"
        ];
        return  $response;
    }
}
