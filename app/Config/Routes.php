<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('/akun1', 'Akun1::index');
$routes->get('/akun1/new', 'Akun1::new');
$routes->post('/akun1', 'Akun1::store');
$routes->get('/akun1/edit/(:any)', 'Akun1::edit/$1');
$routes->put('/akun1/edit/(:any)', 'Akun1::update/$1');
$routes->delete('/akun1/(:any)', 'Akun1::destroy/$1');

$routes->get('/akun2/new', 'Akun2::new');
$routes->put('/akun2/(:segment)', 'Akun2::update/$1');
$routes->post('/akun2/(:any)', 'Akun2::delete/$1');
$routes->resource('akun2');

$routes->get('/akun3/new', 'Akun3::new');
$routes->get('/akun3/(:segment)/edit', 'Akun3::edit/$1');
$routes->post('/akun3/new', 'Akun3::create');
$routes->resource('akun3');

// agar dropdown akun3 dan status muncul harus berada di atas path "(:any)" dan "(:segment)"
$routes->get('/transaksi/status', 'Transaksi::status');
$routes->get('/transaksi/akun3', 'Transaksi::akun3');
$routes->get('/transaksi/new', 'Transaksi::new');
$routes->get('/transaksi/(:segment)/edit', 'Transaksi::edit/$1');
$routes->get('/transaksi/(:any)', 'Transaksi::show/$1');
$routes->post('/transaksi', 'Transaksi::create');
$routes->get('/transaksi', 'Transaksi::index');
$routes->resource('transaksi');

$routes->get('/penyesuaian/(:segment)/edit', 'Penyesuaian::edit/$1');
$routes->post('/penyesuaian/(:any)', 'Penyesuaian::delete/$1');
$routes->get('/penyesuaian/(:any)', 'Penyesuaian::show/$1');
$routes->resource('penyesuaian');

$routes->post('/jurnalumum/cetakjupdf', 'JurnalUmum::cetakjupdf');
$routes->post('/jurnalumum', 'JurnalUmum::index');
$routes->resource('jurnalumum');

$routes->post('/posting/postingpdf', 'Posting::postingpdf');
$routes->post('/posting', 'Posting::index');
$routes->resource('posting');

$routes->post('/jurnalpenyesuaian', 'JurnalPenyesuaian::index');
$routes->resource('jurnalpenyesuaian');

$routes->post('/neracasaldo/neracasaldopdf', 'NeracaSaldo::neracasaldopdf');
$routes->post('/neracasaldo', 'NeracaSaldo::index');
$routes->resource('neracasaldo');