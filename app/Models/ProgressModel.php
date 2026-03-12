<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgressModel extends Model
{
    protected $table = 'progresso_usuario';
    protected $allowedFields = [
        'usuario_id',
        'peso',
        'gordura_corporal'
    ];
}