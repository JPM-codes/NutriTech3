<?php

use App\Models\UserModel;
use Config\Database;

if (!function_exists('macros_hoje')) {

    function macros_hoje($usuarioId)
    {
        $db = Database::connect();

        $result = $db->table('refeicoes_usuario ru')
            ->select('
                SUM(a.proteinas * ri.quantidade) as proteinas,
                SUM(a.carboidratos * ri.quantidade) as carboidratos,
                SUM(a.gorduras * ri.quantidade) as gorduras
            ')
            ->join('receitas r', 'r.id = ru.receita_id')
            ->join('receita_ingredientes ri', 'ri.receita_id = r.id')
            ->join('alimentos a', 'a.id = ri.alimento_id')
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