<?= $this->extend('admin/layout'); ?>
<?= $this->section('content'); ?>

<div class="col-12">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-primary">Kelola Pemesanan</h3>
    </div>

    <!-- Dropdown Pilih Kapal -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="get" action="<?= base_url('kelola-pesanan/index') ?>" class="row g-3 align-items-center">
                <div class="col-auto">
                    <label for="kapal" class="col-form-label fw-semibold">Pilih Kapal:</label>
                </div>
                <div class="col-auto">
                    <select name="kapal" id="kapal" class="form-select" onchange="this.form.submit()">
                        <option value="">-- Pilih Kapal --</option>
                        <?php foreach ($kapalList as $kapal): ?>
                            <option value="<?= $kapal['id_kapal'] ?>" <?= ($kapal['id_kapal'] == $selectedKapal) ? 'selected' : '' ?>>
                                <?= esc($kapal['nama_kapal']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel Pemesanan -->
    <div class="card shadow-sm">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle text-nowrap">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Kapal</th>
                            <th>Jumlah Penumpang</th>
                            <th>Total Bayar</th>
                            <th>Tgl Berangkat</th>
                            <th>Tgl Kembali</th>
                            <th>Status Pemilik</th>
                            <th>Status Admin</th>
                            <th>Bukti Bayar</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($pemesananList)): ?>
                            <?php foreach ($pemesananList as $index => $p): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td><?= esc($p['nama_kapal'] ?? '-') ?></td>
                                    <td><?= esc($p['jumlah_penumpang']) ?> org</td>
                                    <td>Rp <?= number_format($p['total_harga'], 0, ',', '.') ?></td>
                                    <td><?= date('d M Y H:i', strtotime($p['tanggal_berangkat'])) ?></td>
                                    <td><?= date('d M Y H:i', strtotime($p['tanggal_kembali'])) ?></td>
                                    <td>
                                        <span class="badge bg-info text-dark"><?= ucfirst($p['status_pemilik']) ?></span>
                                    </td>
                                    <td>
                                        <?php if ($p['status_admin'] === 'menunggu'): ?>
                                            <span class="badge bg-warning text-dark">Menunggu</span>
                                        <?php elseif ($p['status_admin'] === 'terverifikasi'): ?>
                                            <span class="badge bg-success">Terverifikasi</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Ditolak</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($p['bukti_bayar']): ?>
                                            <a href="<?= base_url('uploads/bukti_bayar/' . $p['bukti_bayar']) ?>" target="_blank">
                                                <img src="<?= base_url('uploads/bukti_bayar/' . $p['bukti_bayar']) ?>" width="80" class="img-thumbnail">
                                            </a>
                                        <?php else: ?>
                                            <span class="text-muted fst-italic">Belum upload</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($p['bukti_bayar']): ?>
                                            <a href="<?= base_url('kelola-pesanan/update-status/' . $p['id_pemesanan'] . '/terverifikasi') ?>" class="btn btn-sm btn-outline-success rounded-pill me-2" title="Terima">
                                                <i class="bi bi-check-circle"></i>
                                            </a>
                                            <a href="<?= base_url('kelola-pesanan/update-status/' . $p['id_pemesanan'] . '/ditolak') ?>" class="btn btn-sm btn-outline-danger rounded-pill" title="Tolak" onclick="return confirm('Yakin ingin menolak pemesanan ini?')">
                                                <i class="bi bi-x-circle"></i>
                                            </a>
                                        <?php else: ?>
                                            <span class="text-muted fst-italic">Menunggu bukti bayar</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="10" class="text-center text-muted fst-italic py-4">Tidak ada data pemesanan untuk kapal ini.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
