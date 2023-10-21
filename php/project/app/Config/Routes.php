<?php

namespace Config;

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
$routes->get('/', 'Home::index');
$routes->get('/home', 'Home::index');

$routes->get('/myprofile', 'MyProfile::index');

$routes->get('/login', 'Login::index');
$routes->post('/login/check_login', 'Login::check_login');
$routes->get('/login/logout', 'Login::logout');
$routes->get('/login/forgotPasswordPage', 'Login::forgotPasswordPage');
$routes->post('/login/getCode', 'Login::getCode');
$routes->post('/login/checkCode', 'Login::checkCode');
$routes->post('/login/changePassword', 'Login::changePassword');


$routes->get('/signup', 'SignUp::index');
$routes->get('/signup/register', 'SignUp::register');
$routes->post('/(.*)/register', 'SignUp::register');
$routes->get('/signup/confirmEmail', 'SignUp::confirmEmail');
$routes->get('/signup/reVerify', 'SignUp::reVerify');

$routes->get('/myprofile', 'MyProfile::index');
$routes->post('/myprofile/updateProfile', 'MyProfile::updateProfile');
$routes->post('/myprofile/resetPassword', 'MyProfile::resetPassword');
$routes->match(['get', 'post'], '/myprofile/resetPassword', 'MyProfile::resetPassword');
$routes->post('/myprofile/changePassword', 'MyProfile::changePassword');

$routes->post('/home/addCat', 'Home::addCat');


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
