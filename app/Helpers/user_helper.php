<?php


if (!function_exists('activity_option')) {
    function activity_option($value, $title, $description, $emoji, $current = null)
    {

        $isActive = $current === $value;

        // Classes base para podermos alternar depois via JS
        $activeClass = $isActive
            ? 'bg-primary/10 border-2 border-primary is-active'
            : 'bg-gray-50 hover:bg-gray-100 border-2 border-transparent';

        $textClass = $isActive ? 'text-primary' : 'text-gray-800';

        // O check agora sempre existe, mas fica escondido (hidden) se não for o ativo
        $checkDisplay = $isActive ? '' : 'hidden';
        $check = "<span class=\"text-primary icon-check {$checkDisplay}\">✓</span>";

        $url = base_url('perfil/atualizar');

        // Note o 'this' no onclick
        return "
        <button type=\"button\" 
                onclick=\"enviarAtualizacao(this, '{$url}', '{$value}')\" 
                class=\"btn-atividade w-full flex items-center gap-3 p-3 rounded-xl transition-colors {$activeClass}\">
            
            <span class=\"text-2xl\">{$emoji}</span>

            <div class=\"text-left flex-1\">
                <p class=\"titulo-atividade font-medium {$textClass}\">{$title}</p>
                <p class=\"text-xs text-gray-500\">{$description}</p>
            </div>

            {$check}
        </button>
        ";
    }
}

if (!function_exists('imc')) {
    function calcularIMC($peso, $altura)
    {
        if ($altura <= 0) return 0;
        $imc = $peso / ($altura * $altura);
        return round($imc, 2);
    }

    function imc($peso, $altura)
    {
        $resultado = calcularIMC($peso, $altura);

        // Clasificación simple
        if ($resultado < 18.5) $status = "Peso baixo";
        elseif ($resultado < 25) $status = "Peso normal";
        elseif ($resultado < 30) $status = "Acima do peso";
        else $status = "Obesidade";
        return $status;
    }
}

if (!function_exists('calculateSuggestedCalories')) {

    function calculateSuggestedCalories($goal, $user, $meta)
    {
        $bmr = 10 * $user['peso'] + 6.25 * $user['altura'] - 5 * $user['idade'] + 5;
        $activityMultipliers = [
            '1' => 1.2,
            '2' => 1.375,
            '3' => 1.55,
            '4' => 1.755
        ];
        $tdee = $bmr * ($activityMultipliers[$meta['nivel_atividade']]);

        switch ($goal) {
            case 'lose':
                return round($tdee - 500);
            case 'gain':
                return round($tdee + 300);
            default:
                return round($tdee);
        }
    }
}
