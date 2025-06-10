<?php

namespace Config;

use CodeIgniter\Router\RouteCollection;

$routes = Services::routes();

if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// Public routes
$routes->get('/', 'Home::index');
$routes->get('auth/login', 'Auth::login');
$routes->post('auth/login', 'Auth::login');
$routes->get('auth/register', 'Auth::register');
$routes->post('auth/register', 'Auth::register');
$routes->get('auth/logout', 'Auth::logout');

// User routes (requires authentication)
$routes->group('', ['filter' => 'auth'], function($routes) {
    $routes->get('dashboard', 'Dashboard::index');
    $routes->get('profile', 'Profile::index');
    $routes->post('profile/update', 'Profile::update');
});

// Admin routes (requires authentication and admin role)
$routes->group('admin', ['filter' => 'auth:admin'], function($routes) {
    $routes->get('dashboard', 'Admin\Dashboard::index');
    $routes->get('users', 'Admin\Users::index');
    $routes->get('users/edit/(:num)', 'Admin\Users::edit/$1');
    $routes->post('users/update/(:num)', 'Admin\Users::update/$1');
    $routes->get('users/delete/(:num)', 'Admin\Users::delete/$1');
});

// Editor routes (requires authentication and editor role)
$routes->group('editor', ['filter' => 'auth:editor,admin'], function($routes) {
    $routes->get('articles', 'Editor\Articles::index');
    $routes->get('articles/create', 'Editor\Articles::create');
    $routes->post('articles/store', 'Editor\Articles::store');
    $routes->get('articles/edit/(:num)', 'Editor\Articles::edit/$1');
    $routes->post('articles/update/(:num)', 'Editor\Articles::update/$1');
    $routes->get('articles/delete/(:num)', 'Editor\Articles::delete/$1');
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
