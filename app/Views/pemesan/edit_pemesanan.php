<?= $this->extend('pemesan/layout'); ?>
<?= $this->section('content'); ?>


<style>
    .card-tourism {
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        margin-bottom: 2rem;
        margin-top: 30px;
    }

    .header-banner {
        background: linear-gradient(to right, #0077b6, #00b4d8);
        color: white;
        padding: 1rem 2rem;
        font-weight: bold;
        font-size: 1.5rem;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    .img-kapal {
        width: 100%;
        max-height: 230px;
        object-fit: cover;
        border-radius: 10px;
    }

    .form-label {
        font-weight: 500;
    }

    .btn-wisata {
        background-color: #FFA500;
        color: white;
        border: none;
    }

    .btn-wisata:hover {
        background-color: #ff8800;
    }
</style>

<div class="container">
    <div class="card-tourism">
        <?php if ($pemesanan['status_pemilik'] === 'menunggu' && $pemesanan['status_admin'] === 'menunggu'): ?>
            <div class="header-banner">Edit Pemesanan Anda</div>

            <div class="row p-4">
                <div class="col-md-5 text-center">
                    <img src="<?= base_url('assets/gambar_kapal/' . $pemesanan['foto_kapal']) ?>" class="img-fluid img-kapal" alt="Gambar Kapal">
                    <p class="mt-2 mb-0 text-muted"><small>Kapal: <?= esc($pemesanan['nama_kapal']) ?></small></p>
                </div>

                <div class="col-md-7 ps-md-4 pt-3 pt-md-0">
                    <form action="<?= base_url('pemesan/update/' . $pemesanan['id_pemesanan']) ?>" method="post">
                        <div class="mb-3">
                            <label class="form-label">Nama Pemesan</label>
                            <input type="text" class="form-control" value="<?= esc($pemesanan['nama_lengkap']) ?>" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" value="<?= esc($pemesanan['email']) ?>" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">No HP</label>
                            <input type="text" class="form-control" value="<?= esc($pemesanan['no_hp']) ?>" readonly>
                        </div>

                        <input type="hidden" id="jenis_kapal" value="<?= esc($pemesanan['jenis_kapal']) ?>">


                        <div class="mb-3">
                            <label for="tanggal_berangkat" class="form-label">Tanggal Berangkat</label>
                            <input type="date" name="tanggal_berangkat" id="tanggal_berangkat" class="form-control"
                                   value="<?= esc($pemesanan['tanggal_berangkat']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
                            <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="form-control"
                                   value="<?= esc($pemesanan['tanggal_kembali']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="jumlah_penumpang" class="form-label">Jumlah Penumpang</label>
                            <input type="number" name="jumlah_penumpang" id="jumlah_penumpang" class="form-control"
                                   value="<?= esc($pemesanan['jumlah_penumpang']) ?>" min="1" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Total Harga</label>
                            <input type="text" id="total_harga_display" class="form-control" value="Rp <?= number_format($pemesanan['total_harga'], 0, ',', '.') ?>" readonly>
                        </div>

                        <input type="hidden" id="harga_per_orang" value="<?= esc($pemesanan['total_harga'] / $pemesanan['jumlah_penumpang']) ?>">
                        <input type="hidden" name="total_harga" id="total_harga" value="<?= esc($pemesanan['total_harga']) ?>">

                        <button type="submit" class="btn btn-wisata">Simpan Perubahan</button>
                        <a href="<?= base_url('pemesan/index') ?>" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-info text-center">
                Pemesanan tidak bisa diubah karena sedang diproses atau sudah diverifikasi.
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
    const jenisKapal = document.getElementById('jenis_kapal').value;

    if (jenisKapal === 'perorangan') {
        document.getElementById('jumlah_penumpang').addEventListener('input', function () {
            let jumlah = parseInt(this.value);
            let hargaPerOrang = parseInt(document.getElementById('harga_per_orang').value);
            let total = jumlah * hargaPerOrang;

            document.getElementById('total_harga_display').value = 'Rp ' + total.toLocaleString('id-ID');
            document.getElementById('total_harga').value = total;
        });
    }
</script>


<?= $this->endSection('content'); ?>
