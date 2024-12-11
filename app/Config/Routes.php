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

