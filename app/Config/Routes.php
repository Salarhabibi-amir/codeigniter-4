<?php

namespace Config;

use App\Controllers\UserController;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

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
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/dashboard', 'UserController::getData');
$routes->get('login', 'Home::login');
// $routes->get('login', 'Home::login');


$routes->get('signup', 'UserController::signup');
$routes->post('rigester', 'UserController::setData');
$routes->get('getUsers', 'UserController::getData');
$routes->get('delete/(:num)', 'UserController::delete/$1');
$routes->get('deleteProfile/(:num)', 'UserController::deleteProfile/$1');
$routes->get('edit/(:num)', 'UserController::edit/$1');
$routes->post('edit/update/', 'UserController::update');
$routes->get('editPassword/(:num)','UserController::editPassword/$1');
$routes->post('editPassword/updatePass/', 'UserController::updatePassword');


$routes->post('logedIn', 'UserController::logedin');
$routes->get('logOut', 'UserController::logOut');

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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
