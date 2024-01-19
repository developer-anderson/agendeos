<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class fluxo_caixa extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'valor', 'nome','pagamento_id','situacao' , 'quantidade' ,'os_id', 'data', 'produto_id', 'cliente_id', 'desconto', 'tipo_id'];


    public static function getallMoney()
    {
        $startOfDay = Carbon::parse(date("Y-m-d"))->startOfDay();
        $endOfDay = Carbon::parse(date("Y-m-d"))->endOfDay();
        $receita = fluxo_caixa::where('tipo_id', 1)->where('pagamento_id', 1)->where('user_id', Auth::id())
            ->whereBetween('data', [$startOfDay, $endOfDay])->sum(DB::raw('valor - desconto'));
        $despesa = fluxo_caixa::where('tipo_id', 2)->where('pagamento_id', 1)->where('user_id', Auth::id())->whereBetween('data', [$startOfDay, $endOfDay])->sum('valor');
        return $receita-$despesa;
    }
}
