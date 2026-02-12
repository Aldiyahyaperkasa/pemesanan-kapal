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

.hover-shadow:hover {
    transform: translateY(-4px);
    transition: all 0.3s ease;
    box-shadow: 0 12px 30px rgba(0,0,0,0.08);
}
.card {
    transition: all 0.3s ease;
}

/* ===== DASHBOARD MODERN STYLE ===== */

.dashboard-card {
    border-radius: 12px !important;
    border: 1px solid #eef1f6;
    box-shadow: 0 4px 14px rgba(0,0,0,0.04);
    transition: all 0.25s ease;
    background: #ffffff;
}

.dashboard-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 24px rgba(0,0,0,0.06);
}

.stat-number {
    font-size: 28px;
    font-weight: 700;
    color: #1e293b;
}

.stat-label {
    font-size: 13px;
    color: #64748b;
}

.icon-box {
    width: 44px;
    height: 44px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
}

.bg-soft-primary { background: rgba(59,130,246,0.1); color:#3b82f6; }
.bg-soft-success { background: rgba(34,197,94,0.1); color:#22c55e; }
.bg-soft-warning { background: rgba(245,158,11,0.1); color:#f59e0b; }
.bg-soft-danger  { background: rgba(239,68,68,0.1); color:#ef4444; }

.section-title {
    font-weight: 600;
    font-size: 15px;
    color: #1e293b;
}

.clean-progress {
    height: 6px;
    background: #f1f5f9;
    border-radius: 10px;
}

.clean-progress-bar {
    height: 6px;
    border-radius: 10px;
}

.quick-btn {
    border-radius: 10px !important;
    font-weight: 500;
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
                <a href="<?= site_url('/admin/dashboard') ?>"  class="b-brand text-primary navbar-brand">
                    <img src="<?= base_url('assets/gambar/logolayarbasah.png') ?>" class="img-fluid w-25" alt="logo layar basah">
                    layar basah
                </a>
            </div>

            <div class="navbar-content">
                <ul class="pc-navbar">
                    <li class="pc-item">
                        <a href="<?= site_url('/admin/dashboard') ?>" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
                            <span class="pc-mtext">Dashboard</span>
                        </a>
                    </li>
                    <li class="pc-item pc-hasmenu">
                        <a href="#" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-menu"></i></span>
                            <span class="pc-mtext">Kelola Akun</span>
                            <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                        </a>
                        <ul class="pc-submenu">
                            <li class="pc-item">
                                <a class="pc-link" href="<?= site_url('admin/kelola-akun/admin') ?>">
                                    <span class="pc-micon"><i class="ti ti-user"></i></span>
                                    Akun Admin
                                </a>
                            </li>
                            <li class="pc-item">
                                <a class="pc-link" href="<?= site_url('admin/kelola-akun/pemilik-kapal') ?>">
                                    <span class="pc-micon"><i class="ti ti-users"></i></span>
                                    Akun Pemilik Kapal
                                </a>
                            </li>                      
                        </ul>
                    </li>            
                    <li class="pc-item">
                        <a href="<?= site_url('/kapal/index') ?>" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-ship"></i></span>
                            <span class="pc-mtext">Kelola Kapal</span>
                        </a>
                    </li>    
                    <li class="pc-item">
                        <a href="<?= site_url('/kelola-pesanan/index') ?>" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-folder-plus"></i></span>
                            <span class="pc-mtext">Kelola Pemesanan</span>
                        </a>
                    </li>    
                    <li class="pc-item">
                        <a href="../dashboard/index.html" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-file-report"></i></span>
                            <span class="pc-mtext">Laporan</span>
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

                <div class="container-fluid py-4">

                    <!-- HEADER -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h3 class="fw-bold mb-1">Dashboard Admin</h3>
                            <p class="text-muted mb-0">Ringkasan sistem pemesanan kapal</p>
                        </div>
                        <div class="text-muted small">
                            <?= date('d F Y') ?>
                        </div>
                    </div>

                    <!-- ================= STATISTICS CARDS ================= -->
                    <div class="row g-4 mb-4">

                        <?php
                        $cards = [
                            ['title'=>'Total Kapal','value'=>$totalKapal ?? 0,'icon'=>'ti-ship','class'=>'bg-soft-primary'],
                            ['title'=>'Total Pemesan','value'=>$totalPemesan ?? 0,'icon'=>'ti-users','class'=>'bg-soft-success'],
                            ['title'=>'Pemilik Kapal','value'=>$totalPemilik ?? 0,'icon'=>'ti-user-cog','class'=>'bg-soft-warning'],
                            ['title'=>'Total Pemesanan','value'=>$totalPemesanan ?? 0,'icon'=>'ti-folder','class'=>'bg-soft-danger'],
                        ];
                        ?>

                        <?php foreach($cards as $c): ?>
                        <div class="col-xl-3 col-md-6">
                            <div class="card dashboard-card">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="stat-label"><?= $c['title'] ?></div>
                                        <div class="stat-number"><?= $c['value'] ?></div>
                                    </div>
                                    <div class="icon-box <?= $c['class'] ?>">
                                        <i class="ti <?= $c['icon'] ?>"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>

                    </div>


                    <!-- ================= STATUS + ACTIVITY ================= -->
                    <div class="row g-4 mb-4">

                        <!-- STATUS -->
                        <div class="card dashboard-card h-100">
                            <div class="card-body">
                                <div class="section-title mb-4">Status Pemesanan</div>

                                <?php
                                $statuses = [
                                    ['label'=>'Menunggu Verifikasi','value'=>$menunggu ?? 0,'percent'=>$persenMenunggu ?? 0,'color'=>'#f59e0b'],
                                    ['label'=>'Terverifikasi','value'=>$terverifikasi ?? 0,'percent'=>$persenTerverifikasi ?? 0,'color'=>'#22c55e'],
                                    ['label'=>'Ditolak','value'=>$ditolak ?? 0,'percent'=>$persenDitolak ?? 0,'color'=>'#ef4444'],
                                ];
                                ?>

                                <?php foreach($statuses as $s): ?>
                                <div class="mb-4">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="small text-muted"><?= $s['label'] ?></span>
                                        <span class="fw-semibold"><?= $s['value'] ?></span>
                                    </div>
                                    <div class="clean-progress">
                                        <div class="clean-progress-bar" 
                                            style="width: <?= $s['percent'] ?>%; background: <?= $s['color'] ?>;">
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>

                            </div>
                        </div>


                        <!-- ACTIVITY -->
                        <div class="card dashboard-card mt-4">
                            <div class="card-body">
                                <div class="section-title mb-3">Quick Action</div>

                                <div class="d-flex flex-wrap gap-3">

                                    <a href="<?= site_url('/kapal/index') ?>" 
                                    class="btn btn-primary quick-btn px-4">
                                        <i class="ti ti-plus me-2"></i> Tambah Kapal
                                    </a>

                                    <a href="<?= site_url('/kelola-pesanan/index') ?>" 
                                    class="btn btn-success quick-btn px-4">
                                        <i class="ti ti-folder me-2"></i> Kelola Pemesanan
                                    </a>

                                    <a href="<?= site_url('/akun_pemilik_kapal/index') ?>" 
                                    class="btn btn-warning quick-btn px-4">
                                        <i class="ti ti-user-plus me-2"></i> Tambah Pemilik
                                    </a>

                                    <a href="<?= site_url('/akun_pemesan/index') ?>" 
                                    class="btn btn-info quick-btn px-4 text-white">
                                        <i class="ti ti-users me-2"></i> Data Pemesan
                                    </a>

                                </div>
                            </div>
                        </div>


                    </div>


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