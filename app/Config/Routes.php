<?php

use CodeIgniter\Router\RouteCollection;


/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');

$routes->group('article', static function ($routes) {
    $routes->get('category', 'ArticleController::getCategory');
    $routes->get('list', 'ArticleController::index');
    $routes->post('create', 'ArticleController::create');
    $routes->get('data/(:segment)', 'ArticleController::show/$1');
    $routes->put('update/(:segment)', 'ArticleController::update/$1');
    $routes->delete('delete/(:segment)', 'ArticleController::delete/$1');
});
