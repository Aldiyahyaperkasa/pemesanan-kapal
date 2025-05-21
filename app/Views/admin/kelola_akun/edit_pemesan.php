<?= $this->extend('admin/layout'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 mx-auto">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="text-primary fw-bold"><i class="bi bi-pencil-square me-2"></i>Edit Akun Pemesan</h3>    
        <a href="<?= base_url('akun_pemesan/index') ?>" class="btn btn-sm btn-outline-secondary rounded-pill px-4">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>        
    </div>
    <div class="card shadow">
        <div class="card-body p-5">
            <form action="<?= base_url('akun_pemesan/edit/' . $pemesan['id_pemesan']) ?>" method="post">
                <div class="mb-3">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control rounded-pill" id="nama_lengkap" name="nama_lengkap" value="<?= esc($pemesan['nama_lengkap']) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control rounded-pill" id="email" name="email" value="<?= esc($pemesan['email']) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control rounded-pill" id="username" name="username" value="<?= esc($pemesan['username']) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Kata Sandi <small class="text-muted">(kosongkan jika tidak ingin diubah)</small></label>
                    <input type="password" class="form-control rounded-pill" id="password" name="password" placeholder="Masukkan kata sandi baru jika ingin mengubah">
                </div>

                <div class="mb-4">
                    <label for="no_hp" class="form-label">No HP</label>
                    <input type="text" class="form-control rounded-pill" id="no_hp" name="no_hp" value="<?= esc($pemesan['no_hp']) ?>">
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-save me-1"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
