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
    $routes->get('/profilperusahaan', 'ProfilPerusahaanController::index');
    $routes->post('/profilperusahaan/save', 'ProfilPerusahaanController::save');

    // Rute untuk Galeri
    $routes->get('/admin/galeri', 'GaleriController::index');
    $routes->post('/admin/galeri/store', 'GaleriController::store');
    $routes->delete('/admin/galeri/delete/(:num)', 'GaleriController::delete/$1');

    // Rute untuk Pesan Masuk
    $routes->get('/admin/pesan', 'PesanMasukController::index');
    $routes->delete('/admin/pesan/delete/(:num)', 'PesanMasukController::delete/$1');

    // Rute untuk Ulasan
    $routes->get('/admin/ulasan', 'AdminUlasanController::index');
    $routes->post('/admin/ulasan/approve/(:num)', 'AdminUlasanController::approve/$1');
    $routes->delete('/admin/ulasan/delete/(:num)', 'AdminUlasanController::delete/$1');

    // Rute untuk Lokasi
    $routes->get('/lokasi', 'LokasiController::index');
    $routes->get('/lokasi/create', 'LokasiController::create');
    $routes->post('/lokasi/store', 'LokasiController::store');
    $routes->get('/lokasi/edit/(:num)', 'LokasiController::edit/$1');
    $routes->post('/lokasi/update/(:num)', 'LokasiController::update/$1');
    $routes->delete('/lokasi/delete/(:num)', 'LokasiController::delete/$1');

    // Rute untuk Blok
    $routes->get('/blok', 'BlokController::index');
    $routes->post('/blok/store', 'BlokController::store');
    $routes->post('/blok/update/(:num)', 'BlokController::update/$1');
    $routes->delete('/blok/delete/(:num)', 'BlokController::delete/$1');

    // Rute untuk Anggota Tim
    $routes->get('/anggota-tim', 'AnggotaTimController::index');
    $routes->post('/anggota-tim/store', 'AnggotaTimController::store');
    $routes->post('/anggota-tim/update/(:num)', 'AnggotaTimController::update/$1');
    $routes->delete('/anggota-tim/delete/(:num)', 'AnggotaTimController::delete/$1');

    //Properti Routes
    $routes->get('/properti', 'PropertiController::index');
    $routes->post('/properti/store', 'PropertiController::store');
    $routes->post('/properti/update/(:num)', 'PropertiController::update/$1');
    $routes->delete('/properti/delete/(:num)', 'PropertiController::delete/$1');
});

// Rute Allowed for Admin and User
$routes->group('', ['filter' => 'role:admin,user'], function ($routes) {
    $routes->get('/pengaturan', 'DashboardController::Pengaturan');
});
