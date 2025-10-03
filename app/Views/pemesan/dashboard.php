<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
    <title>Dashboard Admin | Sistem Pemesanan Kapal Ke Beras Basah</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Mantis is made using Bootstrap 5 design framework. Download the free admin template & use it for your project.">
    <meta name="keywords" content="Mantis, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Bootstrap Admin Template">
    <meta name="author" content="CodedThemes">
    <link rel="icon" href="<?= base_url('assets/gambar/logo.png') ?>" type="image/x-icon">


    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" id="main-font-link">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    
    <link rel="stylesheet" href="<?= base_url('assets/mantis/fonts/tabler-icons.min.css')?>">
    <link rel="stylesheet" href="<?= base_url('assets/mantis/fonts/feather.css')?>">
    <link rel="stylesheet" href="<?= base_url('assets/mantis/fonts/fontawesome.css')?>">
    <link rel="stylesheet" href="<?= base_url('assets/mantis/fonts/material.css')?>">
    
    
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="<?= base_url('assets/mantis/css/style.css')?>" id="main-style-link" >
    <link rel="stylesheet" href="<?= base_url('assets/mantis/css/style-preset.css') ?>">

    <style>
        .navbar-brand {
            /* font-family: 'Playfair Display', serif; */
            font-family: 'Pacifico', cursive;
            font-size: 1.8rem;
            color: #0077b6 !important;
        }
        .card-tourism {
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 2rem;
        }
        .header-banner {
            background: linear-gradient(to right, #0077b6, #00b4d8);
            color: white;
            padding: 1rem 2rem;
            font-weight: bold;
            font-size: 1.5rem;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }
    </style>

</head>


<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">

    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>


    <!-- [ Sidebar Menu ] start -->
    <nav class="pc-sidebar">
        <div class="navbar-wrapper">
            <div class="m-header">
                <a href="<?= site_url('/admin/index') ?>"  class="b-brand text-primary navbar-brand">
                    <img src="<?= base_url('assets/gambar/logolayarbasah.png') ?>" class="img-fluid w-25" alt="logo layar basah">
                    layar basah
                </a>
            </div>

            <div class="navbar-content">
                <ul class="pc-navbar">
                    <li class="pc-item">
                        <a href="<?= site_url('/pemesan/index') ?>" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
                            <span class="pc-mtext">Dashboard</span>
                        </a>
                    </li>                          
                    <li class="pc-item">
                        <a href="<?= base_url('/pemesan/riwayat') ?>" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-folder-plus"></i></span>
                            <span class="pc-mtext">data pemesanan</span>
                        </a>
                    </li>        
                    <li class="pc-item">
                        <a href="<?= site_url('/login/logout') ?>" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-file-report"></i></span>
                            <span class="pc-mtext">Logout</span>
                        </a>
                    </li>     
                    <!-- <li class="pc-item pc-hasmenu">
                        <a href="#!" class="pc-link"><span class="pc-micon"><i class="ti ti-menu"></i></span><span class="pc-mtext">Menu
                            levels</span><span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                        </a>
                        <ul class="pc-submenu">
                            <li class="pc-item"><a class="pc-link" href="#!">Level 2.1</a></li>
                            <li class="pc-item pc-hasmenu">
                                <a href="#!" class="pc-link">Level 2.2<span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
                                <ul class="pc-submenu">
                                    <li class="pc-item"><a class="pc-link" href="#!">Level 3.1</a></li>
                                    <li class="pc-item"><a class="pc-link" href="#!">Level 3.2</a></li>
                                    <li class="pc-item pc-hasmenu">
                                        <a href="#!" class="pc-link">Level 3.3<span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
                                        <ul class="pc-submenu">
                                            <li class="pc-item"><a class="pc-link" href="#!">Level 4.1</a></li>
                                            <li class="pc-item"><a class="pc-link" href="#!">Level 4.2</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>                 -->
                </ul>            
            </div>
        </div>
    </nav>


    <header class="pc-header">
        <div class="header-wrapper">
            <div class="me-auto pc-mob-drp">
                <ul class="list-unstyled">
                    <li class="pc-h-item pc-sidebar-collapse">
                        <a href="#" class="pc-head-link ms-0" id="sidebar-hide">
                            <i class="ti ti-menu-2"></i>
                        </a>
                    </li>
                    <li class="pc-h-item pc-sidebar-popup">
                        <a href="#" class="pc-head-link ms-0" id="mobile-collapse">
                            <i class="ti ti-menu-2"></i>
                        </a>
                    </li>
                    
                    <li class="dropdown pc-h-item d-inline-flex d-md-none">
                        <a
                            class="pc-head-link dropdown-toggle arrow-none m-0"
                            data-bs-toggle="dropdown"
                            href="#"
                            role="button"
                            aria-haspopup="false"
                            aria-expanded="false"
                        >
                            <i class="ti ti-search"></i>
                        </a>
                            
                        <div class="dropdown-menu pc-h-dropdown drp-search">
                            <form class="px-3">
                                <div class="form-group mb-0 d-flex align-items-center">
                                    <i data-feather="search"></i>
                                    <input type="search" class="form-control border-0 shadow-none" placeholder="Search here. . .">
                                </div>
                            </form>
                        </div>
                    </li>
                    
                    <li class="pc-h-item d-none d-md-inline-flex">
                        <form class="header-search">
                            <i data-feather="search" class="icon-search"></i>
                            <input type="search" class="form-control" placeholder="Search here. . .">
                        </form>
                    </li>
                </ul>
            </div>                    
        </div>
    </header>


<div class="pc-container">
    <div class="pc-content">

        <div class="row justify-content-center">

            <div class="container ">
                <?php if ($pemesanan): ?>
                    <?php if ($pemesanan['status_pemilik'] == 'menunggu'): ?>
                        <div class="card-tourism">
                            <div class="header-banner">Menunggu konfirmasi dari pemilik kapal</div>
                            <div class="row p-4">
                                <div class="col-md-4">
                                    <img src="<?= base_url('assets/gambar_kapal/' . $kapal['foto_kapal']) ?>" class="img-fluid rounded" alt="gambar kapal">
                                </div>
                                <div class="col-md-8">
                                    <table class="table ">
                                        <tr><th>Nama Kapal</th><td><?= esc($kapal['nama_kapal']) ?></td></tr>
                                        <tr><th>Nama Pemesan</th><td><?= esc($pemesan['nama_lengkap']) ?></td></tr>
                                        <tr><th>Email</th><td><?= esc($pemesan['email']) ?></td></tr>
                                        <tr><th>No HP</th><td><?= esc($pemesan['no_hp']) ?></td></tr>
                                        <tr><th>Tanggal Berangkat</th><td><?= esc($pemesanan['tanggal_berangkat']) ?></td></tr>
                                        <tr><th>Tanggal Kembali</th><td><?= esc($pemesanan['tanggal_kembali']) ?></td></tr>
                                        <tr><th>Jumlah Penumpang</th><td><?= esc($pemesanan['jumlah_penumpang']) ?></td></tr>
                                        <tr><th>Total Harga</th><td>Rp <?= number_format($pemesanan['total_harga'], 0, ',', '.') ?></td></tr>
                                    </table>
                                    <a href="<?= base_url('pemesan/edit/' . $pemesanan['id_pemesanan']) ?>" class="btn btn-warning">Edit Data Pemesanan</a>
                                    <a href="<?= base_url('pemesan/hapus/' . $pemesanan['id_pemesanan']) ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus pesanan ini?')">Hapus</a>

                                </div>
                            </div>
                        </div>        

                    <?php elseif ($pemesanan['status_pemilik'] == 'diterima' && $pemesanan['status_admin'] == 'menunggu' && empty($pemesanan['bukti_bayar'])): ?>
                        <div class="card-tourism mt-5">
                            <div class="header-banner">Upload Bukti Pembayaran Anda</div>
                            <div class="row g-0 p-4">
                                <div class="col-md-5 text-center">
                                    <img src="<?= base_url('assets/gambar_kapal/' . $kapal['foto_kapal']) ?>" class="img-fluid img-kapal" alt="gambar kapal">
                                    <p class="mt-2 mb-0 text-muted"><small>Kapal: <?= esc($kapal['nama_kapal']) ?></small></p>
                                </div>
                                <div class="col-md-7 ps-md-4 pt-3 pt-md-0">
                                    <p class="mb-3">Pemesanan Anda telah disetujui oleh pemilik kapal. Silakan unggah bukti pembayaran untuk diproses oleh admin.</p>

                                    <form action="<?= base_url('pemesan/upload-bukti/' . $pemesanan['id_pemesanan']) ?>" method="post" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <label for="bukti_bayar" class="form-label">Bukti Pembayaran (JPG, PNG, PDF)</label>
                                            <input type="file" name="bukti_bayar" id="bukti_bayar" class="form-control" accept=".jpg,.jpeg,.png,.pdf" required>
                                        </div>
                                        <button type="submit" class="btn btn-upload">
                                            <i class="feather icon-upload"></i> Upload Bukti Sekarang
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    <?php elseif ($pemesanan['status_pemilik'] == 'diterima' && $pemesanan['status_admin'] == 'menunggu' && !empty($pemesanan['bukti_bayar'])): ?>
                        <div class="card-tourism">
                            <div class="header-banner">Menunggu Konfirmasi Admin</div>
                            <div class="row g-0 p-4">
                                <div class="col-md-5 text-center">
                                    <img src="<?= base_url('assets/gambar_kapal/' . $kapal['foto_kapal']) ?>" class="img-fluid img-kapal" alt="gambar kapal">
                                    <p class="mt-2 mb-0 text-muted"><small>Kapal: <?= esc($kapal['nama_kapal']) ?></small></p>
                                </div>
                                <div class="col-md-7 ps-md-4 pt-3 pt-md-0">
                                    <p class="mb-3">Terima kasih! Bukti pembayaran Anda telah dikirim. Silakan tunggu konfirmasi dari admin.</p>

                                    <h6 class="fw-bold mb-2">Bukti Pembayaran:</h6>
                                    <?php
                                        $fileUrl = base_url('uploads/bukti_bayar/' . $pemesanan['bukti_bayar']);
                                    ?>
                                    <a href="<?= $fileUrl ?>" target="_blank" class="btn btn-outline-primary">
                                        <i class="feather icon-file-text"></i> Lihat Bukti Pembayaran
                                    </a>

                                    <div class="mt-3">
                                        <table class="table table-sm">
                                            <tr><th>Nama Pemesan</th><td><?= esc($pemesan['nama_lengkap']) ?></td></tr>
                                            <tr><th>Email</th><td><?= esc($pemesan['email']) ?></td></tr>
                                            <tr><th>No HP</th><td><?= esc($pemesan['no_hp']) ?></td></tr>
                                            <tr><th>Tanggal Berangkat</th><td><?= esc($pemesanan['tanggal_berangkat']) ?></td></tr>
                                            <tr><th>Tanggal Kembali</th><td><?= esc($pemesanan['tanggal_kembali']) ?></td></tr>
                                            <tr><th>Jumlah Penumpang</th><td><?= esc($pemesanan['jumlah_penumpang']) ?></td></tr>
                                            <tr><th>Total Harga</th><td>Rp <?= number_format($pemesanan['total_harga'], 0, ',', '.') ?></td></tr>
                                            <tr><th>Status</th><td><span class="badge bg-warning text-dark">Menunggu Konfirmasi Admin</span></td></tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php elseif ($pemesanan['status_pemilik'] == 'diterima' && $pemesanan['status_admin'] == 'terverifikasi'): ?>
                        <div class="card-tourism">
                            <div class="header-banner">Detail Pemesanan</div>
                            <div class="row p-4">
                                <div class="col-md-4">
                                    <img src="<?= base_url('assets/gambar_kapal/' . $kapal['foto_kapal']) ?>" class="img-fluid rounded" alt="gambar kapal">
                                </div>
                                <div class="col-md-8">
                                    <table class="table table-bordered">
                                        <tr><th>Nama Kapal</th><td><?= esc($kapal['nama_kapal']) ?></td></tr>
                                        <tr><th>Nama Pemesan</th><td><?= esc($pemesan['nama_lengkap']) ?></td></tr>
                                        <tr><th>Tanggal Berangkat</th><td><?= esc($pemesanan['tanggal_berangkat']) ?></td></tr>
                                        <tr><th>Tanggal Kembali</th><td><?= esc($pemesanan['tanggal_kembali']) ?></td></tr>
                                        <tr><th>Jumlah Penumpang</th><td><?= esc($pemesanan['jumlah_penumpang']) ?></td></tr>
                                        <tr><th>Total Harga</th><td>Rp <?= number_format($pemesanan['total_harga'], 0, ',', '.') ?></td></tr>
                                        <tr><th>Status</th><td><span class="badge bg-success">Telah Dikonfirmasi</span></td></tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="alert alert-info">Belum ada pemesanan.</div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>



    
    <script src="<?= base_url() ?>assets/mantis/js/plugins/apexcharts.min.js"></script>
    <script src="<?= base_url() ?>assets/mantis/js/pages/dashboard-default.js"></script>
        
    <!-- Required Js -->
    <!-- <script src="../assets/js/plugins/popper.min.js"></script> -->
    <script src="<?= base_url() ?>assets/mantis/js/plugins/simplebar.min.js"></script>
    <script src="<?= base_url() ?>assets/mantis/js/plugins/bootstrap.min.js"></script>
    <!-- <script src="../assets/js/fonts/custom-font.js"></script> -->
    <script src="<?= base_url() ?>assets/mantis/js/pcoded.js"></script>
    <script src="<?= base_url() ?>assets/mantis/js/plugins/feather.min.js"></script>
  
  
</body>


</html>