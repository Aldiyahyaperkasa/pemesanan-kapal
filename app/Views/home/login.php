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


<body>
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>

    <div class="auth-main">
        <div class="auth-wrapper v3">
            <div class="auth-form">
                <div class="auth-header">
                    <a href="#"><img src="../assets/images/logo-dark.svg" alt="img"></a>
                </div>
                <div class="card my-5">
                    <div class="card-body">
                        <form action="<?= base_url('login/submit') ?>" method="post">
                            <div class="d-flex justify-content-between align-items-end mb-4">
                                <h3 class="mb-0"><b>Login</b></h3>
                                <a href="#" class="link-primary">Don't have an account?</a>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="text" name="username" class="form-control" placeholder="Email Address" required>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Password" required>
                            </div>
                            <div class="d-flex mt-1 justify-content-between">
                                <div class="form-check">
                                    <input class="form-check-input input-primary" type="checkbox" id="customCheckc1" checked="">
                                    <label class="form-check-label text-muted" for="customCheckc1">Keep me sign in</label>
                                </div>
                                <h5 class="text-secondary f-w-400">Forgot Password?</h5>
                            </div>
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div> 
                        </form>                        
                    </div>
                </div>                
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->


    <!-- Required Js -->

    <script src="<?= base_url() ?>assets/mantis/js/plugins/bootstrap.min.js"></script>
    <!-- <script src="../assets/js/fonts/custom-font.js"></script>
    <script src="../assets/js/pcoded.js"></script>
    <script src="../assets/js/plugins/feather.min.js"></script> -->

    <script>layout_change('light');</script>
        
    <script>change_box_container('false');</script>
    
    <script>layout_rtl_change('false');</script>    
    
    <script>preset_change("preset-1");</script>    
    
    <script>font_change("Public-Sans");</script>
    
        
    
</body>

</html>