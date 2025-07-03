<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// =====================
// 🔐 Authentication
// =====================
$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::login');
$routes->get('logout', 'AuthController::logout');

// =====================
// 🏠 Dashboard Home
// =====================
$routes->get('/', 'Home::index', ['filter' => 'auth']);

// =====================
// 📦 Produk (CRUD)
// =====================
$routes->group('produk', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'ProdukController::index');
    $routes->post('/', 'ProdukController::create');
    $routes->post('edit/(:num)', 'ProdukController::edit/$1');
    $routes->get('delete/(:num)', 'ProdukController::delete/$1');
});

// =====================
// 🛒 Keranjang
// =====================
$routes->group('keranjang', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'TransaksiController::index');
    $routes->get('add/(:num)', 'TransaksiController::add/$1');
    $routes->get('delete/(:any)', 'TransaksiController::cart_delete/$1');
    $routes->get('clear', 'TransaksiController::cart_clear');
    $routes->post('edit', 'TransaksiController::cart_edit');
});

// =====================
// 💰 Checkout & Invoice
// =====================
$routes->post('checkout', 'TransaksiController::checkout', ['filter' => 'auth']);

$routes->get('invoice', 'TransaksiController::invoice', ['filter' => 'auth']);
$routes->get('invoice/(:num)', 'TransaksiController::invoiceById/$1', ['filter' => 'auth']);

// ✅ Tambahan route untuk cetak invoice PDF
$routes->get('invoice/cetak/(:num)', 'TransaksiController::cetakPdf/$1', ['filter' => 'auth']);

// (Opsional) alternatif nama jika mau tetap pakai pdf/9 juga bisa
$routes->get('invoice/pdf/(:num)', 'TransaksiController::cetakPdf/$1', ['filter' => 'auth']);

// =====================
// 📄 Halaman Tambahan
// =====================
$routes->get('about', 'AboutController::index', ['filter' => 'auth']);
$routes->get('contact', 'ContactController::index', ['filter' => 'auth']);
