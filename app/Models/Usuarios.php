<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'email', 'telefone', 'cpf', 'data_nascimento', 'senha', 'dthr_criacao', 'dthr_atualizacao', 'id_perfil', 'cep', 'logradouro', 'complemento', 'numero', 'cidade','estado' ,'pais'];
}
