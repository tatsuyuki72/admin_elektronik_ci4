<?php

use CodeIgniter\Router\RouteCollection;

$routes->get('/', function () {
    return redirect()->to('/admin');
});

/* ================= AUTH ROUTES ================= */

$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::process');
$routes->get('/logout', 'Auth::logout');

/* ================= ADMIN ROUTES (PROTECTED) ================= */

$routes->group('admin', ['filter' => 'auth'], function($routes) {

    // Dashboard
    $routes->get('/', 'Admin::dashboard');

    // Produk
    $routes->get('produk', 'Admin::produk');
    $routes->post('tambah', 'Admin::tambah');
    $routes->get('edit/(:num)', 'Admin::edit/$1');
    $routes->post('update/(:num)', 'Admin::update/$1');
    $routes->get('delete/(:num)', 'Admin::delete/$1');

    // Laporan
    $routes->get('report', 'Admin::report');
    $routes->get('report/pdf', 'Admin::reportPdf');

});
