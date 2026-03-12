<?php

namespace App\Models;

use CodeIgniter\Model;

class RecipeModel extends Model {

    protected $table = 'receitas';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'nome',
        'descricao',
        'categoria',
        'tempo_preparo',
        'porcoes',
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