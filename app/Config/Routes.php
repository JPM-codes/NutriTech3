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
    $routes->get('recipes','Dashboard::recipes');
    $routes->post('updateWater','Dashboard::updateWater');
});
