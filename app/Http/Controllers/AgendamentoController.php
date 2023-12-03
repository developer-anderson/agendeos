<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use App\Models\AgendamentoItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgendamentoController extends Controller
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
        $query = Agendamento::where('user_id', $id);

        if ($filter) {
            $query->where(function ($q) use ($filter) {
                $q->where('nome', 'like', '%' . $filter . '%')
                    ->orWhere('telefone', 'like', '%' . $filter . '%')
                    ->orWhere('data_agendamento', 'like', '%' . $filter . '%')
                    ->orWhere('funcionario_id', 'like', '%' . $filter . '%')
                    ->orWhere('clientes_id', 'like', '%' . $filter . '%')
                    ->orWhere('email', 'like', '%' . $filter . '%');
            });
        }

        $result = $query->with('cliente', 'situacao', 'formaPagamento', 'funcionario', 'agendamentoItens')->orderBy('id', 'desc')->get();


        return response()->json($result->load('cliente', 'situacao', 'formaPagamento', 'funcionario'), 200);
    }
    public function adicionarItens(Request $request, $agendamentoId)
    {
        $user = Auth::user();
        $agendamento = Agendamento::find($agendamentoId);

        if (!$agendamento) {
            return response()->json(["erro" => true, "mensagem" => "Agendamento não encontrado!"], 404);
        }

        // Obter os itens do request
        $itens = $request->input('itens');
        if (!$itens || !is_array($itens)) {
            return response()->json(["erro" => true, "mensagem" => "Itens não fornecidos ou no formato incorreto!"], 400);
        }

        // Criar os itens de agendamento
        foreach ($itens as $item) {
            AgendamentoItem::create([
                'servicos_id' => $item['servicos_id'],
                'funcionarios_id' => $item['funcionarios_id'],
                'agendamento_id' => $agendamento->id,
            ]);
        }

        // Carregar os relacionamentos após a criação dos itens
        $itens = AgendamentoItem::where('agendamento_id', $agendamento->id)
            ->with('agendamento', 'funcionario', 'servico')
            ->get();

        return response()->json(["erro" => false, "mensagem" => "Itens de agendamento adicionados com sucesso!", 'itens' => $itens], 200);
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
            'nome' => 'required',
            'email' => 'required|email',
            'telefone' => 'required',
            'data_agendamento' => 'required',
            'forma_pagamento_id' => 'required',
        ]);

        $agendamento = Agendamento::create($request->all());

        if($agendamento){
            $itens = $request->input('itens');
            if($itens){
                if (!$itens || !is_array($itens)) {
                    return response()->json(["erro" => true, "mensagem" => "Itens não fornecidos ou no formato incorreto!"], 400);
                }
                foreach ($itens as $item) {
                    AgendamentoItem::create([
                        'servicos_id' => $item['servicos_id'],
                        'funcionarios_id' => $item['funcionarios_id'],
                        'quantidade' => $item['quantidade'],
                        'valor' => $item['valor'],
                        'agendamento_id' => $agendamento->id,
                    ]);
                }
                $itens = AgendamentoItem::where('agendamento_id', $agendamento->id)
                    ->with('agendamento', 'funcionario', 'servico')
                    ->get();
            }

        }
        return response()->json([
            "erro" => false,
            "mensagem" => "Agendamento cadastrado com sucesso!",
            'id' => $agendamento->id,
            'itens' => $itens,
            'agendamento' => $agendamento->load('cliente', 'situacao', 'formaPagamento')
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agendamento  $agendamento
     * @return \Illuminate\Http\Response
     */
    public function show($id,$agendamento)
    {
        $data =  Agendamento::where('id', $agendamento)->where('user_id', $id)->first();
        $itens = AgendamentoItem::where('agendamento_id', $data->id)
        ->with('agendamento', 'funcionario', 'servico', 'funcionario')
        ->get();
        return response()->json(['agendamento' => $data->load('cliente', 'situacao', 'formaPagamento', 'funcionario'), 'itens'=> $itens], 200);
    }

    public function updateStatusAgendamento(Agendamento $agendamento, $situacao_id){
        $agendamento->update(['situacao_id' => $situacao_id]);

        return response()->json($agendamento, 200);
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
            'nome' => 'required',
            'email' => 'required|email',
            'telefone' => 'required',
            'data_agendamento' => 'required',
            'forma_pagamento_id' => 'required',

        ]);

        $agendamento = Agendamento::find($id);

        if (!$agendamento) {
            return [
                "erro" => true,
                "mensagem" => "Agendamento não encontrado!"
            ];
        }
        if($agendamento){
            $itens = $request->input('itens');
            if($itens){
                if (!$itens || !is_array($itens)) {
                    return response()->json(["erro" => true, "mensagem" => "Itens não fornecidos ou no formato incorreto!"], 400);
                }
                else{
                    AgendamentoItem::where("agendamento_id",$agendamento->id )->delete();
                    foreach ($itens as $item) {
                        AgendamentoItem::create([
                            'servicos_id' => $item['servicos_id'],
                            'funcionarios_id' => $item['funcionarios_id'],
                            'quantidade' => $item['quantidade'],
                            'valor' => $item['valor'],
                            'agendamento_id' => $agendamento->id,
                        ]);
                    }
                }

                $itens = AgendamentoItem::where('agendamento_id', $agendamento->id)
                    ->with('agendamento', 'funcionario', 'servico')
                    ->get();
            }

        }
        $agendamento->update($request->all());

        return [
            "erro" => false,
            'agendamento' => $agendamento->load('cliente', 'situacao', 'formaPagamento'),
            "mensagem" => "Agendamento editado com sucesso!"
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agendamento  $agendamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agendamento $agendamento)
    {
        $agendamento->delete();

        return [
            "erro" => false,
            "mensagem" => "Agendamento apagado com sucesso!"
        ];
    }
}
