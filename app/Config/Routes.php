<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Halaman Utama
$routes->get('/', 'Home::index');

// Halaman Layanan
$routes->get('layanan', 'Home::layanan'); 

// Halaman Dokter
$routes->get('doctors', 'Home::doctors');
$routes->get('doctors/detail/(:any)', 'Doctors::detail/$1');

// Halaman Tentang Kami (Pastiin slash-nya konsisten atau tanpa slash sekalian)
$routes->get('about', 'Home::about');

// Tambahan buat jaga-jaga kalau menu lain diklik (Artikel & FAQ)
$routes->get('artikel', 'Home::artikel');
$routes->get('faq', 'Home::faq');
$routes->get('kontak', 'Home::kontak');
$routes->get('artikel', 'Home::artikel');
$routes->get('faq', 'Home::faq');
$routes->get('kontak', 'Home::kontak');
$routes->get('layanan/penunjang-diagnostik', 'Home::penunjang_diagnostik');
$routes->get('layanan/poliklinik', 'Home::poliklinik');
$routes->get('layanan/khitan-center', 'Home::khitan_center');
$routes->get('layanan/vaksin', 'Home::vaksin');