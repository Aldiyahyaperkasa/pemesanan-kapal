<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
    <title>Login | Mantis Bootstrap 5 Admin Template</title>
    <!-- [Meta] -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Mantis is made using Bootstrap 5 design framework. Download the free admin template & use it for your project.">
    <meta name="keywords" content="Mantis, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Bootstrap Admin Template">
    <meta name="author" content="CodedThemes">

    <!-- [Favicon] icon -->
    <link rel="icon" href="../assets/images/favicon.svg" type="image/x-icon"> <!-- [Google Font] Family -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" id="main-font-link">
    <!-- font awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/mantis/fonts/fontawesome.css') ?>" >

    <!-- [Template mantis] -->
    <link rel="stylesheet" href="<?= base_url('assets/mantis/css/style.css') ?>" id="main-style-link" >
    <link rel="stylesheet" href="<?= base_url('assets/mantis/css/style-preset.css') ?>">  

</head>


<body class="bg-light" style="font-family: 'Poppins', sans-serif;">

    <!-- Loader -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>

    <!-- Login Container -->
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow border-0" style="width: 380px; border-radius: 16px;">
            <div class="card-body p-4">
                <div class="text-center mb-4">
                    <img src="<?= base_url('assets/gambar/logo.png') ?>" alt="Logo" style="height: 80px;">
                    <h4 class="mt-3 fw-semibold text-dark">Selamat Datang</h4>
                    <p class="text-muted small">Silakan masuk untuk melanjutkan</p>
                </div>

                <form action="<?= base_url('login/submit') ?>" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" id="username" class="form-control form-control-lg rounded-3 shadow-sm" placeholder="Masukkan username" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control form-control-lg rounded-3 shadow-sm" placeholder="Masukkan password" required>
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow">Login</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

</body>


</html>