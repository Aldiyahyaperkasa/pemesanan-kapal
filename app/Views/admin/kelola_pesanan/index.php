<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<style>

/* ================= MODERN ADMIN UI ================= */

.page-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:30px;
}

.page-title{
    font-size:24px;
    font-weight:700;
}

.page-subtitle{
    font-size:14px;
    color:#6c757d;
}

.filter-wrapper{
    background:#ffffff;
    padding:12px;
    border-radius:16px;
    box-shadow:0 5px 20px rgba(0,0,0,0.05);
}

.filter-wrapper .btn{
    border-radius:30px;
    font-size:13px;
    padding:6px 18px;
}

/* STAT CARD */

.stat-card{
    background:#ffffff;
    border-radius:18px;
    padding:22px;
    box-shadow:0 8px 25px rgba(0,0,0,0.05);
    transition:.3s;
    height:100%;
}

.stat-card:hover{
    transform:translateY(-5px);
}

.stat-number{
    font-size:26px;
    font-weight:700;
}

.stat-label{
    font-size:13px;
    color:#6c757d;
}

/* TABLE */

.modern-table{
    background:#ffffff;
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 10px 35px rgba(0,0,0,0.06);
}

.modern-table thead{
    background:#f8f9fc;
    font-size:12px;
    text-transform:uppercase;
    letter-spacing:.6px;
}

.modern-table th{
    padding:20px;
    border:none;
}

.modern-table td{
    padding:20px;
    border-top:1px solid #f1f3f7;
    vertical-align:middle;
}

.modern-table tbody tr:hover{
    background:#f9fbff;
}

/* STATUS BADGE */

.status-badge{
    padding:6px 14px;
    border-radius:50px;
    font-size:12px;
    font-weight:600;
}

.status-wait{
    background:#fff3cd;
    color:#856404;
}

.status-dp{
    background:#e2f0ff;
    color:#084298;
}

.status-success{
    background:#d4edda;
    color:#155724;
}

.status-reject{
    background:#f8d7da;
    color:#721c24;
}

/* ACTION BUTTON */

.btn-soft-success{
    background:#e6f7ef;
    color:#198754;
    border:none;
    border-radius:30px;
    padding:6px 16px;
    font-size:13px;
}

.btn-soft-danger{
    background:#fde8e8;
    color:#dc3545;
    border:none;
    border-radius:30px;
    padding:6px 16px;
    font-size:13px;
}

.btn-soft-primary{
    background:#e7f1ff;
    color:#0d6efd;
    border:none;
    border-radius:30px;
    padding:6px 16px;
    font-size:13px;
}

.reason-box{
    background:#fff5f5;
    border-left:4px solid #dc3545;
    padding:10px 12px;
    border-radius:8px;
    font-size:12px;
    margin-top:8px;
}

</style>


