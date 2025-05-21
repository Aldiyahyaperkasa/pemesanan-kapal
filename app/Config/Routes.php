<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');


$routes->get('LoginController/', 'LoginController::index');


$routes->post('login/submit', 'LoginController::submit');

// dashboard admin
$routes->get('admin/index', 'AdminController::index');


// kelola akun admin
$routes->group('akun_admin', function($routes) {
    $routes->get('index', 'AkunAdminController::index');
    $routes->get('tambah', 'AkunAdminController::form_tambah');
    $routes->post('tambah', 'AkunAdminController::tambah_akun');
    $routes->get('edit/(:num)', 'AkunAdminController::form_edit/$1');
    $routes->post('edit/(:num)', 'AkunAdminController::edit_akun/$1');
    $routes->get('hapus/(:num)', 'AkunAdminController::hapus_akun/$1');
});



// kelola akun pemilik kapal
$routes->group('akun_pemilik_kapal', function($routes) {
    $routes->get('index', 'AkunPemilikKapalController::index');
    $routes->get('tambah', 'AkunPemilikKapalController::form_tambah');
    $routes->post('tambah', 'AkunPemilikKapalController::tambah_akun');
    $routes->get('edit/(:num)', 'AkunPemilikKapalController::form_edit/$1');
    $routes->post('edit/(:num)', 'AkunPemilikKapalController::edit_akun/$1');
    $routes->get('hapus/(:num)', 'AkunPemilikKapalController::hapus_akun/$1');
});


// kelola akun pemesan
$routes->group('akun_pemesan', function($routes) {
    $routes->get('index', 'AkunPemesanController::index');
    $routes->get('tambah', 'AkunPemesanController::form_tambah');
    $routes->post('tambah', 'AkunPemesanController::tambah_akun');
    $routes->get('edit/(:num)', 'AkunPemesanController::form_edit/$1');
    $routes->post('edit/(:num)', 'AkunPemesanController::edit_akun/$1');
    $routes->get('hapus/(:num)', 'AkunPemesanController::hapus_akun/$1');
});


// kelola kapal
$routes->group('kapal', function($routes) {
    $routes->get('index', 'KapalController::index');
    $routes->get('tambah', 'KapalController::form_tambah');
    $routes->post('tambah', 'KapalController::tambah_kapal');
    $routes->get('edit/(:num)', 'KapalController::form_edit/$1');
    $routes->post('edit/(:num)', 'KapalController::edit_kapal/$1');
    $routes->get('hapus/(:num)', 'KapalController::hapus_kapal/$1');
});
