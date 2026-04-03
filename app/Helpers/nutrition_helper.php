<?php

use App\Models\MetasModel;
use App\Models\UserModel;
use Config\Database;

if (!function_exists('meta_calorias_diaria')) {

    function meta_calorias_diaria($usuarioId)
    {
        $usuarioModel = new UserModel();
        $metasModel = new MetasModel();

        $usuario = $usuarioModel->find($usuarioId);
        $metas = $metasModel->where('usuario_id', $usuario['id'])->first();

        return $metas['meta_calorias'] ?? 2000;
    }
}

if (!function_exists('calorias_hoje')) {
    function calorias_hoje($usuarioId)
    {
        $db = Database::connect();
        $hoje = date('Y-m-d');

        $result = $db->table('refeicoes_usuario ru')
            ->select('COALESCE(SUM(COALESCE((a_ing.calorias / 100.0) * ri.quantidade, a_avulso.calorias)), 0) as total', false)

            ->join('receitas r', 'r.id = ru.receita_id', 'left')
            ->join('receita_ingredientes ri', 'ri.receita_id = r.id', 'left')
            ->join('alimentos a_ing', 'a_ing.id = ri.alimento_id', 'left')

            ->join('alimentos a_avulso', 'a_avulso.id = ru.alimento_id', 'left')

            ->where('ru.usuario_id', $usuarioId)
            ->where('ru.data_refeicao', $hoje)
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