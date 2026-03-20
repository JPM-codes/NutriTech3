<?php

use App\Models\UserModel;
use Config\Database;

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
        $db = Database::connect();

        $hoje = date('Y-m-d');

        $result = $db->table('refeicoes_usuario ru')
            ->select('COALESCE(SUM(COALESCE(a.calorias,0)/100 * COALESCE(ri.quantidade,0)),0) as total')
            ->join('receitas r', 'r.id = ru.receita_id', 'left')
            ->join('receita_ingredientes ri', 'ri.receita_id = r.id', 'left')
            ->join('alimentos a', 'a.id = ri.alimento_id', 'left')
            ->where('ru.usuario_id', $usuarioId)
            ->where('ru.data_refeicao >=', $hoje . ' 00:00:00')
            ->where('ru.data_refeicao <', date('Y-m-d 00:00:00', strtotime($hoje . ' +1 day')))
            ->get()
            ->getRowArray();

        return round((float) $result['total']);
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