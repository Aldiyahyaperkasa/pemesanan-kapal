<?= $this->extend('pemesan/layout'); ?>
<?= $this->section('content'); ?>

<div class="col-12">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-primary">Riwayat Pemesanan Saya</h3>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-4">

            <div class="table-responsive">
                <table class="table table-hover align-middle text-nowrap">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>Nama Kapal</th>
                            <th>Jumlah Penumpang</th>
                            <th>Total Harga</th>
                            <th>Berangkat</th>
                            <th>Kembali</th>
                            <th>Status Admin</th>
                            <th>Pembayaran</th>
                            <!-- <th class="text-center" style="width: 150px;">Aksi</th> -->
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (count($semua_pesanan) > 0): ?>
                            <?php foreach ($semua_pesanan as $index => $p): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td class="fw-semibold"><?= esc($p['nama_kapal'] ?? '-') ?></td>
                                    <td><?= esc($p['jumlah_penumpang']) ?></td>

                                    <td>Rp <?= number_format($p['total_harga'], 0, ',', '.') ?></td>

                                    <td><?= date('d-m-Y H:i', strtotime($p['tanggal_berangkat'])) ?></td>
                                    <td><?= date('d-m-Y H:i', strtotime($p['tanggal_kembali'])) ?></td>

                                    <!-- Status Admin -->
                                    <td>
                                        <?php if ($p['status_admin'] == 'menunggu'): ?>
                                            <span class="badge bg-warning text-dark">Menunggu</span>
                                        <?php elseif ($p['status_admin'] == 'ditolak'): ?>
                                            <span class="badge bg-danger">Ditolak</span>
                                        <?php else: ?>
                                            <span class="badge bg-success">Diterima</span>
                                        <?php endif; ?>
                                    </td>

                                    <!-- Pembayaran -->
                                    <td>
                                        <?php if (!empty($p['bukti_bayar'])): ?>
                                            <span class="badge bg-success">Sudah Bayar</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">Belum Bayar</span>
                                        <?php endif; ?>
                                    </td>

                            
                                    <!-- <td class="text-center">

                                        <a href="<?= base_url('pemesan/detail/' . $p['id_pemesanan']) ?>" 
                                           class="btn btn-sm btn-outline-primary rounded-pill me-1">
                                            <i class="bi bi-eye"></i> Detail
                                        </a>

                                        <?php if (empty($p['bukti_bayar'])): ?>
                                            <a href="<?= base_url('pemesan/upload_bukti/' . $p['id_pemesanan']) ?>" 
                                               class="btn btn-sm btn-outline-success rounded-pill me-1">
                                                <i class="bi bi-upload"></i> Upload
                                            </a>
                                        <?php endif; ?>

                                        <?php if ($p['status_admin'] == 'menunggu'): ?>
                                            <a href="<?= base_url('pemesan/hapus/' . $p['id_pemesanan']) ?>" 
                                               class="btn btn-sm btn-outline-danger rounded-pill"
                                               onclick="return confirm('Hapus pemesanan ini?')">
                                                <i class="bi bi-trash"></i> Hapus
                                            </a>
                                        <?php else: ?>
                                            <span class="text-muted fst-italic">Selesai</span>
                                        <?php endif; ?>

                                    </td> -->
                                </tr>
                            <?php endforeach; ?>

                        <?php else: ?>
                            <tr>
                                <td colspan="9" class="text-center text-muted fst-italic py-4">
                                    Anda belum memiliki riwayat pemesanan.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>

                </table>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>
