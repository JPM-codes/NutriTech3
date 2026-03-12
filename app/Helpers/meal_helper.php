<?php

if (!function_exists('renderizar_secao_refeicao')) {

    function renderizar_secao_refeicao($key, $titulo, $refeicoes = [])
    {
        $html = '<div class="bg-white rounded-xl shadow p-3">';
        $html .= '<div class="flex justify-between items-center">';
        $html .= '<h4 class="font-medium text-gray-700">'.$titulo.'</h4>';
        $html .= '<button onclick="openMealModal(\''.$key.'\')" 
                    class="text-sm bg-green-500 text-white px-2 py-1 rounded">
                    +
                  </button>';
        $html .= '</div>';

        if (empty($refeicoes)) {

            $html .= '<p class="text-sm text-gray-400 mt-2">Nenhuma refeição registrada</p>';

        } else {

            $html .= '<ul class="mt-2 text-sm text-gray-600 space-y-1">';

            foreach ($refeicoes as $refeicao) {

                $nome = $refeicao['nome'] ?? 'Receita';
                $calorias = $refeicao['calorias'] ?? 0;

                $html .= '<li class="flex justify-between">';
                $html .= '<span>'.$nome.'</span>';
                $html .= '<span class="text-gray-400">'.$calorias.' kcal</span>';
                $html .= '</li>';
            }

            $html .= '</ul>';
        }

        $html .= '</div>';

        return $html;
    }
}