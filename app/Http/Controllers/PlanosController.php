<?php

namespace App\Http\Controllers;

use App\Models\Planos;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class PlanosController extends Controller
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
            Planos::where('situacao',1)->get()
        ], 200);

    }

    public function store(Request $request)
    {
        //
        $user = Auth::user();

        $post = $request->all();

        $Planos = Planos::create( $post);
        return response()->json([
            "erro" => false,
            "mensagem" => "Plano cadastrada com  sucesso!",
            'id' => $Planos->id
        ], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Planos  $Planos
     * @return \Illuminate\Http\Response
     */
    public function show(Planos $Planos)
    {
        //
        $registro = Planos::where('id',$Planos)->first();
        return response()->json(
            $Planos
        , 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Planos  $Planos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Planos $Planos)
    {
        $dados = $request->all();
        //dd($dados);
        Planos::find($Planos)->first()->fill($dados)->save();
        return [
            "erro" => false,
            "mensagem" => "Empresa editada com  sucesso!"
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Planos  $Planos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Planos $Planos)
    {
        //
        Planos::find($Planos)->delete();
        $response = [
            "erro" => false,
            "mensagem" => "Planos apagada com sucesso!"
        ];
        return  $response;
    }
}
