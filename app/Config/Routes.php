<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/', 'Home::index');
$routes->get('/layanan', 'Home::layanan'); 
$routes->get('/doctors', 'Home::doctors'); // Tambahkan ini
$routes->get('doctors/detail/(:any)', 'Doctors::detail/$1');
$routes->get('/artikel', 'Artikel::index');