<?php

namespace App\Models;

use CodeIgniter\Model;

class RecipeModel extends Model
{

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
        return $this->findAll();
    }

    public function findByName($name)
    {
        return $this->where('nome', $name)->first();
    }


    public function getReceitasComMacros()
    {
        return $this->db->table('receitas')
            ->select('
                receitas.*,
                ROUND(SUM((alimentos.proteinas / 100) * receita_ingredientes.quantidade), 1) AS proteinas,
                ROUND(SUM((alimentos.carboidratos / 100) * receita_ingredientes.quantidade), 1) AS carboidratos,
                ROUND(SUM((alimentos.gorduras / 100) * receita_ingredientes.quantidade), 1) AS gordura,
                ROUND(SUM((alimentos.calorias / 100) * receita_ingredientes.quantidade), 0) AS calorias
            ')
            ->join('receita_ingredientes', 'receita_ingredientes.receita_id = receitas.id')
            ->join('alimentos', 'alimentos.id = receita_ingredientes.alimento_id')
            ->groupBy('receitas.id')
            ->get()
            ->getResultArray();
    }


    public function getReceitaComMacros($receitaId)
    {
        return $this->db->table('receitas')
            ->select('
            receitas.*,
            ROUND(SUM((alimentos.proteinas / 100) * receita_ingredientes.quantidade), 1) AS proteinas,
            ROUND(SUM((alimentos.carboidratos / 100) * receita_ingredientes.quantidade), 1) AS carboidratos,
            ROUND(SUM((alimentos.gorduras / 100) * receita_ingredientes.quantidade), 1) AS gordura,
            ROUND(SUM((alimentos.calorias / 100) * receita_ingredientes.quantidade), 0) AS calorias
        ')
            ->join('receita_ingredientes', 'receita_ingredientes.receita_id = receitas.id')
            ->join('alimentos', 'alimentos.id = receita_ingredientes.alimento_id')
            ->where('receitas.id', $receitaId)
            ->groupBy('receitas.id')
            ->get()
            ->getRowArray();
    }

    public function getReceitasFiltradas($categoria = 'all', $busca = '')
    {
        $builder = $this->db->table('receitas')
            ->select('
            receitas.*,
            ROUND(SUM((alimentos.proteinas / 100) * receita_ingredientes.quantidade), 1) AS proteinas,
            ROUND(SUM((alimentos.carboidratos / 100) * receita_ingredientes.quantidade), 1) AS carboidratos,
            ROUND(SUM((alimentos.gorduras / 100) * receita_ingredientes.quantidade), 1) AS gordura,
            ROUND(SUM((alimentos.calorias / 100) * receita_ingredientes.quantidade), 0) AS calorias
        ')
            ->join('receita_ingredientes', 'receita_ingredientes.receita_id = receitas.id', 'left')
            ->join('alimentos', 'alimentos.id = receita_ingredientes.alimento_id', 'left');

        if ($categoria !== 'all') {
            $builder->where('receitas.categoria', $categoria);
        }

        if (!empty($busca)) {
            $builder->like('receitas.nome', $busca);
        }

        return $builder->groupBy('receitas.id')->get()->getResultArray();
    }
}
