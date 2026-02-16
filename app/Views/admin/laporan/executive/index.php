<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<style>
.page-wrapper{ padding:40px; }

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
}

.kpi-card{
    border-radius:20px;
    padding:30px;
    background:#f8fafc;
}

.kpi-label{
    font-size:12px;
    color:#6b7280;
    letter-spacing:.6px;
}

.kpi-value{
    font-size:26px;
    font-weight:700;
    margin-top:10px;
}
</style>

<div class="page-wrapper">

    <div class="section-card">

        <div class="report-header">
            <div>
                <div class="report-title">Ringkasan Eksekutif</div>
                <div class="report-subtitle">
                    Gambaran kinerja strategis untuk manajemen & investor
                </div>
            </div>

            <a href="<?= base_url('admin/laporan/executive/export') ?>" 
               class="btn-export">
               Export Excel
            </a>
        </div>

        <div class="row g-4">

            <div class="col-lg-3">
                <div class="kpi-card">
                    <div class="kpi-label">TOTAL PEMESANAN</div>
                    <div class="kpi-value">
                        <?= number_format($kpi->total_booking) ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="kpi-card">
                    <div class="kpi-label">TOTAL PENUMPANG</div>
                    <div class="kpi-value">
                        <?= number_format($kpi->total_penumpang) ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="kpi-card">
                    <div class="kpi-label">TOTAL PENDAPATAN</div>
                    <div class="kpi-value text-success">
                        Rp <?= number_format($kpi->total_revenue) ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="kpi-card">
                    <div class="kpi-label">PENDAPATAN SELESAI</div>
                    <div class="kpi-value text-primary">
                        Rp <?= number_format($kpi->revenue_completed) ?>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>
