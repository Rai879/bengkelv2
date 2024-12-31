<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('login', 'Auth::index');
$routes->post('login', 'Auth::index');
$routes->post('login/auth', 'Auth::auth');
$routes->get('logout', 'Logout::index');


// Parts
$routes->get('parts', 'Parts::index');
$routes->get('parts/add', 'Parts::add');
$routes->post('parts/saveData', 'Parts::saveData');
$routes->post('parts/delete', 'Parts::delete');
$routes->get('parts/edit/(:any)', 'Parts::edit/$1');
$routes->post('parts/update', 'Parts::updateData');


// Users
$routes->group('users', ['filter' => 'admin'], function($routes) {
    $routes->get('', 'Users::index');
    $routes->get('edit/(:num)', 'Users::edit/$1');
    $routes->post('save', 'Users::save');
    $routes->get('delete/(:num)', 'Users::delete/$1');
});
