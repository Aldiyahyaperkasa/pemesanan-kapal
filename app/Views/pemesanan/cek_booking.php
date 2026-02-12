<!DOCTYPE html>
<html>
<head>
    <title>Cek Status Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card shadow p-4">

        <h3 class="mb-3">Status Booking</h3>

        <p><strong>Kode Booking:</strong> <?= esc($booking['kode_booking']) ?></p>
        <p><strong>Nama Pemesan:</strong> <?= esc($booking['nama_pemesan']) ?></p>
        <p><strong>Status:</strong> 
            <span class="badge bg-warning">
                <?= esc($booking['status_booking']) ?>
            </span>
        </p>

        <p><strong>Total Harga:</strong> 
            Rp <?= number_format($booking['total_harga'],0,',','.') ?>
        </p>

        <a href="/" class="btn btn-primary mt-3">
            Kembali ke Beranda
        </a>

    </div>
</div>

</body>
</html>
