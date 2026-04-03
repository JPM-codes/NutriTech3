<?php

use App\Models\UserModel;
use Config\Database;

if (!function_exists('macros_hoje')) {

    function macros_hoje($usuarioId)
    {
        $db = Database::connect();

        $result = $db->table('refeicoes_usuario ru')
            ->select('
                SUM(COALESCE((a_ing.proteinas / 100 * ri.quantidade), a_avulso.proteinas)) as proteinas,
                SUM(COALESCE((a_ing.carboidratos / 100 * ri.quantidade), a_avulso.carboidratos)) as carboidratos,
                SUM(COALESCE((a_ing.gorduras / 100 * ri.quantidade), a_avulso.gorduras)) as gorduras
            ')
            // LEFT JOIN para permitir tanto receitas quanto alimentos avulsos
            ->join('receitas r', 'r.id = ru.receita_id', 'left')
            ->join('receita_ingredientes ri', 'ri.receita_id = r.id', 'left')
            ->join('alimentos a_ing', 'a_ing.id = ri.alimento_id', 'left') // Tabela para os ingredientes da receita
            ->join('alimentos a_avulso', 'a_avulso.id = ru.alimento_id', 'left') // Tabela para o alimento adicionado direto
            ->where('ru.usuario_id', $usuarioId)
            ->where('ru.data_refeicao', date('Y-m-d'))
            ->get()
            ->getRowArray();

        return [
            'proteinas' => round($result['proteinas'] ?? 0),
            'carboidratos' => round($result['carboidratos'] ?? 0),
            'gorduras' => round($result['gorduras'] ?? 0),
        ];
    }
}


if (!function_exists('metas_macros')) {

    function metas_macros($usuarioId)
    {
        $usuarioModel = new UserModel();
        $usuario = $usuarioModel->find($usuarioId);

        $calorias = $usuario['meta_calorias_diaria'] ?? 2000;

        $proteinas = ($calorias * 0.30) / 4;
        $carboidratos = ($calorias * 0.40) / 4;
        $gorduras = ($calorias * 0.30) / 9;

        return [
            'proteinas' => round($proteinas),
            'carboidratos' => round($carboidratos),
            'gorduras' => round($gorduras)
        ];
    }
}


if (!function_exists('percentual_macro')) {

    function percentual_macro($valor, $meta)
    {
        if ($meta == 0) {
            return 0;
        }

        $percentual = ($valor / $meta) * 100;

        return min(round($percentual), 100);
    }
}