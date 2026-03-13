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

$routes -> group('dashboard', static function($routes){
    $routes->get('/','Dashboard::index');
    $routes->get('receitas','Dashboard::receitas');
    $routes->get('receitas/filtrar','Dashboard::filtrarReceitas');
    $routes->get('receitas/detalhes/(:num)','Dashboard::detalhes/$1');
    $routes->post('updateWater','Dashboard::updateWater');
});
