<?php

use App\Models\UserModel;

if (!function_exists('meta_calorias_diaria')) {

    function meta_calorias_diaria($usuarioId)
    {
        $usuarioModel = new UserModel();

        $usuario = $usuarioModel->find($usuarioId);

        return $usuario['meta_calorias_diaria'] ?? 2000;
    }
}

if (!function_exists('calorias_hoje')) {

    function calorias_hoje($usuarioId)
    {
        $db = \Config\Database::connect();

        $result = $db->table('refeicoes_usuario ru')
            ->select('SUM(a.calorias * ri.quantidade) as total')
            ->join('receitas r', 'r.id = ru.receita_id')
            ->join('receita_ingredientes ri', 'ri.receita_id = r.id')
            ->join('alimentos a', 'a.id = ri.alimento_id')
            ->where('ru.usuario_id', $usuarioId)
            ->where('ru.data_refeicao', date('Y-m-d'))
            ->get()
            ->getRowArray();

        return round($result['total'] ?? 0);
    }
}

if (!function_exists('calorias_restantes')) {

    function calorias_restantes($usuarioId)
    {
        $meta = meta_calorias_diaria($usuarioId);
        $consumido = calorias_hoje($usuarioId);

        return $meta - $consumido;
    }
}

if (!function_exists('percentual_calorias')) {

    function percentual_calorias($usuarioId)
    {
        $meta = meta_calorias_diaria($usuarioId);
        $consumido = calorias_hoje($usuarioId);

        if ($meta == 0) {
            return 0;
        }

        return min(100, round(($consumido / $meta) * 100));
    }
}

if (!function_exists('formatar_numero')) {

    function formatar_numero($numero)
    {
        return number_format($numero, 0, ',', '.');
    }
}