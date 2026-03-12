<?php

if (!function_exists('agua_hoje')) {

    function agua_hoje($usuarioId)
    {
        $db = \Config\Database::connect();

        $result = $db->table('controle_agua')
            ->selectSum('quantidade_ml', 'total')
            ->where('usuario_id', $usuarioId)
            ->where('data_registro', date('Y-m-d'))
            ->get()
            ->getRowArray();

        return $result['total'] ?? 0;
    }
}

if (!function_exists('percentual_agua')) {

    function percentual_agua($ml, $meta = 2000)
    {
        return min(100, round(($ml / $meta) * 100));
    }
}