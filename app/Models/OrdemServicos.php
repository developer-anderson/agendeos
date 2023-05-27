<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdemServicos extends Model
{
    use HasFactory;

    protected $fillable =
    ['id_cliente', 'id_servico', 'id_veiculo', 'remarketing','id_funcionario' , 'situacao', 'inicio_os', 'previsao_os' , 'observacoes', 'user_id'];
}
