<?php

namespace App\Models;

use CodeIgniter\Model;

class FoodModel extends Model
{
    protected $table = 'alimentos';
    protected $allowedFields = [
        'nome',
        'calorias',
        'proteinas',
        'carboidratos',
        'gorduras'
    ];

    public function allFoods()
    {
        return $this->findAll();
    }


}