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
$routes->setDefaultController('HomeController');
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

/*
 * --------------------------------------------------------------------
 * Notes
 * --------------------------------------------------------------------
 * 
 * Method post biasa digunakan untuk mengirim data input kedalam controller
 * Method get biasa digunakan untuk mengambil data yang ada didalam controller
 * 
 */


/*
 * --------------------------------------------------------------------
 * LoginController
 * --------------------------------------------------------------------
 */
$routes->get('/', 'HomeController::index'); // alamat '/' mengarahkan ke controller HomeController 

$routes->get('/login', 'LoginController::index'); // alamat '/login' akan mengarahkan ke controller LoginController dan masuk ke function index
$routes->post('/login', 'LoginController::cekLogin');  // alamat '/login' akan mengarahkan ke controller LoginController dan masuk ke function cekLogin dengan method post 
$routes->get('/logout', 'LoginController::logout');  // alamat '/logout' akan mengarahkan ke controller LoginController dan masuk ke function logout


/*
 * --------------------------------------------------------------------
 * DashboardController
 * --------------------------------------------------------------------
 */
$routes->get('/dashboard', 'DashboardController::index', ['filter' => 'auth']); // alamat '/dashboard' akan mengarahkan ke controller DashboardController dan masuk ke function index


/*
 * --------------------------------------------------------------------
 * UserController Controller
 * --------------------------------------------------------------------
 */
$routes->get('/user', 'UserController::index', ['filter' => 'auth']); // alamat '/user' akan mengarahkan ke controller UserController dan masuk ke function index
$routes->get('/user/create', 'UserController::create', ['filter' => 'auth']); // alamat '/user/create' akan mengarahkan ke controller UserController dan masuk ke function create
$routes->post('/user', 'UserController::save', ['filter' => 'auth']); // alamat '/user' akan mengarahkan ke controller UserController dan masuk ke function save dengan method post 
$routes->get('/user/edit/(:any)', 'UserController::edit/$1', ['filter' => 'auth']); // alamat '/user/edit/(:any)' akan mengarahkan ke controller UserController dan masuk ke function edit dengan membawa parameter id user yang di pilih di tabel user
$routes->post('/user/update/(:any)', 'UserController::update/$1', ['filter' => 'auth']); // alamat '/user/update/(:any)' akan mengarahkan ke controller UserController dan masuk ke function update dengan membawa parameter id user yang di pilih di tabel user dan mengirim data inputan untuk di update ke database
$routes->get('/user/delete/(:any)', 'UserController::delete/$1', ['filter' => 'auth']); // alamat '/user/delete/(:any)' akan mengarahkan ke controller UserController dan masuk ke function delete dengan membawa parameter id user yang di pilih di tabel user



/*
 * --------------------------------------------------------------------
 * ProdukController
 * --------------------------------------------------------------------
 */
$routes->get('/produk', 'ProdukController::index', ['filter' => 'auth']); // alamat '/produk' akan mengarahkan ke controller ProdukController dan masuk ke function index
$routes->get('/produk/create', 'ProdukController::create',['filter' => 'auth']); // alamat '/produk/create' akan mengarahkan ke controller ProdukController dan masuk ke function create
$routes->post('/produk', 'ProdukController::save',['filter' => 'auth']); // alamat '/produk' akan mengarahkan ke controller ProdukController dan masuk ke function save dengan method post 
$routes->get('/produk/edit/(:any)', 'ProdukController::edit/$1',['filter' => 'auth']); // alamat '/produk/edit/(:any)' akan mengarahkan ke controller ProdukController dan masuk ke function edit dengan membawa parameter id produk yang di pilih di tabel produk
$routes->post('/produk/update/(:any)', 'ProdukController::update/$1',['filter' => 'auth']); // alamat '/produk/update/(:any)' akan mengarahkan ke controller ProdukController dan masuk ke function update dengan membawa parameter id produk yang di pilih di tabel produk dan mengirim data inputan untuk di update ke database
$routes->get('/produk/delete/(:any)', 'ProdukController::delete/$1',['filter' => 'auth']); // alamat '/produk/delete/(:any)' akan mengarahkan ke controller ProdukController dan masuk ke function delete dengan membawa parameter id produk yang di pilih di tabel user


/*
 * --------------------------------------------------------------------
 * RespondenController
 * --------------------------------------------------------------------
 */
$routes->get('/responden', 'RespondenController::index'); // alamat '/responden' akan mengarahkan ke controller RespondenController dan masuk ke function index
$routes->get('/responden/create/(:any)', 'RespondenController::create/$1'); // alamat '/responden/create' akan mengarahkan ke controller RespondenController dan masuk ke function create
$routes->post('/responden/(:any)', 'RespondenController::save/$1'); // alamat '/responden' akan mengarahkan ke controller RespondenController dan masuk ke function save dengan method post 
$routes->get('/responden/show', 'RespondenController::show', ['filter' => 'auth']); // alamat '/responden/show' akan mengarahkan ke controller RespondenController dan masuk ke function show
$routes->get('/responden/rasio', 'RespondenController::rasio', ['filter' => 'auth']); // alamat '/responden/rasio' akan mengarahkan ke controller RespondenController dan masuk ke function rasio
$routes->get('/responden/export', 'RespondenController::export', ['filter' => 'auth']); // alamat '/responden/export' akan mengarahkan ke controller RespondenController dan masuk ke function export





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
