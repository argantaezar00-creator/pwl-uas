<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ===== AUTH =====
$routes->get('/', 'AuthController::index');
$routes->get('/login', 'AuthController::index');
$routes->post('/login', 'AuthController::login');
$routes->get('/logout', 'AuthController::logout');

// ===== PROTECTED ROUTES =====
$routes->group('', ['filter' => 'auth'], function ($routes) {

    // Dashboard
    $routes->get('/dashboard', 'DashboardController::index');

    // ===== LAYANAN =====
    $routes->get('/layanan', 'LayananController::index');
    $routes->get('/layanan/create', 'LayananController::create');
    $routes->post('/layanan/store', 'LayananController::store');
    $routes->get('/layanan/edit/(:num)', 'LayananController::edit/$1');
    $routes->post('/layanan/update/(:num)', 'LayananController::update/$1');
    $routes->get('/layanan/delete/(:num)', 'LayananController::delete/$1');
    $routes->get('/layanan/trash', 'LayananController::trash');
    $routes->get('/layanan/restore/(:num)', 'LayananController::restore/$1');
    $routes->get('/layanan/force-delete/(:num)', 'LayananController::forceDelete/$1');
    $routes->get('/layanan/export-pdf', 'LayananController::exportPdf');

    // ===== PELANGGAN =====
    $routes->get('/pelanggan', 'PelangganController::index');
    $routes->get('/pelanggan/create', 'PelangganController::create');
    $routes->post('/pelanggan/store', 'PelangganController::store');
    $routes->get('/pelanggan/edit/(:num)', 'PelangganController::edit/$1');
    $routes->post('/pelanggan/update/(:num)', 'PelangganController::update/$1');
    $routes->get('/pelanggan/delete/(:num)', 'PelangganController::delete/$1');
    $routes->get('/pelanggan/trash', 'PelangganController::trash');
    $routes->get('/pelanggan/restore/(:num)', 'PelangganController::restore/$1');
    $routes->get('/pelanggan/force-delete/(:num)', 'PelangganController::forceDelete/$1');

    // ===== CART =====
    $routes->get('/cart', 'CartController::index');
    $routes->post('/cart/add', 'CartController::add');
    $routes->post('/cart/update', 'CartController::update');
    $routes->get('/cart/remove/(:any)', 'CartController::remove/$1');
    $routes->get('/cart/destroy', 'CartController::destroy');
});
