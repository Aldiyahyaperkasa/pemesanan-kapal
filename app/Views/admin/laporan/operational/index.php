<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<style>
.page-wrapper{
    padding:40px;
}

.report-card{
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
    margin-top:4px;
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

.kpi-box{
    background:#f8fafc;
    border-radius:20px;
    padding:25px;
    height:100%;
}

.kpi-label{
    font-size:12px;
    color:#6b7280;
    letter-spacing:.6px;
}

.kpi-number{
    font-size:24px;
    font-weight:700;
    margin-top:8px;
}

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

.section-divider{
    height:1px;
    background:#e5e7eb;
    margin:30px 0;
}
</style>


<div class="page-wrapper">

    <div class="report-card">

        <!-- HEADER -->
        <div class="report-header">
            <div>
                <div class="report-title">Kinerja Operasional Armada</div>
                <div class="report-subtitle">
                    Analisis produktivitas kapal berdasarkan jumlah perjalanan,
                    volume penumpang, dan kontribusi pendapatan
                </div>
            </div>

            <a href="<?= base_url('admin/laporan/operational/export') ?>" 
               class="btn-export">
               Export Excel
            </a>
        </div>

        <!-- HITUNG KPI -->
        <?php
        $totalTrips = 0;
        $totalPassengers = 0;
        $totalRevenue = 0;

        foreach($rows as $r){
            $totalTrips += $r->total_trip;
            $totalPassengers += $r->total_penumpang;
            $totalRevenue += $r->total_revenue;
        }
        ?>

        <!-- KPI SUMMARY -->
        <div class="row g-4 mb-4">

            <div class="col-md-4">
                <div class="kpi-box">
                    <div class="kpi-label">TOTAL PERJALANAN</div>
                    <div class="kpi-number"><?= number_format($totalTrips) ?></div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="kpi-box">
                    <div class="kpi-label">TOTAL PENUMPANG</div>
                    <div class="kpi-number"><?= number_format($totalPassengers) ?></div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="kpi-box">
                    <div class="kpi-label">TOTAL PENDAPATAN OPERASIONAL</div>
                    <div class="kpi-number money">
                        Rp <?= number_format($totalRevenue) ?>
                    </div>
                </div>
            </div>

        </div>

        <div class="section-divider"></div>

        <!-- TABEL OPERASIONAL -->
        <div class="table-responsive">
            <table class="table table-premium align-middle">
                <thead>
                    <tr>
                        <th>Nama Kapal</th>
                        <th>Pemilik</th>
                        <th>Jumlah Perjalanan</th>
                        <th>Jumlah Penumpang</th>
                        <th>Total Pendapatan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($rows as $r): ?>
                    <tr>
                        <td class="fw-semibold"><?= $r->nama_kapal ?></td>
                        <td><?= $r->pemilik ?></td>
                        <td><?= number_format($r->total_trip) ?></td>
                        <td><?= number_format($r->total_penumpang) ?></td>
                        <td class="money">
                            Rp <?= number_format($r->total_revenue) ?>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>

    </div>

</div>

<?= $this->endSection() ?>