<div class="container-fluid">

    <!-- HEADER -->
    <div class="page-header">
        <div>
            <div class="page-title">Kelola Pemesanan</div>
            <div class="page-subtitle">
                Monitoring dan verifikasi pesanan pelanggan
            </div>
        </div>
    </div>


    <!-- FILTER -->
    <div class="filter-wrapper mb-4">
        <div class="d-flex flex-wrap gap-2">

            <?php
            $filters = [
                'baru'=>'Pesanan Baru',
                'menunggu_dp'=>'Menunggu DP',
                'verifikasi_dp'=>'Verifikasi DP',
                'selesai'=>'Terverifikasi',
                'dp_ditolak'=>'DP Ditolak',
                'ditolak'=>'Ditolak'
            ];
            ?>

            <?php foreach($filters as $key=>$label): ?>
                <a href="<?= site_url('admin/kelola-pesanan?filter='.$key) ?>"
                   class="btn <?= $current_filter==$key ? 'btn-primary' : 'btn-outline-secondary' ?>">
                    <?= $label ?>
                </a>
            <?php endforeach; ?>

        </div>
    </div>


    <!-- STAT CARDS -->
    <?php
    $total = count($pemesanan);
    $menunggu = count(array_filter($pemesanan, fn($p)=>$p['status_booking']=='menunggu_konfirmasi'));
    $ditolak = count(array_filter($pemesanan, fn($p)=>$p['status_booking']=='ditolak'));
    $dp = count(array_filter($pemesanan, fn($p)=>$p['status_booking']=='menunggu_dp'));
    ?>

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-number"><?= $total ?></div>
                <div class="stat-label">Total Pemesanan</div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-number text-warning"><?= $menunggu ?></div>
                <div class="stat-label">Menunggu Konfirmasi</div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-number text-info"><?= $dp ?></div>
                <div class="stat-label">Menunggu DP</div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-number text-danger"><?= $ditolak ?></div>
                <div class="stat-label">Ditolak</div>
            </div>
        </div>
    </div>


    <!-- TABLE -->
    <div class="modern-table">
        <div class="table-responsive">
            <table class="table mb-0">

                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Pemesan</th>
                        <th>Kapal</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                <?php foreach ($pemesanan as $p): ?>

                    <?php
                    $status = $p['status_booking'];

                    if($status == 'menunggu_konfirmasi')
                        $badge = 'status-wait';
                    elseif($status == 'menunggu_dp')
                        $badge = 'status-dp';
                    elseif($status == 'ditolak')
                        $badge = 'status-reject';
                    else
                        $badge = 'status-success';
                    ?>

                    <tr>

                        <td class="fw-semibold text-primary">
                            <?= $p['kode_booking'] ?>
                        </td>

                        <td>
                            <div class="fw-semibold"><?= $p['nama_pemesan'] ?></div>
                            <small class="text-muted"><?= $p['no_hp'] ?></small>
                        </td>

                        <td><?= $p['nama_kapal'] ?></td>

                        <td>
                            <?= date('d M Y', strtotime($p['tanggal_berangkat'])) ?>
                            <br>
                            <small class="text-muted">
                                s/d <?= date('d M Y', strtotime($p['tanggal_kembali'])) ?>
                            </small>
                        </td>

                        <td class="fw-semibold">
                            Rp <?= number_format($p['total_harga'],0,',','.') ?>
                        </td>

                        <td>
                            <span class="status-badge <?= $badge ?>">
                                <?= ucwords(str_replace('_',' ',$status)) ?>
                            </span>

                            <!-- ditolak DP nya -->
                            <?php if($current_filter=='dp_ditolak' && !empty($p['alasan_penolakan_dp'])): ?>
                                <div class="reason-box">
                                    <?= esc($p['alasan_penolakan_dp']) ?>
                                </div>
                            <?php endif; ?>

                            <!-- ditolak pesanannya -->
                            <?php if($status=='ditolak' && !empty($p['alasan_penolakan'])): ?>
                                <div class="reason-box">
                                    <strong>Alasan Penolakan Pesanan:</strong><br>
                                    <?= esc($p['alasan_penolakan']) ?>
                                </div>
                            <?php endif; ?>
                        </td>

                        <td class="text-center">

                            <?php if($status == 'menunggu_konfirmasi'): ?>

                                <a href="<?= site_url('admin/kelola-pesanan/setujui/'.$p['id_pemesanan']) ?>"
                                   class="btn-soft-success me-1">
                                    Setujui
                                </a>

                                <button class="btn-soft-danger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalTolak<?= $p['id_pemesanan'] ?>">
                                    Tolak
                                </button>

                                <!-- MODAL TOLAK PEMESANAN -->
                                <div class="modal fade" id="modalTolak<?= $p['id_pemesanan'] ?>" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <form action="<?= site_url('admin/kelola-pesanan/tolak/'.$p['id_pemesanan']) ?>" method="post">

                                                <div class="modal-header">
                                                    <h5 class="modal-title">Tolak Pemesanan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <label class="form-label fw-semibold">Alasan Penolakan</label>
                                                    <textarea name="alasan_penolakan"
                                                            class="form-control"
                                                            rows="4"
                                                            required
                                                            placeholder="Masukkan alasan penolakan..."></textarea>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                                                        Batal
                                                    </button>
                                                    <button type="submit" class="btn btn-danger">
                                                        Kirim Penolakan
                                                    </button>
                                                </div>

                                            </form>

                                        </div>
                                    </div>
                                </div>                                

                            <?php elseif($status == 'dp_dibayar'): ?>

                                <a href="<?= base_url('uploads/bukti_dp/'.$p['bukti_bayar']) ?>"
                                   target="_blank"
                                   class="btn-soft-primary me-1">
                                    Bukti
                                </a>

                                <a href="<?= site_url('admin/kelola-pesanan/dp-valid/'.$p['id_pemesanan']) ?>"
                                   class="btn-soft-success me-1">
                                    Valid
                                </a>

                                <button class="btn-soft-danger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalTolakDP<?= $p['id_pemesanan'] ?>">
                                    Tolak
                                </button>

                                <!-- MODAL TOLAK DP -->
                                <div class="modal fade" id="modalTolakDP<?= $p['id_pemesanan'] ?>" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <form action="<?= site_url('admin/kelola-pesanan/dp-tolak/'.$p['id_pemesanan']) ?>" method="post">

                                                <div class="modal-header">
                                                    <h5 class="modal-title">Tolak Pembayaran DP</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <label class="form-label fw-semibold">Alasan Penolakan DP</label>
                                                    <textarea name="alasan_penolakan_dp"
                                                            class="form-control"
                                                            rows="4"
                                                            required
                                                            placeholder="Contoh: Bukti transfer tidak jelas / tidak sesuai nominal"></textarea>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                                                        Batal
                                                    </button>
                                                    <button type="submit" class="btn btn-danger">
                                                        Kirim Penolakan
                                                    </button>
                                                </div>

                                            </form>

                                        </div>
                                    </div>
                                </div>      

                            <?php else: ?>
                                <small class="text-muted">—</small>
                            <?php endif; ?>

                        </td>

                    </tr>

                <?php endforeach; ?>

                </tbody>

            </table>
        </div>
    </div>

</div>

<?= $this->endSection() ?>
