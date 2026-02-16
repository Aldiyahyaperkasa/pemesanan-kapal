<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<style>
.page-wrapper{
    padding:40px;
}

.section-card{
    background:#ffffff;
    border-radius:28px;
    padding:40px;
    box-shadow:0 25px 60px rgba(0,0,0,0.06);
}

.report-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:35px;
}

.report-title{
    font-size:22px;
    font-weight:700;
}

.report-subtitle{
    font-size:13px;
    color:#6b7280;
}

.btn-export{
    background:#111827;
    color:white;
    border-radius:999px;
    padding:10px 24px;
    font-size:14px;
    border:none;
    text-decoration:none;
}

.kpi-card{
    border-radius:20px;
    padding:28px;
    background:#f8fafc;
}

.kpi-label{
    font-size:12px;
    color:#6b7280;
    letter-spacing:.6px;
}

.kpi-value{
    font-size:24px;
    font-weight:700;
    margin-top:10px;
}

.table-modern th{
    font-size:12px;
    letter-spacing:.5px;
    color:#6b7280;
    border-bottom:1px solid #e5e7eb;
}

.table-modern td{
    vertical-align:middle;
    border-bottom:1px solid #f1f5f9;
}

.badge-status{
    padding:6px 14px;
    border-radius:999px;
    font-size:11px;
    font-weight:600;
}
.badge-lunas{ background:#dcfce7; color:#166534; }
.badge-dp{ background:#fef9c3; color:#92400e; }
.badge-batal{ background:#fee2e2; color:#991b1b; }
</style>

<div class="page-wrapper">

    <div class="section-card">

        <!-- HEADER -->
        <div class="report-header">
            <div>
                <div class="report-title">Audit Keuangan & Pendapatan</div>
                <div class="report-subtitle">
                    Analisis komprehensif pemesanan, pembayaran DP, pelunasan dan sisa piutang
                </div>
            </div>

            <a href="<?= base_url('admin/laporan/financial/export') ?>" 
               class="btn-export">
               Export Excel
            </a>
        </div>

        <!-- KPI SUMMARY -->
        <?php 
            $totalPendapatan = 0;
            $totalDP = 0;
            $totalPelunasan = 0;
            $totalOutstanding = 0;

            foreach($rows as $r){
                $totalPendapatan += $r->total_harga;
                $totalDP += $r->total_dp;
                $totalPelunasan += $r->total_pelunasan;
                $totalOutstanding += ($r->total_harga - ($r->total_dp + $r->total_pelunasan));
            }
        ?>

        <div class="row g-4 mb-5">

            <div class="col-lg-3">
                <div class="kpi-card">
                    <div class="kpi-label">TOTAL PENDAPATAN</div>
                    <div class="kpi-value text-success">
                        Rp <?= number_format($totalPendapatan) ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="kpi-card">
                    <div class="kpi-label">TOTAL DP DITERIMA</div>
                    <div class="kpi-value">
                        Rp <?= number_format($totalDP) ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="kpi-card">
                    <div class="kpi-label">TOTAL PELUNASAN</div>
                    <div class="kpi-value">
                        Rp <?= number_format($totalPelunasan) ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="kpi-card">
                    <div class="kpi-label">TOTAL SISA PIUTANG</div>
                    <div class="kpi-value text-danger">
                        Rp <?= number_format($totalOutstanding) ?>
                    </div>
                </div>
            </div>

        </div>

        <!-- TABLE -->
        <div class="table-responsive">
            <table class="table table-modern">
                <thead>
                    <tr>
                        <th>Kode Booking</th>
                        <th>Pemesan</th>
                        <th>Kapal</th>
                        <th>Total Harga</th>
                        <th>DP</th>
                        <th>Pelunasan</th>
                        <th>Sisa</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($rows as $r): 
                        $sisa = $r->total_harga - ($r->total_dp + $r->total_pelunasan);

                        if($r->status_booking == 'lunas'){
                            $badge = 'badge-lunas';
                        } elseif($r->status_booking == 'dp'){
                            $badge = 'badge-dp';
                        } else {
                            $badge = 'badge-batal';
                        }
                    ?>
                    <tr>
                        <td><?= $r->kode_booking ?></td>
                        <td><?= $r->nama_pemesan ?></td>
                        <td><?= $r->nama_kapal ?></td>
                        <td>Rp <?= number_format($r->total_harga) ?></td>
                        <td>Rp <?= number_format($r->total_dp) ?></td>
                        <td>Rp <?= number_format($r->total_pelunasan) ?></td>
                        <td>
                            <strong class="text-danger">
                                Rp <?= number_format($sisa) ?>
                            </strong>
                        </td>
                        <td>
                            <span class="badge-status <?= $badge ?>">
                                <?= strtoupper($r->status_booking) ?>
                            </span>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>

    </div>

</div>

<?= $this->endSection() ?>
