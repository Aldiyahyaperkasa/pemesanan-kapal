<!DOCTYPE html>
<html>
<head>
    <title>Tiket Resmi</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f4f4;
        }
        .ticket {
            width: 650px;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .title {
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .kode {
            text-align: center;
            background: #000;
            color: #fff;
            padding: 10px;
            margin-bottom: 20px;
            font-weight: bold;
        }
        .row {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<hr>

<div style="text-align:center; margin-top:20px;">
    <a href="<?= base_url('tiket/' . $tiket['file_tiket']); ?>" 
       style="background:#000;color:#fff;padding:10px 20px;text-decoration:none;border-radius:5px;"
       download>
        Download Tiket PDF
    </a>
</div>

<div class="ticket">

    <div class="title">🎟 TIKET RESMI BERAS BASAH</div>

    <div class="kode">
        <?= $tiket['kode_tiket']; ?>
    </div>

    <div class="row"><strong>Nama:</strong> <?= $tiket['nama_pemesan']; ?></div>
    <div class="row"><strong>Kapal:</strong> <?= $tiket['nama_kapal']; ?></div>
    <div class="row"><strong>Tanggal Berangkat:</strong> <?= $tiket['tanggal_berangkat']; ?></div>
    <div class="row"><strong>Tanggal Kembali:</strong> <?= $tiket['tanggal_kembali']; ?></div>
    <div class="row"><strong>Jumlah Penumpang:</strong> <?= $tiket['jumlah_penumpang']; ?></div>
    <div class="row"><strong>Total:</strong> Rp <?= number_format($tiket['total_harga'],0,',','.'); ?></div>

    <hr>

    <p>
        Tunjukkan tiket ini saat hari keberangkatan.
        Tiket ini terdaftar resmi di sistem Beras Basah.
    </p>

</div>

</body>
</html>
