<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<style>
.page-wrapper{
    padding:40px;
}

/* CARD UTAMA */
.report-card{
    background:#ffffff;
    border-radius:28px;
    padding:40px;
    box-shadow:0 30px 70px rgba(0,0,0,0.06);
}

/* HEADER */
.report-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:40px;
}

.report-title{
    font-size:22px;
    font-weight:700;
}

.report-subtitle{
    font-size:13px;
    color:#6b7280;
    margin-top:4px;
}

/* BUTTON */
.btn-export{
    background:#111827;
    color:white;
    border-radius:999px;
    padding:10px 24px;
    font-size:14px;
    border:none;
    text-decoration:none;
    transition:.2s;
}
.btn-export:hover{
    opacity:.85;
}

/* KPI */
.kpi-box{
    background:linear-gradient(135deg,#f8fafc,#eef2ff);
    border-radius:22px;
    padding:28px;
    height:100%;
}

.kpi-label{
    font-size:12px;
    color:#6b7280;
    letter-spacing:.6px;
}

.kpi-number{
    font-size:26px;
    font-weight:700;
    margin-top:8px;
}

.kpi-cash{
    color:#059669;
}

/* DIVIDER */
.section-divider{
    height:1px;
    background:#e5e7eb;
    margin:35px 0;
}

/* TABLE */
.table-premium thead{
    background:#f9fafb;
    font-size:12px;
    text-transform:uppercase;
    letter-spacing:.6px;
}

.table-premium tbody tr{
    transition:.2s;
}

.table-premium tbody tr:hover{
    background:#f3f4f6;
}

.money{
    font-weight:600;
    color:#059669;
}
</style>


<div class="page-wrapper">

    <div class="report-card">

        <!-- HEADER -->
        <div class="report-header">
            <div>
                <div class="report-title">Laporan Arus Kas Masuk</div>
                <div class="report-subtitle">
                    Monitoring transaksi pembayaran terverifikasi serta visibilitas likuiditas harian
                </div>
            </div>

            <a href="<?= base_url('admin/laporan/cashflow/export') ?>" 
               class="btn-export">
               Export Excel
            </a>
        </div>

        <!-- HITUNG KPI -->
        <?php
        $totalKasMasuk = 0;
        $totalTransaksi = 0;

        foreach($rows as $r){
            $totalKasMasuk += $r->total_cash_in;
            $totalTransaksi += $r->total_transaksi;
        }
        ?>

        <!-- KPI SECTION -->
        <div class="row g-4 mb-4">

            <div class="col-md-6">
                <div class="kpi-box">
                    <div class="kpi-label">TOTAL KAS MASUK</div>
                    <div class="kpi-number kpi-cash">
                        Rp <?= number_format($totalKasMasuk) ?>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="kpi-box">
                    <div class="kpi-label">TOTAL TRANSAKSI TERVERIFIKASI</div>
                    <div class="kpi-number">
                        <?= number_format($totalTransaksi) ?>
                    </div>
                </div>
            </div>

        </div>

        <div class="section-divider"></div>

        <!-- TABEL -->
        <div class="table-responsive">
            <table class="table table-premium align-middle">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Jumlah Transaksi</th>
                        <th>Total Kas Masuk</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($rows as $r): ?>
                    <tr>
                        <td>
                            <?= date('d F Y', strtotime($r->tanggal)) ?>
                        </td>
                        <td>
                            <?= number_format($r->total_transaksi) ?>
                        </td>
                        <td class="money">
                            Rp <?= number_format($r->total_cash_in) ?>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>

    </div>

</div>

<?= $this->endSection() ?>
