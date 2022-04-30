<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('ingresar');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->post('auth/ingresar', 'Auth::checkLogin');
$routes->post('auth/registro', 'Auth::save');
$routes->get('auth/logout', 'Auth::logout');
$routes->post('auth/clave/recuperar', 'Auth::sendMailTokenPassword');
$routes->post('auth/clave/actualizar', 'Auth::updatePassword');


/** routes group of logged in user */
$routes->group('', ['filter' => 'AlreadyLoggedIn'], function($routes) {
    $routes->get('/', 'Auth::login');
    $routes->get('auth/ingresar', 'Auth::login');
    $routes->get('auth/registro', 'Auth::register');
    $routes->get('auth/clave/recuperar', 'Auth::forgotPassword');
    $routes->get('auth/clave/actualizar', 'Auth::resetPassword');
});


/** routes group of admin profile */
$routes->group('admin', ['filter' => 'AuthCheck'], function($routes) {
    /** service users */
    $routes->get('gestion/usuarios', 'Admin::listAllUsers');
    $routes->get('gestion/usuarios/activos', 'Admin::listActiveUsers');
    $routes->get('gestion/usuarios/bloqueados', 'Admin::listBlockUsers');
    $routes->post('gestion/usuario/activar', 'Admin::activateUserById');
    $routes->post('gestion/usuario/bloquear', 'Admin::blockUserById');
    $routes->get('gestion/usuario/(:num)', 'Admin::viewUser/$1');


    /** service beta users */
    $routes->get('beta/usuarios', 'Admin::listAllBetaUsers');
    $routes->get('beta/usuarios/activos', 'Admin::listActiveBetaUsers');
    $routes->get('beta/usuarios/bloqueados', 'Admin::listBlockBetaUsers');
    $routes->post('beta/usuario/activar', 'Admin::activateBetaUserById');
    $routes->post('beta/usuario/bloquear', 'Admin::blockBetaUserById');
    $routes->get('beta/usuario/(:num)', 'Admin::viewBetaUser/$1');


    /** routes of admin profile */
    $routes->get('perfil', 'Admin::viewMyProfile');
    $routes->get('perfil/editar', 'Admin::editMyProfile');
    $routes->post('perfil/basico/guardar', 'Admin::saveMyProfile');
    $routes->post('perfil/seguridad/guardar', 'Admin::changeMyPassword');
});


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
