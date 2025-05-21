<?= $this->extend('admin/layout'); ?>
<?= $this->section('content'); ?>

<div class="col-12">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-primary">Kelola Akun Pemesan</h3>        
        <a href="<?= base_url('akun_pemesan/tambah') ?>" class="btn btn-primary rounded-pill">
            <i class="bi bi-plus-circle me-2"></i>Tambah Pemesan
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
                        <?php if (count($pesans) > 0): ?>
                            <?php foreach ($pesans as $index => $pemesan): ?>
                                <tr>
                                    <td><?= $index + 1 + ($currentPage - 1) * $perPage ?></td>
                                    <td class="fw-semibold"><?= esc($pemesan['nama_lengkap']) ?></td>
                                    <td><?= esc($pemesan['email']) ?></td>
                                    <td><?= esc($pemesan['username']) ?></td>
                                    <td><?= esc($pemesan['no_hp']) ?></td>
                                    <td class="text-center">
                                        <a href="<?= base_url('akun_pemesan/edit/' . $pemesan['id_pemesan']) ?>" class="btn btn-sm btn-outline-primary rounded-pill me-2" title="Edit Pemesan">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <a href="<?= base_url('akun_pemesan/hapus/' . $pemesan['id_pemesan']) ?>" class="btn btn-sm btn-outline-danger rounded-pill" onclick="return confirm('Yakin ingin menghapus akun ini?')" title="Hapus Pemesan">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted fst-italic py-4">Belum ada data pemesan.</td>
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
