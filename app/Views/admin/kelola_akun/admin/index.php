<?= $this->extend('admin/layout'); ?>
<?= $this->section('content'); ?>

<style>
/* ===== MODERN ACCOUNT MANAGEMENT ===== */
/* CARD */
.modern-card {
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    padding: 0;
    border: 1px solid #f1f1f1;
}

.modern-card-header {
    padding: 20px 24px;
    border-bottom: 1px solid #f3f3f3;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.modern-title {
    font-weight: 600;
    margin: 0;
    font-size: 18px;
}

.modern-subtitle {
    font-size: 13px;
    color: #888;
    margin: 3px 0 0 0;
}

.modern-card-body {
    padding: 20px 24px;
}

/* BUTTON */
.btn-modern-primary {
    background: #3b82f6;
    color: white;
    padding: 8px 14px;
    border-radius: 8px;
    font-size: 13px;
    text-decoration: none;
    transition: 0.2s ease;
}

.btn-modern-primary:hover {
    background: #2563eb;
    color: #fff;
}

/* TABLE */
.modern-table {
    width: 100%;
    border-collapse: collapse;
}

.modern-table thead th {
    font-size: 12px;
    text-transform: uppercase;
    color: #888;
    font-weight: 600;
    padding: 12px;
    background: #f9fafb;
}

.modern-table tbody td {
    padding: 14px 12px;
    border-bottom: 1px solid #f1f1f1;
    font-size: 14px;
    vertical-align: middle;
}

.modern-table tbody tr:hover {
    background: #f9fbff;
}

/* USER CELL */
.user-cell {
    display: flex;
    align-items: center;
    gap: 12px;
}

.avatar-circle {
    width: 38px;
    height: 38px;
    border-radius: 8px; /* bukan bulat penuh */
    background: #e0f2fe;
    color: #0369a1;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 14px;
}

.user-name {
    font-weight: 500;
}

.user-username {
    font-size: 12px;
    color: #888;
}

/* ACTION BUTTON */
.btn-action {
    font-size: 13px;
    padding: 6px 10px;
    border-radius: 6px;
    text-decoration: none;
    margin-left: 6px;
    transition: 0.2s;
}

.btn-action.edit {
    background: #e0f2fe;
    color: #0369a1;
}

.btn-action.edit:hover {
    background: #bae6fd;
}

.btn-action.delete {
    background: #fee2e2;
    color: #b91c1c;
}

.btn-action.delete:hover {
    background: #fecaca;
}

</style>

<div class="col-12">

    <div class="modern-card">

        <!-- Header -->
        <div class="modern-card-header">
            <div>
                <h5 class="modern-title">Manajemen Akun Admin</h5>
                <p class="modern-subtitle">Kelola administrator sistem secara profesional</p>
            </div>
            <a href="<?= site_url('admin/kelola-akun/admin/create') ?>" 
               class="btn btn-modern-primary">
                <i class="ti ti-plus me-1"></i> Tambah Admin
            </a>
        </div>

        <!-- Body -->
        <div class="modern-card-body">

            <div class="table-responsive">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th>Admin</th>
                            <th>Email</th>
                            <th>No HP</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($admin as $a): ?>
                        <tr>
                            <td>
                                <div class="user-cell">
                                    <div class="avatar-circle">
                                        <?= strtoupper(substr($a['username'],0,1)); ?>
                                    </div>
                                    <div>
                                        <div class="user-name"><?= $a['nama_lengkap']; ?></div>
                                        <div class="user-username">@<?= $a['username']; ?></div>
                                    </div>
                                </div>
                            </td>
                            <td><?= $a['email']; ?></td>
                            <td><?= $a['no_hp']; ?></td>
                            <td class="text-end">
                                <a href="<?= site_url('admin/kelola-akun/admin/edit/'.$a['id_admin']); ?>" 
                                   class="btn-action edit">
                                   Edit
                                </a>
                                <a href="<?= site_url('admin/kelola-akun/admin/delete/'.$a['id_admin']); ?>" 
                                   class="btn-action delete"
                                   onclick="return confirm('Hapus akun ini?')">
                                   Hapus
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>
