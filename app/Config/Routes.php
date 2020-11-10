<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
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

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->post('/getJson/(:any)', 'Home::getJson/$1');

$routes->get('/ikan', 'Ikan::index');
$routes->post('/aksi-ikan', 'Ikan::aksi');
$routes->get('/hapus-ikan/(:any)', 'Ikan::hapus/$1');

$routes->get('/pembeli', 'Pembeli::index');
$routes->post('/aksi-pembeli', 'Pembeli::aksi');
$routes->get('/hapus-pembeli/(:any)', 'Pembeli::hapus/$1');

$routes->get('/admin', 'Admin::index');
$routes->post('/aksi-admin', 'Admin::aksi');
$routes->get('/hapus-admin/(:any)', 'Admin::hapus/$1');

$routes->get('/pemesanan', 'Transaksi::index');
$routes->post('/aksi-pemesanan', 'Transaksi::aksi');
$routes->get('/hapus-pemesanan/(:any)', 'Transaksi::hapus/$1');
$routes->get('/lunas-pemesanan/(:any)', 'Transaksi::status/lunas/$1');
$routes->get('/selesai-pemesanan/(:any)', 'Transaksi::status/selesai/$1');

$routes->get('/login-admin', 'Auth::loginAdmin');
$routes->post('/login-admina', 'Auth::loginAdminA');
$routes->get('/login', 'Auth::login');
$routes->post('/login-aksi', 'Auth::loginA');
$routes->get('/signup', 'Auth::signup');
$routes->post('/signup-aksi', 'Auth::signupA');
$routes->get('/logout', 'Auth::logout');


/**
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
