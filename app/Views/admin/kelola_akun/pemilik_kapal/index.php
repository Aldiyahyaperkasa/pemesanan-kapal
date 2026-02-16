<?= $this->extend('admin/layout'); ?>
<?= $this->section('content'); ?>

<style>
/* ===== PREMIUM PEMILIK KAPAL MANAGEMENT ===== */
.page-header {
    margin-bottom: 5px;
}
.breadcrumb-modern {
    font-size: 13px;
    color: #6b7280;
}
.premium-card {
    background: #ffffff;
    border-radius: 16px;
    box-shadow: 0 10px 35px rgba(0,0,0,0.05);
    border: 1px solid #f1f1f1;
    overflow: hidden;
}

.premium-header {
    padding: 24px 28px;
    border-bottom: 1px solid #f2f2f2;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.premium-title {
    font-size: 18px;
    font-weight: 600;
    margin: 0;
}

.premium-subtitle {
    font-size: 13px;
    color: #888;
    margin-top: 4px;
}

.btn-primary-modern {
    background: linear-gradient(135deg, #2563eb, #1e40af);
    color: white;
    padding: 8px 16px;
    border-radius: 10px;
    font-size: 13px;
    text-decoration: none;
    transition: .2s;
}

.btn-primary-modern:hover {
    opacity: .9;
    color: #fff;
}

/* TABLE */
.table-wrapper {
    padding: 20px 28px 28px 28px;
}

.modern-table {
    width: 100%;
    border-collapse: collapse;
}

.modern-table thead th {
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: .5px;
    color: #999;
    font-weight: 600;
    padding: 14px 12px;
    background: #f9fafb;
}

.modern-table tbody td {
    padding: 16px 12px;
    border-bottom: 1px solid #f1f1f1;
    font-size: 14px;
    vertical-align: middle;
}

.modern-table tbody tr:hover {
    background: #f8fbff;
}

/* USER CELL */
.user-cell {
    display: flex;
    align-items: center;
    gap: 14px;
}

.avatar-box {
    width: 40px;
    height: 40px;
    border-radius: 12px;
    background: #dbeafe;
    color: #1e3a8a;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 14px;
}

.user-name {
    font-weight: 500;
}

.user-email {
    font-size: 12px;
    color: #888;
}

/* ACTION */
.btn-action {
    font-size: 13px;
    padding: 6px 12px;
    border-radius: 8px;
    text-decoration: none;
    margin-left: 6px;
    transition: .2s;
}

.btn-edit {
    background: #e0f2fe;
    color: #0369a1;
}

.btn-edit:hover {
    background: #bae6fd;
}

.btn-delete {
    background: #fee2e2;
    color: #b91c1c;
}

.btn-delete:hover {
    background: #fecaca;
}

/* EMPTY STATE */
.empty-state {
    text-align: center;
    padding: 60px 20px;
    color: #888;
}

.empty-state i {
    font-size: 40px;
    margin-bottom: 12px;
    display: block;
    color: #d1d5db;
}
</style>
<div class="page-header">
    <div class="breadcrumb-modern">
        Dashboard / Manajemen Akun Pemilik Kapal
    </div>
</div>
<div class="col-12">

    <div class="premium-card">

        <!-- HEADER -->
        <div class="premium-header">
            <div>
                <h5 class="premium-title">Manajemen Pemilik Kapal</h5>
                <div class="premium-subtitle">
                    Kelola data pemilik kapal dalam sistem
                </div>
            </div>

            <a href="<?= site_url('admin/kelola-akun/pemilik-kapal/create'); ?>"
               class="btn-primary-modern">
               <i class="ti ti-plus me-1"></i> Tambah Pemilik
            </a>
        </div>

        <!-- BODY -->
        <div class="table-wrapper">

            <?php if (empty($pemilik)) : ?>
                <div class="empty-state">
                    <i class="ti ti-users"></i>
                    <div>Belum ada data pemilik kapal.</div>
                </div>
            <?php else : ?>

            <div class="table-responsive">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th>Pemilik</th>
                            <th>No HP</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pemilik as $p): ?>
                        <tr>
                            <td>
                                <div class="user-cell">
                                    <div class="avatar-box">
                                        <?= strtoupper(substr($p['nama_lengkap'],0,1)); ?>
                                    </div>
                                    <div>
                                        <div class="user-name"><?= $p['nama_lengkap']; ?></div>
                                        <div class="user-email"><?= $p['email']; ?></div>
                                    </div>
                                </div>
                            </td>
                            <td><?= $p['no_hp']; ?></td>
                            <td class="text-end">
                                <a href="<?= site_url('admin/kelola-akun/pemilik-kapal/edit/'.$p['id_pemilik']); ?>"
                                   class="btn-action btn-edit">
                                   Edit
                                </a>

                                <a href="<?= site_url('admin/kelola-akun/pemilik-kapal/delete/'.$p['id_pemilik']); ?>"
                                   class="btn-action btn-delete"
                                   onclick="return confirm('Hapus pemilik kapal ini?')">
                                   Hapus
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <?php endif; ?>

        </div>

    </div>

</div>

<?= $this->endSection(); ?>
