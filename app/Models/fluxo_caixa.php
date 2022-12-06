<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fluxo_caixa extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'valor', 'nome','pagamento_id', 'os_id', 'data', 'produto_id', 'cliente_id'];
}
