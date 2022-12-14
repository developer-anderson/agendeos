<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veiculos extends Model
{
    use HasFactory;
    protected $fillable = [
        'placa', 'marca', 'modelo', 'cor', 'id_cliente', 'observacoes'
    ];
}
