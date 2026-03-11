<?php

namespace App\Models;

use CodeIgniter\Model;

class RecipeModel extends Model {

    protected $table = 'recipes';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'nome', // ok
        'calorias',
        'tempo_preparo',
        'difuculdade',
        'proteina',
        'carboidratos',
        'gordura',
        'ingredientes',
        'modo_preparo',
        'regras',
        'category_id',
        'imagem',
    ];

    public function allRecipes()
    {
        return $this -> findAll();
    }

    public function findByName($name)
    {
        return $this -> where('nome', $name)->first();
    }

}