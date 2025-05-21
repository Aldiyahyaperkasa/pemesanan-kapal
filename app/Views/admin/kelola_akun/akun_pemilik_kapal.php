<?= $this->extend('admin/layout'); ?>
<?= $this->section('content'); ?>

<div class="col-12">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-primary">Kelola Akun Pemilik Kapal</h3>        
        <a href="<?= base_url('akun_pemilik_kapal/tambah') ?>" class="btn btn-primary rounded-pill">
            <i class="bi bi-plus-circle me-2"></i>Tambah Pemilik
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle text-nowrap">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>No HP</th>
                            <th class="text-center" style="width: 120px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($pemiliks) > 0): ?>
                            <?php foreach ($pemiliks as $index => $pemilik): ?>
                                <tr>
                                    <td><?= $index + 1 + ($currentPage - 1) * $perPage ?></td>
                                    <td class="fw-semibold"><?= esc($pemilik['nama_lengkap']) ?></td>
                                    <td><?= esc($pemilik['email']) ?></td>
                                    <td><?= esc($pemilik['username']) ?></td>
                                    <td><?= esc($pemilik['no_hp']) ?></td>
                                    <td class="text-center">
                                        <a href="<?= base_url('akun_pemilik_kapal/edit/' . $pemilik['id_pemilik']) ?>" class="btn btn-sm btn-outline-primary rounded-pill me-2" title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <a href="<?= base_url('akun_pemilik_kapal/hapus/' . $pemilik['id_pemilik']) ?>" class="btn btn-sm btn-outline-danger rounded-pill" onclick="return confirm('Yakin ingin menghapus akun ini?')" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted fst-italic py-4">Belum ada data pemilik kapal.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="mt-4 d-flex justify-content-end">
                <?= $pager->links('default') ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
