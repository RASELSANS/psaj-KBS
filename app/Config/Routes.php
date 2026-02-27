<?php

namespace Config; // Pastiin namespace ini ada di baris paling atas

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// phpstan-ignore-next-line - Routes use string-based controller references
// @phpstan-ignore-file

// ==================== FRONTEND PAGE ROUTES ====================
// Halaman Utama
$routes->get('/', 'Home::index');

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();

// ==================== FRONTEND PAGE ROUTES ====================
$routes->get('/', [Home::class, 'index']);
$routes->get('layanan', [Home::class, 'layanan']); 
$routes->get('about', [Home::class, 'about']);
$routes->get('artikel', [Home::class, 'artikel']);
$routes->get('faq', [Home::class, 'faq']);
$routes->get('kontak', [Home::class, 'kontak']);

// --- BAGIAN DOKTER (Urutan ini krusial) ---
$routes->get('doctors', [Home::class, 'doctors']);
// Pake (:segment) biar gak tabrakan sama path lain
$routes->get('doctors/(:segment)', [Home::class, 'doctors_detail/$1']); 

// Sub-Layanan
$routes->get('layanan/penunjang-diagnostik', [Home::class, 'penunjang_diagnostik']);
$routes->get('layanan/poliklinik', [Home::class, 'poliklinik']);
$routes->get('layanan/khitan-center', [Home::class, 'khitan_center']);
$routes->get('layanan/vaksin', [Home::class, 'vaksin']);

// ==================== ADMIN LOGIN ROUTE (No Auth Required) ====================
$routes->get('admin', 'Admin\AdminController::isLoggedIn');  // Shows login or redirects if already logged in

// ==================== ADMIN WEB ROUTES (Protected) ====================
$routes->group('admin', ['filter' => 'auth'], static function($routes) {
    $routes->get('dashboard', 'Admin\AdminController::dashboard');
    $routes->get('dokter', 'Admin\AdminController::dokter');
    $routes->get('spesialis', 'Admin\AdminController::spesialis');
    $routes->get('poli', 'Admin\AdminController::poli');
    $routes->get('jadwal', 'Admin\AdminController::jadwal');
    $routes->get('artikel', 'Admin\AdminController::artikel');
    $routes->get('artikel_form', 'Admin\AdminController::artikelForm');
    $routes->get('gallery', 'GalleryController::index');
});

// ==================== API PUBLIC ROUTES ====================
$routes->get('api/doctors', 'Doctors::index');
$routes->get('api/doctors/(:num)', 'Doctors::detail/$1');
$routes->get('api/spesialis', 'Spesialis::index');
$routes->get('api/poli', 'Poli::index');
$routes->get('api/jadwal', 'Jadwal::index');
$routes->get('api/artikel', 'Artikel::index');
$routes->get('api/artikel/(:num)', 'Artikel::detail/$1');

// ==================== API PUBLIC ROUTES ====================
$routes->group('api', static function($routes) {
    $routes->get('spesialis', [Spesialis::class, 'index']);
    $routes->get('poli', [Poli::class, 'index']);
    $routes->get('jadwal', [Jadwal::class, 'index']);
    $routes->get('artikel', [Artikel::class, 'index']);
    $routes->get('artikel/(:num)', [Artikel::class, 'detail/$1']);
    $routes->get('doctors', [Doctors::class, 'index']); // Biar API dokter jalan juga
});

// ==================== API ADMIN ROUTES (Protected) ====================
$routes->group('api/admin', ['filter' => 'auth'], static function($routes) {
    $routes->get('dashboard', 'Admin\AdminController::dashboard');
    $routes->get('logout', 'Admin\AuthController::logout');

    // Dokter Management
    $routes->get('doctors', 'Admin\DoctorController::index');
    $routes->get('doctors/(:num)', 'Admin\DoctorController::show/$1');
    $routes->post('doctors', 'Admin\DoctorController::create');
    $routes->put('doctors/(:num)', 'Admin\DoctorController::update/$1');
    $routes->post('doctors/(:num)', 'Admin\DoctorController::update/$1'); // Method spoofing: POST with _method=PUT
    $routes->delete('doctors/(:num)', 'Admin\DoctorController::delete/$1');

    // Spesialis Management
    $routes->get('spesialis', 'Admin\SpesialisController::index');
    $routes->get('spesialis/(:num)', 'Admin\SpesialisController::show/$1');
    $routes->post('spesialis', 'Admin\SpesialisController::create');
    $routes->put('spesialis/(:num)', 'Admin\SpesialisController::update/$1');
    $routes->post('spesialis/(:num)', 'Admin\SpesialisController::update/$1'); // Method spoofing
    $routes->delete('spesialis/(:num)', 'Admin\SpesialisController::delete/$1');

    // Poli Management
    $routes->get('poli', 'Admin\PoliController::index');
    $routes->get('poli/(:num)', 'Admin\PoliController::show/$1');
    $routes->post('poli', 'Admin\PoliController::create');
    $routes->put('poli/(:num)', 'Admin\PoliController::update/$1');
    $routes->post('poli/(:num)', 'Admin\PoliController::update/$1'); // Method spoofing
    $routes->delete('poli/(:num)', 'Admin\PoliController::delete/$1');

    // Jadwal Management
    $routes->get('jadwal', 'Admin\JadwalController::index');
    $routes->post('jadwal', 'Admin\JadwalController::create');
    $routes->put('jadwal/(:num)', 'Admin\JadwalController::update/$1');
    $routes->delete('jadwal/(:num)', 'Admin\JadwalController::delete/$1');

    // Artikel Management
    $routes->get('artikel', 'Admin\ArtikelController::index');
    $routes->get('artikel/(:num)', 'Admin\ArtikelController::show/$1');
    $routes->post('artikel', 'Admin\ArtikelController::create');
    $routes->put('artikel/(:num)', 'Admin\ArtikelController::update/$1');
    $routes->delete('artikel/(:num)', 'Admin\ArtikelController::delete/$1');

    // Gallery Management
    $routes->get('gallery/list', 'GalleryController::listImages');
    $routes->post('gallery/upload', 'GalleryController::upload');
    $routes->post('gallery/delete/(:any)', 'GalleryController::delete/$1');
});

// ==================== DEBUG ROUTES (For troubleshooting) ====================
$routes->get('api/admin/debug/session-status', 'Admin\DebugController::sessionStatus');
$routes->post('api/admin/debug/test-session', 'Admin\DebugController::testSessionCreate');
$routes->get('api/admin/debug/verify-session', 'Admin\DebugController::verifySession');
