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
$routes->setDefaultController('Authentication\Login\Index');
$routes->setDefaultMethod('index');
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

// Ajax


$routes->post('ajax/fileupload', 'Common\Ajax::fileupload');
$routes->post('searchevents', 'Site\Event\Index::searchevents');

// Validation
$routes->post('validation/emailvalidation', 'Common\Validation::emailvalidation');

$routes->match(['get', 'post'], '/', 'Site\Home\Index::index');	
$routes->match(['get','post'], 'login', 'Site\Login\Index::index', ['filter' => 'siteauthentication1']);
$routes->match(['get','post'], 'register', 'Site\Register\Index::index', ['filter' => 'siteauthentication1']);
$routes->get('verification/(:any)', 'Site\Register\Index::verification/$1');
$routes->match(['get','post'], 'events', 'Site\Event\Index::lists');
$routes->match(['get','post'], 'events/detail/(:num)', 'Site\Event\Index::detail/$1');
$routes->match(['get','post'], 'stalls', 'Site\Stall\Index::index');
$routes->match(['get','post'], 'stalls/detail/(:num)', 'Site\Stall\Index::detail/$1');
$routes->match(['get','post'], 'checkout', 'Site\Checkout\Index::index');
$routes->post('cart', 'Site\Event\CartController::index');

$routes->get('logout', 'Site\Logout\Index::index');

$routes->group('myaccount', ['filter' => 'siteauthentication2'], function($routes){
	$routes->match(['get','post'], 'dashboard', 'Site\Myaccount\Dashboard\Index::index');
    $routes->match(['get','post'], 'events', 'Site\Myaccount\Event\Index::index');
    $routes->match(['get','post'], 'events/add', 'Site\Myaccount\Event\Index::action'); 
    $routes->match(['get','post'], 'events/edit/(:num)', 'Site\Myaccount\Event\Index::action/$1');
    $routes->match(['get','post'], 'subscription', 'Site\Myaccount\Subscription\Index::index');
});

$routes->match(['get', 'post'], '/administrator', 'Admin\Login\Index::index', ['filter' => 'adminauthentication1']);	
$routes->group('administrator', ['filter' => 'adminauthentication2'], function($routes){    
	$routes->get('logout', 'Admin\Logout\Index::index');
	
	// Users
    $routes->match(['get', 'post'], 'users', 'Admin\Users\Index::index');
    $routes->match(['get', 'post'], 'users/action', 'Admin\Users\Index::action');
    $routes->get('users/action/(:num)', 'Admin\Users\Index::action/$1');
    $routes->post('users/DTusers', 'Admin\Users\Index::DTusers');
	
	// Event
    $routes->match(['get', 'post'], 'event', 'Admin\Event\Index::index');
    $routes->match(['get', 'post'], 'event/action', 'Admin\Event\Index::action');
    $routes->get('event/action/(:num)', 'Admin\Event\Index::action/$1');
    $routes->post('event/DTevent', 'Admin\Event\Index::DTevent');
    $routes->get('event/view/(:num)', 'Admin\Event\Index::view/$1');
  
	// Settings
    $routes->match(['get', 'post'], 'settings', 'Admin\Settings\Index::index');
});

//Api route
$routes->group('api', ['filter' => 'apiauthentication'], function($routes){    
    $routes->post('verification/(:any)', 'Api\Register\Index::verification/$1');
    
    //Register table api
    $routes->post('register', 'Api\Register\Index::action');
    $routes->post('login','Api\Login\Index::index');
    
    //Users table api
    $routes->post('listUser', 'Api\Users\Index::index');
    $routes->post('getUserById', 'Api\Users\Index::index/1');
    $routes->post('addUser', 'Api\Users\Index::action');
    $routes->post('editUser', 'Api\Users\Index::action/1');
    $routes->post('deleteUser', 'Api\Users\Index::delete');
    
    //Event table api
    $routes->post('addEvent', 'Api\Event\Index::action');
    $routes->post('listEvent', 'Api\Event\Index::Index');
    $routes->post('getEventById', 'Api\Event\Index::Index/1');
    
    //Barn table api
    $routes->post('addBarn', 'Api\Barn\Index::action');
    $routes->post('listBarn', 'Api\Barn\Index::index');
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
