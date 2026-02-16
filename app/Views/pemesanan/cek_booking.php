<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Status Booking</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #0f172a, #1e293b);
            min-height: 100vh;
            font-family: 'Segoe UI', sans-serif;
            color: #1e293b;
        }

        .main-card {
            border-radius: 24px;
            overflow: hidden;
            border: none;
        }

        .card-header-modern {
            background: linear-gradient(135deg, #111827, #1f2937);
            color: white;
            padding: 30px;
        }

        .section-box {
            background: #f8fafc;
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 25px;
            border: 1px solid #e2e8f0;
        }

        .status-badge {
            font-size: 14px;
            padding: 10px 18px;
            border-radius: 50px;
            font-weight: 600;
            letter-spacing: .5px;
        }

        .btn-modern {
            border-radius: 50px;
            padding: 12px 30px;
            font-weight: 500;
        }

        .info-label {
            font-size: 13px;
            color: #64748b;
        }

        .info-value {
            font-weight: 600;
            font-size: 15px;
        }

        .divider {
            height: 1px;
            background: #e2e8f0;
            margin: 20px 0;
        }

        .timeline-step {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
        }

        .dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .active-dot {
            background: #22c55e;
        }

        .inactive-dot {
            background: #cbd5e1;
        }
    </style>
</head>
<body>

<div class="container py-5">

    <div class="card shadow-lg main-card">

        <!-- HEADER -->
        <div class="card-header-modern">
            <h3 class="mb-2">Status Booking Anda</h3>
            <p class="mb-0 opacity-75">
                Pantau perkembangan reservasi kapal Anda secara real-time
            </p>
        </div>

        <div class="card-body p-4 p-md-5 bg-white">

            <!-- INFORMASI BOOKING -->
            <div class="section-box">

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="info-label">Kode Booking</div>
                        <div class="info-value"><?= esc($booking['kode_booking']) ?></div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="info-label">Nama Pemesan</div>
                        <div class="info-value"><?= esc($booking['nama_pemesan']) ?></div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="info-label">Kapal</div>
                        <div class="info-value"><?= esc($booking['nama_kapal']) ?></div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="info-label">Tanggal Berangkat</div>
                        <div class="info-value"><?= esc($booking['tanggal_berangkat']) ?></div>
                    </div>

                    <div class="col-md-6">
                        <div class="info-label">Total Pembayaran</div>
                        <div class="info-value text-success">
                            Rp <?= number_format($booking['total_harga'],0,',','.') ?>
                        </div>
                    </div>
                </div>

            </div>

            <!-- STATUS -->
            <?php
                $status = $booking['status_booking'];

                $badgeClass = 'secondary';
                if($status == 'menunggu_konfirmasi') $badgeClass = 'warning';
                if($status == 'menunggu_dp') $badgeClass = 'info';
                if($status == 'dp_dibayar') $badgeClass = 'primary';
                if($status == 'disetujui' || $status == 'lunas') $badgeClass = 'success';
                if($status == 'ditolak') $badgeClass = 'danger';
            ?>

            <div class="mb-4">
                <span class="badge bg-<?= $badgeClass ?> status-badge">
                    <?= strtoupper(str_replace('_',' ', $status)) ?>
                </span>
            </div>

            <!-- TIMELINE -->
            <div class="section-box">

                <h6 class="mb-3">Progress Booking</h6>

                <?php
                    $steps = [
                        'menunggu_konfirmasi',
                        'menunggu_dp',
                        'dp_dibayar',
                        'disetujui'
                    ];

                    foreach($steps as $step):
                ?>

                <div class="timeline-step">
                    <div class="dot <?= ($status == $step || array_search($status,$steps) > array_search($step,$steps)) ? 'active-dot' : 'inactive-dot' ?>"></div>
                    <div><?= strtoupper(str_replace('_',' ', $step)) ?></div>
                </div>

                <?php endforeach; ?>

            </div>

            <!-- KONTEN DINAMIS -->
            <?php if($status == 'menunggu_konfirmasi'): ?>
                <div class="alert alert-warning">
                    Pesanan sedang ditinjau oleh admin. Notifikasi akan dikirim via WhatsApp.
                </div>
            <?php endif; ?>

            <?php if($status == 'menunggu_dp'): ?>
                <div class="section-box">
                    <h6>Pembayaran DP</h6>
                    <p>Nominal: <strong>Rp <?= number_format($booking['nominal_dp'],0,',','.') ?></strong></p>
                    <p>Batas Waktu: <strong><?= $booking['batas_waktu_dp'] ?></strong></p>

                    <div class="divider"></div>

                    <form action="<?= site_url('upload-bukti-dp') ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="kode_booking" value="<?= esc($booking['kode_booking']) ?>">
                        <div class="mb-3">
                            <input type="file" name="bukti_bayar" class="form-control" required>
                        </div>
                        <button class="btn btn-dark btn-modern">Upload Bukti Pembayaran</button>
                    </form>
                </div>
            <?php endif; ?>

            <?php if($status == 'dp_dibayar'): ?>
                <div class="alert alert-primary">
                    Pembayaran sedang diverifikasi oleh admin.
                </div>
            <?php endif; ?>

            <?php if($status == 'disetujui' || $status == 'lunas'): ?>
                <div class="alert alert-success">
                    <h6 class="mb-2">Booking Dikonfirmasi 🎉</h6>
                    Silakan hadir sesuai jadwal dan tunjukkan tiket Anda.
                </div>
            <?php endif; ?>

            <?php if($status == 'ditolak'): ?>
                <div class="alert alert-danger">
                    <strong>Pemesanan Ditolak</strong><br>
                    <?= esc($booking['alasan_penolakan']) ?>
                </div>
            <?php endif; ?>

            <a href="/" class="btn btn-outline-dark btn-modern mt-3">
                Kembali ke Beranda
            </a>

        </div>
    </div>

</div>

</body>
</html>
