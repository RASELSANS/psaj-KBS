<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ==================== FRONTEND PAGE ROUTES ====================
$routes->get('/', 'Home::index');
$routes->get('layanan', 'Home::layanan'); 
$routes->get('doctors', 'Home::doctors');
$routes->get('doctors/detail/(:any)', 'Doctors::dummy');
$routes->get('about', 'Home::about');
$routes->get('artikel', 'Home::artikel');
$routes->get('faq', 'Home::faq');
$routes->get('kontak', 'Home::kontak');
$routes->get('layanan/penunjang-diagnostik', 'Home::penunjang_diagnostik');
$routes->get('layanan/poliklinik', 'Home::poliklinik');
$routes->get('layanan/khitan-center', 'Home::khitan_center');
$routes->get('layanan/vaksin', 'Home::vaksin');

// ==================== ADMIN VIEW ROUTES (DASHBOARD & CMS) ====================
// Jalur navigasi utama buat Dashboard Admin lo
$routes->group('admin', static function($routes) {
    $routes->get('/', 'Admin::index');            // Dashboard utama
    $routes->get('doctors', 'Admin::doctors');    // Kelola Dokter
    
    // Fitur Artikel (Pindahin ke sini biar tombolnya JALAN)
    $routes->get('artikel/add', 'Admin::add_artikel');
    $routes->post('artikel/store', 'Admin::store_artikel');
});

// ==================== API PUBLIC ROUTES ====================
$routes->get('api/doctors', 'Doctors::index');
$routes->get('api/doctors/(:num)', 'Doctors::detail/$1');
$routes->get('api/spesialis', 'Spesialis::index');
$routes->get('api/poli', 'Poli::index');
$routes->get('api/jadwal', 'Jadwal::index');
$routes->get('api/artikel', 'Artikel::index');
$routes->get('api/artikel/(:num)', 'Artikel::detail/$1');

// ==================== API ADMIN AUTH ROUTES ====================
$routes->post('api/admin/login', 'Admin\AuthController::login');
$routes->post('api/admin/logout', 'Admin\AuthController::logout');
$routes->get('api/admin/profile', 'Admin\AuthController::profile');

// ==================== API ADMIN ROUTES (Protected Data) ====================
// Ini buat manipulasi data mentah via AJAX/API
$routes->group('api/admin', ['filter' => 'auth'], static function($routes) {
    // Dokter Management
    $routes->get('doctors', 'Admin\DoctorController::index');
    $routes->post('doctors', 'Admin\DoctorController::create');
    $routes->put('doctors/(:num)', 'Admin\DoctorController::update/$1');
    $routes->delete('doctors/(:num)', 'Admin\DoctorController::delete/$1');

    // Spesialis Management
    $routes->get('spesialis', 'Admin\SpesialisController::index');
    $routes->post('spesialis', 'Admin\SpesialisController::create');
    $routes->put('spesialis/(:num)', 'Admin\SpesialisController::update/$1');
    $routes->delete('spesialis/(:num)', 'Admin\SpesialisController::delete/$1');

    // Poli Management
    $routes->get('poli', 'Admin\PoliController::index');
    $routes->post('poli', 'Admin\PoliController::create');
    $routes->put('poli/(:num)', 'Admin\PoliController::update/$1');
    $routes->delete('poli/(:num)', 'Admin\PoliController::delete/$1');

    // Jadwal Management
    $routes->get('jadwal', 'Admin\JadwalController::index');
    $routes->post('jadwal', 'Admin\JadwalController::create');
    $routes->put('jadwal/(:num)', 'Admin\JadwalController::update/$1');
    $routes->delete('jadwal/(:num)', 'Admin\JadwalController::delete/$1');

    // Artikel Management
    $routes->get('artikel', 'Admin\ArtikelController::index');
    $routes->post('artikel', 'Admin\ArtikelController::create');
    $routes->put('artikel/(:num)', 'Admin\ArtikelController::update/$1');
    $routes->delete('artikel/(:num)', 'Admin\ArtikelController::delete/$1');
});