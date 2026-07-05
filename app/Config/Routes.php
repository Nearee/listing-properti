<?php

use App\Controllers\AdminController;
use CodeIgniter\Router\RouteCollection;


/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('/about', 'Home::about');
$routes->get('/contact', 'Home::contact');
$routes->get('/services', 'Home::services');
$routes->get('/properties', 'Home::properti');
$routes->get('/property-single/(:num)', 'Home::propertySingle/$1');

$routes->get('/beri-ulasan', 'Ulasan::index');
$routes->post('/simpan-ulasan', 'Ulasan::store');
$routes->post('kontak/kirim', 'Home::kirim');

// Auth
// $routes->get('/register', 'AuthController::register');
// $routes->post('/auth/register', 'AuthController::processRegister');
$routes->get('/login', 'AuthController::login');
$routes->post('/auth/login', 'AuthController::processLogin');
$routes->get('/logout', 'AuthController::logout');


// Rute Admin
$routes->group('', ['filter' => 'role:admin'], function ($routes) {
    $routes->get('/dashboard', 'DashboardController::Dashboard');

    // Rute untuk Layanan
    $routes->get('/admin/layanan', 'LayananController::index');
    $routes->post('/admin/layanan/store', 'LayananController::store');
    $routes->post('/admin/layanan/update/(:num)', 'LayananController::update/$1');
    $routes->post('/admin/layanan/delete/(:num)', 'LayananController::delete/$1');

    // Rute untuk Profil Perusahaan
    $routes->get('/profilperusahaan', 'ProfilPerusahaan::index');
    $routes->post('/profilperusahaan/save', 'ProfilPerusahaan::save');

    // Rute untuk Galeri
    $routes->get('/admin/galeri', 'Galeri::index');
    $routes->post('/admin/galeri/store', 'Galeri::store');
    $routes->delete('/admin/galeri/delete/(:num)', 'Galeri::delete/$1');

    // Rute untuk Pesan Masuk
    $routes->get('/admin/pesan', 'PesanMasuk::index');
    $routes->delete('/admin/pesan/delete/(:num)', 'PesanMasuk::delete/$1');

    // Rute untuk Ulasan
    $routes->get('/admin/ulasan', 'AdminUlasan::index');
    $routes->post('/admin/ulasan/approve/(:num)', 'AdminUlasan::approve/$1');
    $routes->delete('/admin/ulasan/delete/(:num)', 'AdminUlasan::delete/$1');

    // Rute untuk Lokasi
    $routes->get('/lokasi', 'Lokasi::index');
    $routes->get('/lokasi/create', 'Lokasi::create');
    $routes->post('/lokasi/store', 'Lokasi::store');
    $routes->get('/lokasi/edit/(:num)', 'Lokasi::edit/$1');
    $routes->post('/lokasi/update/(:num)', 'Lokasi::update/$1');
    $routes->delete('/lokasi/delete/(:num)', 'Lokasi::delete/$1');

    // Rute untuk Blok
    $routes->get('/blok', 'Blok::index');
    $routes->post('/blok/store', 'Blok::store');
    $routes->post('/blok/update/(:num)', 'Blok::update/$1');
    $routes->delete('/blok/delete/(:num)', 'Blok::delete/$1');

    // Rute untuk Anggota Tim
    $routes->get('/anggota-tim', 'AnggotaTim::index');
    $routes->post('/anggota-tim/store', 'AnggotaTim::store');
    $routes->post('/anggota-tim/update/(:num)', 'AnggotaTim::update/$1');
    $routes->delete('/anggota-tim/delete/(:num)', 'AnggotaTim::delete/$1');

    //Properti Routes
    $routes->get('/properti', 'Properti::index');
    $routes->post('/properti/store', 'Properti::store');
    $routes->post('/properti/update/(:num)', 'Properti::update/$1');
    $routes->delete('/properti/delete/(:num)', 'Properti::delete/$1');
});

// Rute Allowed for Admin and User
$routes->group('', ['filter' => 'role:admin,user'], function ($routes) {
    $routes->get('/pengaturan', 'DashboardController::Pengaturan');
});
