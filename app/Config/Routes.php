<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');


$routes->get('LoginController/', 'LoginController::index');
$routes->post('login/submit', 'LoginController::submit');

$routes->get('login/logout', 'LoginController::logout');

// dashboard admin
$routes->get('/admin/index', 'AdminController::index');


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


// kelola pemesanan
$routes->group('kelola-pesanan', function($routes) {
    $routes->get('index', 'KelolaPesananController::index');
    $routes->get('update-status/(:num)/(:any)', 'KelolaPesananController::updateStatus/$1/$2');
});





// pemesanan dari landing page
// $routes->get('pemesanan/form/(:num)', 'PemesananController::form/$1');



// Group untuk pemesanan
$routes->group('pesan', function($routes) {
    $routes->get('cek_akun/(:num)', 'PesanController::cek_akun/$1');


    $routes->get('login/(:num)', 'PesanController::login/$1');
    $routes->post('login/(:num)', 'PesanController::proses_login/$1');

    // $routes->get('logout/(:num)', 'PesanController::logout/$1');
    $routes->get('reset/(:num)', 'PesanController::reset/$1');

    $routes->get('form_registrasi/(:num)', 'PesanController::form_registrasi/$1');
    $routes->post('form_registrasi/(:num)', 'PesanController::simpan_registrasi/$1');
    

    $routes->get('form_pemesanan/(:num)', 'PesanController::form_pemesanan/$1');
    $routes->post('form_pemesanan/(:num)', 'PesanController::simpan_pemesanan/$1');
    
    $routes->get('terima/(:num)', 'PesanController::terima/$1');
    $routes->get('tolak/(:num)', 'PesanController::tolak/$1');
});

// Group untuk dashboard pemilik kapal
$routes->group('dashboard_pemilik', function($routes) {
    $routes->get('/', 'PemilikController::dashboard');
});



// dashboard pemilik kapal
$routes->get('pemilik_kapal/index', 'PemilikKapalController::index');
$routes->get('pemilik_kapal/pemesanan', 'PemilikKapalController::pemesanan');
$routes->post('pemilik_kapal/update_status/(:num)', 'PemilikKapalController::updateStatus/$1');



// dashboard pemesan
$routes->get('pemesan/index', 'PemesanController::index');
// $routes->get('pemesan/form-pesanan', 'PemesanController::index');
$routes->get('pemesan/riwayat', 'PemesanController::riwayat');


$routes->get('pemesan/edit/(:num)', 'PemesanController::edit/$1');
$routes->post('pemesan/update/(:num)', 'PemesanController::update/$1');
$routes->get('pemesan/proses-upload-bukti/(:num)', 'PemesanController::uploadBukti/$1');
$routes->post('pemesan/proses-upload-bukti/(:num)', 'PemesanController::prosesUploadBukti/$1');



$routes->get('/admin/index', 'AdminController::index');
