<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicos extends Model
{
    use HasFactory;
    protected $fillable = 
    ['nome', 'valor', 'tempo_estimado', 'observacoes', 'user_id'];
}
