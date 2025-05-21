<!-- admin/kapal/kapal.php -->
<?= $this->extend('admin/layout'); ?>
<?= $this->section('content'); ?>

<div class="col-12">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-primary">Kelola Data Kapal</h3>
        <a href="<?= base_url('kapal/tambah') ?>" class="btn btn-primary rounded-pill">
            <i class="bi bi-plus-circle me-2"></i>Tambah Kapal
        </a>
    </div>

    <!-- Card Container -->
    <div class="card shadow-sm">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle text-nowrap">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>Nama Kapal</th>
                            <th>Pemilik Kapal</th>
                            <th>Jenis Kapal</th>
                            <th>Harga</th>
                            <th>Maks Penumpang</th>
                            <th>Foto Kapal</th>
                            <th>Deskripsi</th>
                            <th>Tersedia</th>
                            <th class="text-center" style="width: 120px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($kapal) > 0): ?>
                            <?php foreach ($kapal as $index => $k): ?>
                                <tr>
                                    <td><?= $index + 1 + ($currentPage - 1) * $perPage ?></td>
                                    <td class="fw-semibold"><?= esc($k['nama_kapal']) ?></td>
                                    <td><?= esc($k['nama_pemilik']) ?></td>
                                    <td><?= esc($k['jenis_kapal']) ?></td>
                                    <td>Rp <?= number_format($k['harga'], 2, ',', '.') ?></td>
                                    <td><?= esc($k['max_penumpang']) ?></td>
                                    <td>
                                        <?php if ($k['foto_kapal']): ?>
                                            <img src="<?= base_url('assets/gambar_kapal/' . $k['foto_kapal']) ?>" alt="Foto Kapal" width="100">
                                        <?php else: ?>
                                            -
                                        <?php endif; ?>
                                    </td>
                                    <td><?= esc($k['deskripsi']) ?></td>
                                    <td><?= $k['tersedia'] ? 'Ya' : 'Tidak' ?></td>
                                    <td class="text-center">
                                        <a href="<?= base_url('kapal/edit/' . $k['id_kapal']) ?>" class="btn btn-sm btn-outline-primary rounded-pill me-2" title="Edit Kapal">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <a href="<?= base_url('kapal/hapus/' . $k['id_kapal']) ?>" class="btn btn-sm btn-outline-danger rounded-pill" onclick="return confirm('Yakin ingin menghapus data kapal ini?')" title="Hapus Kapal">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="9" class="text-center text-muted fst-italic py-4">Belum ada data kapal.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4 d-flex justify-content-end">
                <?= $pager->links('default') ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
