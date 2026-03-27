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
            // 1. O 'false' aqui evita que o CodeIgniter quebre a fórmula matemática
            // 2. Usamos 100.0 para forçar o banco a calcular as casas decimais corretamente
            ->select('COALESCE(SUM((COALESCE(a.calorias,0) / 100.0) * COALESCE(ri.quantidade,0)), 0) as total', false)
            
            // 3. Ligação DIRETA: Pula a tabela 'receitas' e vai direto para os ingredientes
            ->join('receita_ingredientes ri', 'ri.receita_id = ru.receita_id', 'left')
            ->join('alimentos a', 'a.id = ri.alimento_id', 'left')
            
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