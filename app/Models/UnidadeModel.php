<?php

namespace App\Models;

use CodeIgniter\Model;

class UnidadeModel extends Model
{
    protected $table = 'unidades';
    protected $allowedFields = [
        'nome'
    ]; 
}