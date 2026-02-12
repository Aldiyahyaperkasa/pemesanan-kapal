<?= $this->extend('admin/layout'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-8">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">

            <h4 class="fw-bold mb-1">Tambah Pemilik Kapal</h4>
            <small class="text-muted d-block mb-4">Isi data pemilik kapal baru</small>

            <form method="post" action="<?= site_url('admin/kelola-akun/pemilik-kapal/store'); ?>">

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control rounded-3" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" class="form-control rounded-3">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">No HP</label>
                        <input type="text" name="no_hp" class="form-control rounded-3">
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-end">
                    <a href="<?= site_url('admin/kelola-akun/pemilik-kapal'); ?>" 
                       class="btn btn-light rounded-3 me-2">Batal</a>
                    <button type="submit" class="btn btn-primary rounded-3 px-4">
                        Simpan
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>
