<?php

if (! function_exists('is_logged_in')) {
    /**
     * Verifica se o usuário atual está logado no sistema
     */
    function is_logged_in(): bool
    {
        return session()->has('logged_in') && session()->get('logged_in') === true;
    }
}

if (! function_exists('user_name')) {
    /**
     * Retorna o nome do usuário logado (ou vazio se não estiver)
     */
    function user_name(): string
    {
        return session()->get('user_name') ?? '';
    }
}

if (! function_exists('user_email')) {
    /**
     * Retorna o email do usuário logado (ou vazio se não estiver)
     */
    function user_email(): string
    {
        return session()->get('user_email') ?? '';
    }
}

if (! function_exists('user_id')) {
    /**
     * Retorna o ID do usuário no banco de dados
     */
    function user_id()
    {
        return session()->get('user_id');
    }
}