<?php

namespace Config; // Pastiin namespace ini ada di baris paling atas

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// --- IMPORT SEMUA CONTROLLER (FIXED) ---
use App\Controllers\Home;
use App\Controllers\Admin;
use App\Controllers\Spesialis;
use App\Controllers\Poli;
use App\Controllers\Jadwal;
use App\Controllers\Artikel;
use App\Controllers\Doctors; // Ini tadi lo kelupaan di screenshot!

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

// ==================== ADMIN VIEW ROUTES ====================
$routes->group('admin', static function($routes) {
    $routes->get('/', [Admin::class, 'index']);
    $routes->get('doctors', [Admin::class, 'doctors']);
    $routes->get('artikel/add', [Admin::class, 'add_artikel']);
    $routes->post('artikel/store', [Admin::class, 'store_artikel']);
});

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
    $routes->resource('doctors', ['controller' => 'Admin\DoctorController']);
    $routes->resource('spesialis', ['controller' => 'Admin\SpesialisController']);
    $routes->resource('poli', ['controller' => 'Admin\PoliController']);
    $routes->resource('jadwal', ['controller' => 'Admin\JadwalController']);
    $routes->resource('artikel', ['controller' => 'Admin\ArtikelController']);
});

// Auth API
$routes->post('api/admin/login', 'Admin\AuthController::login');
$routes->post('api/admin/logout', 'Admin\AuthController::logout');
$routes->get('api/admin/profile', 'Admin\AuthController::profile');