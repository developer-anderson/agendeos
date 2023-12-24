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
    public function getAll($filter = null)
    {
        //
        $user = Auth::user();
        $query = Empresas::where('situacao', 1);

        if ($filter) {
            $query->where(function ($q) use ($filter) {
                $q->where('cnpj', 'like', '%'.$filter.'%')
                    ->orWhere('razao_social', 'like', '%'.$filter.'%')
                    ->orWhere('telefone', 'like', '%'.$filter.'%');
            });
        }

        $result = $query->orderBy('id', 'desc')->paginate();

        return response()->json($result, 200);

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
        $registro = Empresas::where('empresas.id',$Empresas)->join('segmento', 'segmento.id', '=', 'empresas.segmento_id')->join('planos', 'planos.id', '=', 'empresas.plano_id')->select(['empresas.*', 'planos.plano', 'segmento.segmento'])->first();
        return response()->json(
            $Empresas
        , 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empresas  $Empresas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $Empresas)
    {
        $dados = $request->all();
        $Empresas = Empresas::find($Empresas);

        if (!$Empresas) {
            return [
                "erro" => true,
                "mensagem" => "Empresas não encontrado!"
            ];
        }

        $Empresas->fill($dados);
        $Empresas->save();

        return [
            "erro" => false,
            "mensagem" => "Empresas editado com sucesso!"
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
