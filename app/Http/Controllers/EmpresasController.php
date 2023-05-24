<?php

namespace App\Http\Controllers;

use App\Models\Empresas;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class EmpresasController extends Controller
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
            Empresas::where('situacao',1)->get()
        ], 200);

    }

    public function store(Request $request)
    {
        //
        $user = Auth::user();

        $post = $request->all();

        $Empresas = Empresas::create( $post);
        return response()->json([
            "erro" => false,
            "mensagem" => "Empresas cadastrada com  sucesso!",
            'id' => $Empresas->id
        ], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empresas  $Empresas
     * @return \Illuminate\Http\Response
     */
    public function show(Empresas $Empresas)
    {
        //
        $registro = Empresas::where('empresas.id',$Empresas)->join('segmento', 'segmento.id', '=', 'empresas.segmento_id')->join('planos', 'planos.id', '=', 'empresas.plano_id')->select(['empresas.*', 'planos.plano', 'segmento.segmento'])->get();
        return response()->json(
            $registro
        , 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empresas  $Empresas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empresas $Empresas)
    {
        $dados = $request->all();
        //dd($dados);
        Empresas::find($Empresas)->first()->fill($dados)->save();
        return [
            "erro" => false,
            "mensagem" => "Empresa editada com  sucesso!"
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empresas  $Empresas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empresas $Empresas)
    {
        //
        Empresas::find($Empresas)->delete();
        $response = [
            "erro" => false,
            "mensagem" => "Empresa apagada com sucesso!"
        ];
        return  $response;
    }
}
