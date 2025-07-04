<?= $this->extend('pemilik_kapal/layout'); ?>
<?= $this->section('content'); ?>

<div class="col-12">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-primary">Kelola Pemesanan Kapal</h3>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle text-nowrap">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>Nama Pemesan</th>
                            <th>Nama Kapal</th>
                            <th>Jumlah Penumpang</th>
                            <th>Total Harga</th>
                            <th>Berangkat</th>
                            <th>Kembali</th>
                            <th>Status</th>
                            <th class="text-center" style="width: 180px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($pemesanan) > 0): ?>
                            <?php foreach ($pemesanan as $index => $p): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td class="fw-semibold"><?= esc($p['nama_lengkap']) ?></td>
                                    <td><?= esc($p['nama_kapal']) ?></td>
                                    <td><?= esc($p['jumlah_penumpang']) ?></td>
                                    <td>Rp <?= number_format($p['total_harga'], 0, ',', '.') ?></td>
                                    <td><?= date('d-m-Y H:i', strtotime($p['tanggal_berangkat'])) ?></td>
                                    <td><?= date('d-m-Y H:i', strtotime($p['tanggal_kembali'])) ?></td>
                                    <td>
                                        <?php if ($p['status_pemilik'] == 'menunggu'): ?>
                                            <span class="badge bg-warning text-dark">Menunggu</span>
                                        <?php elseif ($p['status_pemilik'] == 'diterima'): ?>
                                            <span class="badge bg-success">Diterima</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Ditolak</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($p['status_pemilik'] == 'menunggu'): ?>
                                            <form action="<?= base_url('pemilik_kapal/update_status/' . $p['id_pemesanan']) ?>" method="post" class="d-inline">
                                                <?= csrf_field() ?>
                                                <button name="status_pemilik" value="diterima" class="btn btn-sm btn-outline-success rounded-pill me-1" onclick="return confirm('Terima pemesanan ini?')">
                                                    <i class="bi bi-check-circle"></i> Terima
                                                </button>
                                            </form>
                                            <form action="<?= base_url('pemilik_kapal/update_status/' . $p['id_pemesanan']) ?>" method="post" class="d-inline">
                                                <?= csrf_field() ?>
                                                <button name="status_pemilik" value="ditolak" class="btn btn-sm btn-outline-danger rounded-pill" onclick="return confirm('Tolak pemesanan ini?')">
                                                    <i class="bi bi-x-circle"></i> Tolak
                                                </button>
                                            </form>
                                        <?php else: ?>
                                            <span class="text-muted fst-italic">Tidak ada aksi</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="9" class="text-center text-muted fst-italic py-4">Belum ada pemesanan untuk kapal Anda.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
