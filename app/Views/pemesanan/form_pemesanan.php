<!DOCTYPE html>
<html>
<head>
    <title>Form Pemesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<style>
body {
    background: linear-gradient(135deg, #f8f9fa, #e3f2fd);
}

.booking-card {
    border-radius: 20px;
    box-shadow: 0 20px 50px rgba(0,0,0,0.1);
    border: none;
}

.form-control {
    border-radius: 12px;
}

.btn-premium {
    background: linear-gradient(135deg,#0d6efd,#00b4d8);
    border: none;
    border-radius: 50px;
    padding: 12px;
    font-weight: bold;
    transition: 0.3s;
}

.btn-premium:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.15);
}
</style>

<body>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card booking-card p-4">

                <h3 class="text-center mb-4">Form Pemesanan Kapal</h3>

                <span class="badge bg-primary">
                    <?= ucfirst($kapal['jenis_kapal']) ?>
                </span>

                <div class="alert alert-info">
                    <strong><?= esc($kapal['nama_kapal']) ?></strong><br>
                    Kapasitas Maksimal: <?= esc($kapal['max_penumpang']) ?> orang<br>
                    Harga: Rp <?= number_format($kapal['harga'],0,',','.') ?>
                </div>

                <form action="<?= base_url('pemesanan/simpan') ?>" method="post">

                    <input type="hidden" name="id_kapal" value="<?= $kapal['id_kapal'] ?>">
                    <input type="hidden" id="harga" value="<?= $kapal['harga'] ?>">

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label>Nama Lengkap</label>
                            <input type="text" name="nama_pemesan" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label>No HP (WA Aktif)</label>
                            <input type="text" name="no_hp" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control">
                        </div>

                        <input type="hidden" id="jenis_kapal" value="<?= $kapal['jenis_kapal'] ?>">

                        <input type="hidden" id="max_penumpang" value="<?= $kapal['max_penumpang'] ?>">

                        <div class="col-md-6">
                            <label>Jumlah Penumpang</label>
                            <input type="number" name="jumlah_penumpang" id="jumlah" 
                                   max="<?= $kapal['max_penumpang'] ?>" 
                                   class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label>Tanggal Berangkat</label>
                            <input type="date" name="tanggal_berangkat" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label>Tanggal Kembali</label>
                            <input type="date" name="tanggal_kembali" class="form-control" required>
                        </div>

                        <div class="col-12">
                            <label>Total Harga</label>
                            <input type="text" name="total_harga" id="total" 
                                   class="form-control bg-light" readonly>
                        </div>

                        <div class="col-12 mt-3">
                            <button type="submit" class="btn btn-premium w-100">
                                Kirim Pemesanan
                            </button>
                        </div>

                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

<script>
const harga = parseFloat(document.getElementById('harga').value);
const jenis = document.getElementById('jenis_kapal').value;
const maxPenumpang = parseInt(document.getElementById('max_penumpang').value);

const jumlahInput = document.getElementById('jumlah');
const totalInput = document.getElementById('total');
const submitBtn = document.querySelector('button[type="submit"]');

// 🔥 Buat elemen pesan error dinamis
const errorDiv = document.createElement('div');
errorDiv.classList.add('text-danger', 'mt-2', 'small');
jumlahInput.parentNode.appendChild(errorDiv);

function hitungTotal() {

    let jumlah = parseInt(jumlahInput.value) || 0;

    // ❗ Jika melebihi kapasitas
    if (jumlah > maxPenumpang) {

        jumlahInput.classList.add('is-invalid');
        errorDiv.innerHTML = `Maksimal ${maxPenumpang} penumpang untuk kapal ini.`;
        submitBtn.disabled = true;

        // Reset ke max setelah 1 detik (UX smooth)
        setTimeout(() => {
            jumlahInput.value = maxPenumpang;
            jumlahInput.classList.remove('is-invalid');
            errorDiv.innerHTML = '';
            submitBtn.disabled = false;
            hitungTotal();
        }, 1000);

        return;
    }

    // Jika valid
    jumlahInput.classList.remove('is-invalid');
    errorDiv.innerHTML = '';
    submitBtn.disabled = false;

    if (jenis === 'rombongan') {
        totalInput.value = new Intl.NumberFormat('id-ID').format(harga);
    } else {
        let total = harga * jumlah;
        totalInput.value = new Intl.NumberFormat('id-ID').format(total);
    }
}

// Jika rombongan → langsung tampilkan harga tetap
if (jenis === 'rombongan') {
    totalInput.value = new Intl.NumberFormat('id-ID').format(harga);
}

jumlahInput.addEventListener('input', hitungTotal);
</script>

</body>
</html>
