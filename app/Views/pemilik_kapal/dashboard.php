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
                        <a href="<?= site_url('/pemilik_kapal/index') ?>" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
                            <span class="pc-mtext">Dashboard</span>
                        </a>
                    </li>                    
                    <li class="pc-item">
                        <a href="<?= base_url('pemilik_kapal/pemesanan') ?>" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-folder-plus"></i></span>
                            <span class="pc-mtext">Kelola Pemesanan</span>
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
 
            <div class="row">
                <!-- [ sample-page ] start -->
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                        <h6 class="mb-2 f-w-400 text-muted">Total Page Views</h6>
                        <h4 class="mb-3">4,42,236 <span class="badge bg-light-primary border border-primary"><i
                                class="ti ti-trending-up"></i> 59.3%</span></h4>
                        <p class="mb-0 text-muted text-sm">You made an extra <span class="text-primary">35,000</span> this year
                        </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                        <h6 class="mb-2 f-w-400 text-muted">Total Users</h6>
                        <h4 class="mb-3">78,250 <span class="badge bg-light-success border border-success"><i
                                class="ti ti-trending-up"></i> 70.5%</span></h4>
                        <p class="mb-0 text-muted text-sm">You made an extra <span class="text-success">8,900</span> this year</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                        <h6 class="mb-2 f-w-400 text-muted">Total Order</h6>
                        <h4 class="mb-3">18,800 <span class="badge bg-light-warning border border-warning"><i
                                class="ti ti-trending-down"></i> 27.4%</span></h4>
                        <p class="mb-0 text-muted text-sm">You made an extra <span class="text-warning">1,943</span> this year</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                        <h6 class="mb-2 f-w-400 text-muted">Total Sales</h6>
                        <h4 class="mb-3">$35,078 <span class="badge bg-light-danger border border-danger"><i
                                class="ti ti-trending-down"></i> 27.4%</span></h4>
                        <p class="mb-0 text-muted text-sm">You made an extra <span class="text-danger">$20,395</span> this year
                        </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-xl-8">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="mb-0">Unique Visitor</h5>
                        <ul class="nav nav-pills justify-content-end mb-0" id="chart-tab-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="chart-tab-home-tab" data-bs-toggle="pill" data-bs-target="#chart-tab-home"
                            type="button" role="tab" aria-controls="chart-tab-home" aria-selected="true">Month</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="chart-tab-profile-tab" data-bs-toggle="pill"
                            data-bs-target="#chart-tab-profile" type="button" role="tab" aria-controls="chart-tab-profile"
                            aria-selected="false">Week</button>
                        </li>
                        </ul>
                    </div>
                    <div class="card">
                        <div class="card-body">
                        <div class="tab-content" id="chart-tab-tabContent">
                            <div class="tab-pane" id="chart-tab-home" role="tabpanel" aria-labelledby="chart-tab-home-tab"
                            tabindex="0">
                            <div id="visitor-chart-1"></div>
                            </div>
                            <div class="tab-pane show active" id="chart-tab-profile" role="tabpanel"
                            aria-labelledby="chart-tab-profile-tab" tabindex="0">
                            <div id="visitor-chart"></div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-xl-4">
                    <h5 class="mb-3">Income Overview</h5>
                    <div class="card">
                        <div class="card-body">
                        <h6 class="mb-2 f-w-400 text-muted">This Week Statistics</h6>
                        <h3 class="mb-3">$7,650</h3>
                        <div id="income-overview-chart"></div>
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