<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Pemesanan Kapal ke Pulau Beras Basah</title>
  <link rel="icon" href="<?= base_url('assets/gambar/logolayarbasah.png') ?>" type="image/x-icon" />

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <!-- AOS -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Roboto:wght@400;700&display=swap" rel="stylesheet" />

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f4f8fb;
    }
    .navbar {
      background-color: #ffffff;
    }
    .navbar-brand {
      font-family: 'Pacifico', cursive;
      font-size: 1.8rem;
      color: #0077b6 !important;
    }
    .nav-link {
      color: #000 !important;
      font-weight: 500;
    }
    .nav-link:hover {
      color: #0077b6 !important;
    }

    .btn-login {
      background-color: #0077b6;
      color: #fff;
      font-weight: 600;
    }

    .btn-login:hover {
      background-color: transparent;
      color: #0077b6;
      border: 3px solid #0077b6;
    }

    .hero {
      background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.3)),
        url('<?= base_url('assets/gambar/banner.jpeg') ?>') center/cover no-repeat;
      height: 100vh;
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.7);
      position: relative;
    }

    .hero::after {
      content: '';
      position: absolute;
      bottom: -1px;
      width: 100%;
      height: 80px;
      background: url('https://www.svgrepo.com/show/489293/wave-bottom.svg') no-repeat center bottom;
      background-size: cover;
    }

    .btn-cta {
      background: linear-gradient(to right, #00b4d8, #0077b6);
      border: none;
      color: #fff;
      padding: 12px 30px;
      border-radius: 30px;
      font-weight: 500;
      font-size: 1.1rem;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
      transition: background 0.3s ease, transform 0.2s;
    }

    .btn-cta:hover {
      background: linear-gradient(to right, #0096c7, #023e8a);
      transform: scale(1.05);
    }

    .section-title {
      font-family: 'Playfair Display', serif;
      color: #023e8a;
      font-size: 2.2rem;
      margin-bottom: 0.7rem;
    }

    #kapal,
    #panduan,
    #kontak {
      padding: 60px 0;
    }

    .icon-circle {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      background-color: #26a69a;
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 15px;
    }

    .card {
      transition: all 0.3s ease;
    }

    .card:hover {
      transform: translateY(-8px);
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
    }

    .card-title {
      font-weight: bold;
      color: #0077b6;
    }

    .card-body p.fw-bold {
      color: #26a69a;
    }

    footer {
      background-color: #023e8a;
      color: white;
      padding: 40px 0;
      text-align: center;
      font-size: 0.95rem;
    }

    footer a {
      color: #ffb703;
      text-decoration: none;
    }

    footer a:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>
  <!-- Navbar -->
  <!-- <nav class="navbar navbar-expand-lg fixed-top shadow-sm">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="<?= base_url('assets/gambar/logolayarbasah.png') ?>" alt="Logo" width="60" class="me-2" />
        Layar Basah
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="#home">Beranda</a></li>
          <li class="nav-item"><a class="nav-link" href="#tentang">Tentang</a></li>
          <li class="nav-item"><a class="nav-link" href="#kapal">Kapal</a></li>
          <li class="nav-item"><a class="nav-link" href="#panduan">Panduan</a></li>
          <li class="nav-item"><a class="nav-link" href="#galeri">Galeri</a></li>
          <a class="btn btn-login ms-2" href="<?= base_url('LoginController'); ?>">
            <i class="bi bi-box-arrow-in-right me-1"></i> Daftar/Login
          </a>
        </ul>
      </div>
    </div>
  </nav> -->

    <!-- konten -->
<div class="container py-5" style="max-width: 480px; margin-top: 100px;">
    <div class="card shadow-sm p-4">
        <h3 class="mb-4 text-center">Login Pemesan</h3>

        <?php if (!empty($error)) : ?>
            <div class="alert alert-danger"><?= esc($error) ?></div>
        <?php endif; ?>

        <form action="<?= base_url('pesan/login/' . $id_kapal) ?>" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>
</div>





  <!-- Footer -->
  <footer>
    <div class="container">
      <p class="mb-0">&copy; 2025 Layar Basah. Seluruh hak cipta dilindungi.</p>
    </div>
  </footer>

  <!-- Script -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
</body>
</html>
