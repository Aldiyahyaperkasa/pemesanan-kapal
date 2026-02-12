<?= $this->extend('admin/layout'); ?>
<?= $this->section('content'); ?>

<style>
/* ===== PREMIUM FORM LAYOUT ===== */

.form-wrapper {
    max-width: 900px;
    margin: 40px auto;
}

.premium-card {
    background: #ffffff;
    border-radius: 16px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.06);
    border: 1px solid #f1f1f1;
    overflow: hidden;
}

/* HEADER */
.premium-header {
    padding: 28px 32px;
    border-bottom: 1px solid #f2f2f2;
}

.premium-title {
    font-size: 20px;
    font-weight: 600;
    margin: 0;
}

.premium-subtitle {
    font-size: 14px;
    color: #777;
    margin-top: 6px;
}

/* BODY */
.premium-body {
    padding: 32px;
}

/* SECTION TITLE */
.section-title {
    font-size: 12px;
    text-transform: uppercase;
    font-weight: 600;
    letter-spacing: .6px;
    color: #999;
    margin-bottom: 20px;
}

/* INPUT */
.form-group-premium {
    margin-bottom: 22px;
}

.label-premium {
    font-size: 13px;
    font-weight: 500;
    margin-bottom: 8px;
    display: block;
}

.input-premium {
    width: 100%;
    padding: 12px 14px;
    border-radius: 10px;
    border: 1px solid #e6e6e6;
    font-size: 14px;
    background: #f9fafb;
    transition: all .25s ease;
}

.input-premium:focus {
    background: #fff;
    border-color: #3b82f6;
    box-shadow: 0 0 0 4px rgba(59,130,246,0.08);
    outline: none;
}

/* FOOTER */
.premium-footer {
    padding: 20px 32px;
    background: #fafafa;
    border-top: 1px solid #f2f2f2;
    display: flex;
    justify-content: flex-end;
    gap: 12px;
}

/* BUTTON */
.btn-cancel {
    background: #e5e7eb;
    color: #333;
    padding: 10px 18px;
    border-radius: 10px;
    text-decoration: none;
    font-size: 14px;
    transition: .2s;
}

.btn-cancel:hover {
    background: #d1d5db;
}

.btn-save {
    background: #2563eb;
    color: white;
    padding: 10px 22px;
    border-radius: 10px;
    font-size: 14px;
    border: none;
    transition: .2s;
}

.btn-save:hover {
    background: #1d4ed8;
}
</style>

<div class="col-12">

    <div class="form-wrapper">

        <div class="premium-card">

            <!-- HEADER -->
            <div class="premium-header">
                <h4 class="premium-title">Tambah Admin</h4>
                <div class="premium-subtitle">
                    Tambahkan administrator baru ke dalam sistem
                </div>
            </div>

            <!-- BODY -->
            <div class="premium-body">

                <form method="post" action="<?= site_url('admin/kelola-akun/admin/store'); ?>">

                    <!-- INFORMASI DASAR -->
                    <div class="section-title">Informasi Dasar</div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group-premium">
                                <label class="label-premium">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" 
                                       class="input-premium" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group-premium">
                                <label class="label-premium">Username</label>
                                <input type="text" name="username" 
                                       class="input-premium" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group-premium">
                                <label class="label-premium">Email</label>
                                <input type="email" name="email" 
                                       class="input-premium">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group-premium">
                                <label class="label-premium">No HP</label>
                                <input type="text" name="no_hp" 
                                       class="input-premium">
                            </div>
                        </div>
                    </div>

                    <!-- KEAMANAN -->
                    <div class="section-title mt-4">Keamanan</div>

                    <div class="form-group-premium">
                        <label class="label-premium">Password</label>
                        <input type="password" name="password" 
                               class="input-premium" required>
                    </div>

            </div>

            <!-- FOOTER -->
            <div class="premium-footer">
                <a href="<?= site_url('admin/kelola-akun/admin'); ?>" 
                   class="btn-cancel">
                    Batal
                </a>
                <button type="submit" class="btn-save">
                    Simpan Admin
                </button>
            </div>

                </form>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>
