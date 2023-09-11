<?php

use CodeIgniter\Router\RouteCollection;


/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');

$routes->group('user', ['filter' => 'cors'], static function ($routes) {
    $routes->get('profile/(:segment)', 'UserController::show/$1');
    $routes->post('register', 'UserController::register');
    $routes->post('login', 'UserController::login');
});

$routes->group('article', ['filter' => 'cors'], static function ($routes) {
    $routes->get('category', 'ArticleController::getCategory');
    $routes->get('list', 'ArticleController::index');
    $routes->post('create', 'ArticleController::create', ['filter' => 'cors', 'auth']);
    $routes->get('data/(:segment)', 'ArticleController::show/$1');
    $routes->put('update/(:segment)', 'ArticleController::update/$1', ['filter' => 'cors', 'auth']);
    $routes->delete('delete/(:segment)', 'ArticleController::delete/$1', ['filter' => 'cors', 'auth']);
});
