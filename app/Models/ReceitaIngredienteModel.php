<?php

namespace App\Models;

use CodeIgniter\Model;

class ReceitaIngredienteModel extends Model
{
    protected $table = 'receita_ingredientes';
    protected $allowedFields = [
        'receita_id',
        'alimento_id',
        'quantidade',
        'unidade_id',
    ];
}