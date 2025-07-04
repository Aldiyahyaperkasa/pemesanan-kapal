<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pemesanan Kapal ke Pulau Beras Basah</title>
  <link rel="icon" href="<?= base_url('assets/gambar/logolayarbasah.png') ?>" type="image/x-icon">

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <!-- AOS -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Roboto:wght@400;700&display=swap" rel="stylesheet">


  <!-- Style -->
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f4f8fb;
    }
    .navbar {
      background-color: #ffffff;
    }
    .navbar-brand {
      /* font-family: 'Playfair Display', serif; */
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
      color:  #0077b6;
      border: 3px solid #0077b6;
    }    

    .hero {
      background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.3)), 
                  url('<?= base_url('assets/gambar/bb 2.png') ?>') center/cover no-repeat;
      background-position: left;
      height: 100vh;
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      text-shadow: 1px 1px 4px rgba(0,0,0,0.7);
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
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
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

    #kapal, #panduan, #kontak {
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
      box-shadow: 0 8px 24px rgba(0,0,0,0.1);
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
  <nav class="navbar navbar-expand-lg fixed-top shadow-sm">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="<?= base_url('assets/gambar/logolayarbasah.png') ?>" alt="Logo" width="60" class="me-2">
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
  </nav>

  <!-- Hero -->
  <section class="hero" id="home">
    <div data-aos="fade-up">
      <!-- <h1 class="display-4 fw-semibold">Jelajahi Pulau Beras Basah</h1>
      <p class="lead">Nikmati keindahan tropis dan perjalanan laut yang menyenangkan</p>
      <a href="#kapal" class="btn btn-cta mt-3">Lihat Jadwal & Harga</a> -->
    </div>
  </section>

  <!-- Kapal -->
  <section id="kapal" style="background-color: #edf6f9;">
    <div class="container">
      <div class="text-center mb-5" data-aos="fade-up">
        <h2 class="section-title">Daftar Kapal & Jadwal</h2>
        <p class="text-muted">Pilih kapal yang sesuai dengan kebutuhan perjalananmu</p>
      </div>
      <div class="row g-4">
        <?php foreach ($kapal as $k) : ?>
          <div class="col-md-4" data-aos="fade-up">
            <div class="card h-100">
              <div class="ratio ratio-1x1">
                <img src="<?= base_url('assets/gambar_kapal/' . $k['foto_kapal']) ?>" class="img-fluid object-fit-cover w-100 h-100" alt="<?= esc($k['nama_kapal']) ?>">
              </div>
              <div class="card-body">
                <h5 class="card-title"><?= esc($k['nama_kapal']) ?></h5>

                <p>
                  <?= esc($k['deskripsi']) ?><br>
                  Kapasitas Maksimal: <?= esc($k['max_penumpang']) ?> orang
                </p>

                <?php if ($k['jenis_kapal'] == 'perorangan') : ?>
                  <p class="fw-bold">Rp <?= number_format($k['harga'], 0, ',', '.') ?> / orang</p>
                <?php else : ?>
                  <p class="fw-bold">Rp <?= number_format($k['harga'], 0, ',', '.') ?> / kapal (max <?= $k['max_penumpang'] ?> orang)</p>
                <?php endif; ?>

                <!-- <a href="<?= base_url('pesan/cek_akun/' . $k['id_kapal']) ?>" class="btn btn-outline-primary w-100">Pesan Sekarang</a>                 -->
                <!-- <a href="<?= base_url('pesan/logout/' . $k['id_kapal']) ?>" class="btn btn-outline-primary w-100">Pesan Sekarang</a> -->
                <a href="<?= base_url('pesan/reset/' . $k['id_kapal']) ?>" class="btn btn-outline-primary w-100">Pesan Sekarang</a>


                
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>



  <!-- Panduan -->
  <section id="panduan" class="py-5 bg-white">
    <div class="container">
      <div class="text-center mb-5" data-aos="fade-up">
        <h2 class="section-title">Panduan Pemesanan</h2>
        <p class="text-muted">Ikuti langkah mudah berikut untuk memesan kapal</p>
      </div>
      <div class="row text-center g-4">

        <div class="col-md-3" data-aos="fade-up">
          <div class="icon-circle mx-auto mb-3"><i class="bi bi-cart fs-3"></i></div>
          <h5>Pilih Kapal</h5>
          <p>Klik tombol <strong>Pesan Sekarang</strong> pada kapal pilihanmu di halaman utama.</p>
        </div>

        <div class="col-md-3" data-aos="fade-up" data-aos-delay="100">
          <div class="icon-circle mx-auto mb-3"><i class="bi bi-person-plus fs-3"></i></div>
          <h5>Isi Data & Akun</h5>
          <p>Lengkapi form pemesanan dan buat akun untuk login ke dashboard.</p>
        </div>

        <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
          <div class="icon-circle mx-auto mb-3"><i class="bi bi-wallet2 fs-3"></i></div>
          <h5>Pembayaran</h5>
          <p>Login ke dashboard untuk melihat nominal & rekening, lalu <strong>upload bukti bayar</strong>.</p>
        </div>

        <div class="col-md-3" data-aos="fade-up" data-aos-delay="300">
          <div class="icon-circle mx-auto mb-3"><i class="bi bi-clock-history fs-3"></i></div>
          <h5>Verifikasi</h5>
          <p>Tunggu verifikasi dari admin. Setelah itu, tiket akan dikirim via WhatsApp & muncul di dashboard.</p>
        </div>

      </div>
    </div>
  </section>


  <section id="galeri" class="py-5 bg-light">
    <div class="container">
      <div class="text-center mb-4" data-aos="fade-up">
        <h2 class="section-title">Galeri Perjalanan</h2>
        <p class="text-muted">Suasana indah dari Pulau Beras Basah dan sekitarnya</p>
      </div>
      <div class="row g-3">
        <div class="col-md-4" data-aos="zoom-in">
          <img src="<?= base_url('assets/gambar/beras-basah1.jpeg') ?>" class="img-fluid rounded shadow-sm" alt="pantai">
        </div>
        <div class="col-md-4" data-aos="zoom-in" data-aos-delay="100">
          <img src="<?= base_url('assets/gambar/beras-basah1.jpeg') ?>" class="img-fluid rounded shadow-sm" alt="pantai">
        </div>
        <div class="col-md-4" data-aos="zoom-in" data-aos-delay="200">
          <img src="<?= base_url('assets/gambar/beras-basah1.jpeg') ?>" class="img-fluid rounded shadow-sm" alt="pantai">
        </div>
      </div>
    </div>
  </section>  


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