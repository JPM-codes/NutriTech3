<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Routes group
$routes -> group('auth', static function($routes) {
    $routes->get('/', 'Auth::index');
    $routes->get('logout', 'Auth::logout');
    $routes->post('login', 'Auth::login');
    $routes->post('register', 'Auth::register');
});

$routes -> group('dashboard', ['filter' => 'auth'], static function($routes){
    $routes->get('/','Dashboard::index');
    $routes->post('updateWater','Dashboard::updateWater');
    $routes->post('adicionarAlimento','Dashboard::adicionarAlimento');
    });
    
$routes -> group('receitas', ['filter' => 'auth'] , static function($routes) {
        $routes->get('/', 'Receitas::index');
        $routes->get('filtrar','Receitas::filtrarReceitas');
        $routes->get('detalhes/(:num)','Receitas::detalhes/$1');
        $routes->post('adicionar','Receitas::adicionar');
        $routes->post('remover','Receitas::remover');
    });

$routes -> group('perfil', ['filter' => 'auth'], static function($routes) {
    $routes->get('/', 'Profile::index');
    $routes->post('atualizar','Profile::atualizar');
    $routes->post('atualizarPerfil','Profile::atualizarPerfil');
    $routes->post('atualizarCalorias','Profile::atualizarCalorias');
    $routes->post('criar','Profile::criar');
});
