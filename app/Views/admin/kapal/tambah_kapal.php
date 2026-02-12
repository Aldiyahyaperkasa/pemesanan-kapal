<?= $this->extend('admin/layout'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 mx-auto">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="text-primary fw-bold"><i class="bi bi-plus-circle me-2"></i>Tambah Data Kapal</h3>    
        <a href="<?= base_url('kapal/index') ?>" class="btn btn-sm btn-outline-secondary rounded-pill px-4">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>        
    </div>
    <div class="card shadow">
        <div class="card-body p-5">
            <form action="<?= base_url('kapal/tambah') ?>" method="post" enctype="multipart/form-data">
         
                <div class="mb-3">
                    <label for="nama_kapal" class="form-label">Nama Kapal</label>
                    <input type="text" class="form-control rounded-pill" id="nama_kapal" name="nama_kapal" required>
                </div>

                <div class="mb-3">
                    <label for="jenis_kapal" class="form-label">Jenis Kapal</label>
                    <select class="form-select rounded-pill" id="jenis_kapal" name="jenis_kapal" required>
                        <option value="" disabled selected>Pilih Jenis Kapal</option>
                        <option value="perorangan" <?= old('jenis_kapal') == 'perorangan' ? 'selected' : '' ?>>Perorangan</option>
                        <option value="rombongan" <?= old('jenis_kapal') == 'rombongan' ? 'selected' : '' ?>>Rombongan</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" class="form-control rounded-pill" id="harga" name="harga" required>
                </div>

                <div class="mb-3">
                    <label for="max_penumpang" class="form-label">Maksimal Penumpang</label>
                    <input type="number" class="form-control rounded-pill" id="max_penumpang" name="max_penumpang" required>
                </div>

                <div class="mb-3">
                    <label for="foto_kapal" class="form-label">Foto Kapal</label>
                    <input type="file" class="form-control rounded-pill" id="foto_kapal" name="foto_kapal" accept="image/*">
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control rounded" id="deskripsi" name="deskripsi" rows="3"></textarea>
                </div>

                <div class="mb-4">
                    <label for="tersedia" class="form-label">Tersedia</label>
                    <select class="form-select rounded-pill" id="tersedia" name="tersedia" required>
                        <option value="1" selected>Ya</option>
                        <option value="0">Tidak</option>
                    </select>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-save me-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
