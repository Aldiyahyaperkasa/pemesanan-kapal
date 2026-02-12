<?= $this->extend('admin/layout'); ?>
<?= $this->section('content'); ?>

<div class="col-12">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="mb-1 fw-bold">Kelola Pemilik Kapal</h4>
                    <small class="text-muted">Manajemen data pemilik kapal / nelayan</small>
                </div>
                <a href="<?= site_url('admin/kelola-akun/pemilik-kapal/create'); ?>" 
                   class="btn btn-primary rounded-3 px-4">
                    + Tambah Pemilik
                </a>
            </div>

            <div class="table-responsive">
                <table class="table align-middle table-hover">
                    <thead class="bg-light">
                        <tr>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>No HP</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pemilik as $p): ?>
                        <tr>
                            <td class="fw-semibold"><?= $p['nama_lengkap']; ?></td>
                            <td><?= $p['email']; ?></td>
                            <td><?= $p['no_hp']; ?></td>
                            <td class="text-end">
                                <a href="<?= site_url('admin/kelola-akun/pemilik-kapal/edit/'.$p['id_pemilik']); ?>" 
                                   class="btn btn-sm btn-outline-warning rounded-3 me-2">
                                   Edit
                                </a>
                                <a href="<?= site_url('admin/kelola-akun/pemilik-kapal/delete/'.$p['id_pemilik']); ?>" 
                                   class="btn btn-sm btn-outline-danger rounded-3"
                                   onclick="return confirm('Yakin ingin menghapus data ini?')">
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
