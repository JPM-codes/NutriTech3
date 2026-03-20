<?php

namespace App\Models;

use CodeIgniter\Model;

class RefeicoesUserModel extends Model
{
    
    protected $table = 'refeicoes_usuario';

    protected $allowedFields = [
        'usuario_id',
        'receita_id',
        'tipo_refeicao',
        'data_refeicao'
    ];

    // Métodos para getReceitas
    public function getAllReceitas($user)
    {
        return $this->where('usuario_id', $user)->findAll();
    }

public function getAllReceitasHoje($user)
{
    return $this->db
        ->table('refeicoes_usuario ru')
        ->select('
            ru.tipo_refeicao,
            r.id,
            r.nome,
            ROUND(SUM((a.calorias / 100 * ri.quantidade))) as calorias
        ')
        ->join('receitas r', 'r.id = ru.receita_id')
        ->join('receita_ingredientes ri', 'ri.receita_id = r.id')
        ->join('alimentos a', 'a.id = ri.alimento_id')
        ->where('ru.usuario_id', $user)
        ->where('ru.data_refeicao >=', date('Y-m-d 00:00:00'))
        ->where('ru.data_refeicao <', date('Y-m-d 00:00:00', strtotime('+1 day')))
        ->groupBy('ru.tipo_refeicao, r.id')
        ->get()
        ->getResultArray();
}

    public function getAllReceitasSemana($user)
    {
        return $this->where('usuario_id', $user)
            ->select("
                YEAR(data_refeicao) as ano,
                WEEK(data_refeicao, 1) as semana,
                SUM(valor) as total
            ")
            ->groupBy('YEAR(data_refeicao), WEEK(data_refeicao, 1)')
            ->orderBy('ano', 'ASC')
            ->orderBy('semana', 'ASC')
            ->findAll();
    }

}