<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<style>

/* ===== Page Header ===== */
.page-header {
    margin-bottom: 25px;
}
.breadcrumb-modern {
    font-size: 13px;
    color: #6b7280;
}

/* ===== Premium Card ===== */
.premium-card {
    background: #ffffff;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.06);
    border: 1px solid #f1f5f9;
    overflow: hidden;
}

/* ===== Section Divider ===== */
.section-divider {
    font-weight: 600;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: .5px;
    color: #94a3b8;
    margin-bottom: 20px;
}

/* ===== Floating Input ===== */
.form-floating > .form-control,
.form-floating > .form-select {
    border-radius: 12px;
    border: 1px solid #e5e7eb;
}

.form-floating > .form-control:focus,
.form-floating > .form-select:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 4px rgba(59,130,246,0.1);
}

/* ===== Modern Switch ===== */
.form-switch .form-check-input {
    width: 48px;
    height: 24px;
    cursor: pointer;
}

/* ===== Sticky Footer Action ===== */
.action-bar {
    background: #ffffff;
    padding: 18px 24px;
    border-top: 1px solid #f1f5f9;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

/* ===== Buttons ===== */
.btn-modern {
    border-radius: 12px;
    padding: 10px 22px;
    font-weight: 600;
}

.btn-gradient {
    background: linear-gradient(135deg,#2563eb,#1e40af);
    border: none;
    color: #fff;
}

.btn-gradient:hover {
    opacity: 0.95;
}

.badge-soft {
    background: #eff6ff;
    color: #2563eb;
    padding: 6px 12px;
    border-radius: 50px;
    font-size: 12px;
    font-weight: 500;
}
/* ===== Premium Upload (Sama Seperti Create) ===== */
.upload-wrapper {
    position: relative;
}

.upload-box {
    border: 1px dashed #d1d5db;
    border-radius: 12px;
    padding: 28px 20px;
    text-align: center;
    background: #f9fafb;
    cursor: pointer;
    transition: all .2s ease;
}

.upload-box:hover {
    border-color: #3b82f6;
    background: #f0f7ff;
}

.upload-box i {
    font-size: 28px;
    color: #94a3b8;
    margin-bottom: 8px;
}

.upload-box p {
    margin: 0;
    font-size: 13px;
    color: #64748b;
}

.upload-wrapper input[type="file"] {
    position: absolute;
    inset: 0;
    opacity: 0;
    cursor: pointer;
}

</style>

<!-- ===== Header ===== -->
<div class="page-header">
    <div class="breadcrumb-modern">
        Dashboard / Kelola Kapal / Edit
    </div>
</div>

<!-- ===== Card ===== -->
<div class="premium-card">

    <form action="<?= site_url('admin/kelola-kapal/update/'.$kapal['id_kapal']) ?>" method="post" enctype="multipart/form-data">

        <div class="p-4">

            <!-- ===== Informasi Utama ===== -->
            <div class="section-divider">Informasi Utama</div>

            <div class="row g-4">

                <div class="col-md-6">
                    <div class="form-floating">
                        <select name="id_pemilik" class="form-select" required>
                            <?php foreach($pemilik as $p): ?>
                                <option value="<?= $p['id_pemilik'] ?>"
                                    <?= $p['id_pemilik']==$kapal['id_pemilik']?'selected':'' ?>>
                                    <?= $p['nama_lengkap'] ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                        <label>Pemilik Kapal</label>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text"
                               name="nama_kapal"
                               value="<?= $kapal['nama_kapal'] ?>"
                               class="form-control"
                               placeholder="Nama Kapal"
                               required>
                        <label>Nama Kapal</label>
                    </div>
                </div>

            </div>

            <!-- ===== Detail Operasional ===== -->
            <div class="section-divider mt-5">Detail Operasional</div>

            <div class="row g-4">
<div class="col-md-12">

    <div class="upload-wrapper">
        <div class="upload-box">

            <i class="bi bi-cloud-upload"></i>

            <div class="fw-semibold">
                <?= $kapal['foto_kapal'] ? 'Ganti Foto Kapal' : 'Upload Foto Kapal' ?>
            </div>

            <p>JPG / PNG • Maks 2MB</p>

            <?php if($kapal['foto_kapal']) : ?>
                <img id="previewImage"
                     src="<?= base_url('uploads/kapal/'.$kapal['foto_kapal']) ?>"
                     class="img-fluid rounded-4 shadow-sm mt-3"
                     style="max-height:180px;">
            <?php else: ?>
                <img id="previewImage"
                     class="img-fluid rounded-4 shadow-sm mt-3"
                     style="max-height:180px; display:none;">
            <?php endif; ?>

        </div>

        <input type="file"
               name="foto_kapal"
               id="fotoInput"
               accept="image/*">

    </div>

</div>

                <div class="col-md-4">
                    <div class="form-floating">
                        <select name="jenis_kapal" class="form-select">
                            <option value="perorangan"
                                <?= $kapal['jenis_kapal']=='perorangan'?'selected':'' ?>>
                                Perorangan
                            </option>
                            <option value="rombongan"
                                <?= $kapal['jenis_kapal']=='rombongan'?'selected':'' ?>>
                                Rombongan
                            </option>
                        </select>
                        <label>Jenis Kapal</label>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-floating">
                        <input type="text"
                               id="harga"
                               name="harga"
                               value="<?= $kapal['harga'] ?>"
                               class="form-control"
                               placeholder="Harga"
                               required>
                        <label>Harga Sewa (Rp)</label>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-floating">
                        <input type="number"
                               name="max_penumpang"
                               value="<?= $kapal['max_penumpang'] ?>"
                               class="form-control"
                               placeholder="Max Penumpang"
                               required>
                        <label>Maksimal Penumpang</label>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-floating">
                        <textarea name="deskripsi"
                                  class="form-control"
                                  placeholder="Deskripsi"
                                  style="height:100px"><?= $kapal['deskripsi'] ?></textarea>
                        <label>Deskripsi Kapal</label>
                    </div>
                </div>

                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-between p-3 rounded-3"
                         style="background:#f8fafc; border:1px solid #e5e7eb;">
                        <div>
                            <div class="fw-semibold">Status Ketersediaan</div>
                            <div class="text-muted" style="font-size:13px;">
                                Aktifkan jika kapal tersedia untuk pemesanan
                            </div>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input"
                                   type="checkbox"
                                   name="tersedia"
                                   value="1"
                                   <?= $kapal['tersedia']==1?'checked':'' ?>>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- ===== Action Bar ===== -->
        <div class="action-bar">
            <a href="<?= site_url('admin/kelola-kapal') ?>"
               class="btn btn-light btn-modern">
                ← Kembali
            </a>

            <button type="submit"
                    class="btn btn-gradient btn-modern">
                Simpan Perubahan
            </button>
        </div>

    </form>
</div>

<!-- ===== Script Format Rupiah ===== -->
<script>
document.getElementById('harga').addEventListener('input', function(e) {
    let value = this.value.replace(/[^0-9]/g, '');
    this.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
});
</script>

<script>
document.getElementById('fotoInput')
.addEventListener('change', function(e){

    const file = e.target.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function(e){

        let preview = document.getElementById('previewImage');
        preview.style.display = "block";
        preview.src = e.target.result;

    }
    reader.readAsDataURL(file);
});
</script>

<?= $this->endSection() ?>
