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

  .card-custom {
    max-width: 600px;
    margin: 2rem auto;
    padding: 2rem;
    box-shadow: 0 4px 12px rgb(0 0 0 / 0.1);
    border-radius: 12px;
    background: #fff;
  }
  .form-header {
    text-align: center;
    margin-bottom: 1.5rem;
  }
  .form-header img {
    border-radius: 10px;
    max-width: 180px;
    margin-bottom: 0.75rem;
    box-shadow: 0 2px 8px rgb(0 0 0 / 0.15);
  }
  h5.section-title {
    margin-top: 1.5rem;
    margin-bottom: 1rem;
    border-bottom: 2px solid #0d6efd;
    padding-bottom: 0.3rem;
    color: #0d6efd;
    font-weight: 600;
  }
  .btn-primary {
    width: 100%;
    font-weight: 600;
    padding: 0.6rem 0;
    font-size: 1.1rem;
    border-radius: 8px;
    transition: background-color 0.3s ease;
  }
  .btn-primary:hover {
    background-color: #0045b5;
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
  </nav>

    <!-- konten -->
    <div class="container py-5" >

        <div class="card card-custom">
            <div class="form-header">
                <img src="<?= base_url('assets/gambar_kapal/' . $kapal['foto_kapal']) ?>" alt="<?= esc($kapal['nama_kapal']) ?>">
                <h3>Form Registrasi & Pemesanan</h3>
                <h4 class="text-primary"><?= esc($kapal['nama_kapal']) ?></h4>
            </div>

          <form method="post" action="<?= base_url("pesan/form_registrasi/{$kapal['id_kapal']}") ?>">
            <?= csrf_field() ?>
            <h5 class="section-title">Data Akun</h5>
            <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" id="username" name="username" value="<?= set_value('username') ?>" class="form-control" placeholder="Masukkan username" required>
            </div>
            <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Minimal 6 karakter" required minlength="6">
            </div>

            <h5 class="section-title">Data Diri</h5>
            <div class="mb-3">
            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
            <input type="text" id="nama_lengkap" name="nama_lengkap" value="<?= set_value('nama_lengkap') ?>" class="form-control" placeholder="Nama lengkap sesuai KTP" required>
            </div>
            <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" value="<?= set_value('email') ?>" class="form-control" placeholder="contoh: email@domain.com" required>
            </div>
            <div class="mb-3">
            <label for="no_hp" class="form-label">No HP</label>
            <input type="tel" id="no_hp" name="no_hp" value="<?= set_value('no_hp') ?>" class="form-control" placeholder="0812xxxxxx" required pattern="[0-9]{10,15}">
            </div>

            <h5 class="section-title">Data Pemesanan</h5>
            <div class="mb-3">
            <label for="tanggal_berangkat" class="form-label">Tanggal & Waktu Keberangkatan</label>
            <input type="datetime-local" id="tanggal_berangkat" name="tanggal_berangkat" value="<?= set_value('tanggal_berangkat') ?>" class="form-control" required>
            </div>
            <div class="mb-3">
            <label for="tanggal_kembali" class="form-label">Tanggal & Waktu Dijemput Kembali</label>
            <input type="datetime-local" id="tanggal_kembali" name="tanggal_kembali" value="<?= set_value('tanggal_kembali') ?>" class="form-control" required>
            </div>
            <div class="mb-3">
            <label for="jumlah_penumpang" class="form-label">Jumlah Penumpang</label>
            <input type="number" id="jumlah_penumpang" name="jumlah_penumpang" value="<?= set_value('jumlah_penumpang') ?>" class="form-control" min="1" max="<?= $kapal['max_penumpang'] ?>" required>
            <div class="form-text">Maksimal penumpang: <?= $kapal['max_penumpang'] ?></div>
            </div>

            <button type="submit" class="btn btn-primary">Daftar & Pesan</button>
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
