<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class servico extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'descricao',
        'duracao',
        'preco',
        'name_profissional'

    ];
}
