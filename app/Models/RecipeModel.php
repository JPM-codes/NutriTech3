<?php

namespace App\Models;

use CodeIgniter\Model;

class RecipeModel extends Model {

    protected $table = 'recipes';
    protected $primaryKey = 'recipe_id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'recipe_nome',
        'recipe_ingredientes',
        'recipe_modo_preparo',
        'recipe_tempo_reparo',
        'recipe_unidades',
        'recipe_porcoes',
        'recipe_regras',
        'recipe_restricao_alimentar',
        'recipe_dificuldade',
        'recipe_feedback',
        'category_id',
        'combinacao_id',
        'recipe_imagem',
        'recipe_video'
    ];

    public function allRecipes()
    {
        return $this -> findAll();
    }

    public function findByName($name)
    {
        return $this -> where('recipe_nome', $name)->first();
    }

}