<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresas extends Model
{
    use HasFactory;
    protected $table = 'empresas';
    protected $fillable =
    ['razao_social', 'cnpj', 'situacao', 'plano_id', 'segmento_id',  'telefone',
     'cep', 'logradouro', 'numero', 'complemento', 'bairro', 'estado', 'cidade', 'use_terms'];
}
