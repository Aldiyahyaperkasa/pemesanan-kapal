<?= $this->extend('admin/layout'); ?>
<?= $this->section('content'); ?>

<style>
/* ===== PREMIUM EDIT FORM STYLE ===== */
.page-header {
    margin-bottom: 5px;
}
.breadcrumb-modern {
    font-size: 13px;
    color: #6b7280;
}
.form-wrapper {
    max-width: 850px;
    margin: 40px auto;
}

.premium-card {
    background: #ffffff;
    border-radius: 18px;
    box-shadow: 0 15px 45px rgba(0,0,0,0.06);
    border: 1px solid #f1f1f1;
    overflow: hidden;
}

.premium-header {
    padding: 28px 32px;
    border-bottom: 1px solid #f2f2f2;
    background: linear-gradient(135deg, #f9fafb, #ffffff);
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

.premium-body {
    padding: 32px;
}

.section-title {
    font-size: 12px;
    text-transform: uppercase;
    font-weight: 600;
    letter-spacing: .6px;
    color: #999;
    margin-bottom: 20px;
}

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
    border-color: #2563eb;
    box-shadow: 0 0 0 4px rgba(37,99,235,0.08);
    outline: none;
}

.premium-footer {
    padding: 20px 32px;
    background: #fafafa;
    border-top: 1px solid #f2f2f2;
    display: flex;
    justify-content: flex-end;
    gap: 12px;
}

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

.btn-update {
    background: linear-gradient(135deg, #16a34a, #15803d);
    color: white;
    padding: 10px 22px;
    border-radius: 10px;
    font-size: 14px;
    border: none;
    transition: .2s;
}

.btn-update:hover {
    opacity: .9;
}
</style>
<div class="page-header">
    <div class="breadcrumb-modern">
        Dashboard / Manajemen Akun Pemilik Kapal / Edit
    </div>
</div>
<div class="col-12">
    <div class="form-wrapper">

        <div class="premium-card">

            <!-- HEADER -->
            <div class="premium-header">
                <h4 class="premium-title">Edit Pemilik Kapal</h4>
                <div class="premium-subtitle">
                    Perbarui informasi pemilik kapal dalam sistem
                </div>
            </div>

            <!-- FORM -->
            <form method="post"
                  action="<?= site_url('admin/kelola-akun/pemilik-kapal/update/'.$pemilik['id_pemilik']); ?>">

                <div class="premium-body">

                    <div class="section-title">Informasi Pemilik</div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group-premium">
                                <label class="label-premium">Nama Lengkap</label>
                                <input type="text"
                                       name="nama_lengkap"
                                       class="input-premium"
                                       value="<?= esc($pemilik['nama_lengkap']); ?>"
                                       required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group-premium">
                                <label class="label-premium">No HP</label>
                                <input type="text"
                                       name="no_hp"
                                       class="input-premium"
                                       value="<?= esc($pemilik['no_hp']); ?>"
                                       required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group-premium">
                                <label class="label-premium">Email</label>
                                <input type="email"
                                       name="email"
                                       class="input-premium"
                                       value="<?= esc($pemilik['email']); ?>">
                            </div>
                        </div>
                    </div>

                </div>

                <!-- FOOTER -->
                <div class="premium-footer">
                    <a href="<?= site_url('admin/kelola-akun/pemilik-kapal'); ?>"
                       class="btn-cancel">
                        Batal
                    </a>
                    <button type="submit" class="btn-update">
                        Update Pemilik
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>
