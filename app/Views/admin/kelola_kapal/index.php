<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<style>
    .page-header {
        margin-bottom: 5px;
    }

    .breadcrumb-modern {
        font-size: 13px;
        color: #6b7280;
    }

    .card-modern {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    }

    .table-modern thead {
        background: #f8f9fc;
    }

    .table-modern thead th {
        font-weight: 600;
        font-size: 14px;
        color: #555;
        border-bottom: 1px solid #eee;
    }

    .table-modern tbody tr {
        transition: all 0.2s ease;
    }

    .table-modern tbody tr:hover {
        background: #f9fbff;
    }

    .badge-modern-success {
        background: #e6f7ee;
        color: #00a65a;
        font-weight: 600;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
    }

    .badge-modern-danger {
        background: #fde8e8;
        color: #d63031;
        font-weight: 600;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
    }

    .btn-modern-primary {
        background: linear-gradient(135deg,#3b82f6,#2563eb);
        border: none;
        border-radius: 10px;
        padding: 8px 16px;
        font-weight: 500;
    }

    .btn-modern-primary:hover {
        opacity: 0.9;
    }

    .btn-icon {
        border-radius: 8px;
        padding: 6px 10px;
    }

    .search-box {
        max-width: 280px;
        border-radius: 10px;
    }

    .kapal-thumb {
        width: 55px;
        height: 55px;
        object-fit: cover;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 12px rgba(0,0,0,0.06);
        transition: all .2s ease;
    }

    .kapal-thumb:hover {
        transform: scale(1.05);
    }

    .thumb-placeholder {
        width: 55px;
        height: 55px;
        border-radius: 12px;
        background: #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #94a3b8;
        font-size: 20px;
    }

</style>

<div class="page-header">
    <div class="breadcrumb-modern">
        Dashboard / Daftar Kapal
    </div>
</div>

<div class="card card-modern">
    <div class="card-body">

        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-1 fw-bold">Kelola Kapal</h4>
                <small class="text-muted">Manajemen data kapal dan ketersediaan</small>
            </div>

            <a href="<?= site_url('admin/kelola-kapal/create') ?>" 
               class="btn btn-modern-primary text-white">
                + Tambah Kapal
            </a>
        </div>

        <!-- SEARCH -->
        <div class="mb-3">
            <input type="text" id="searchInput" 
                   class="form-control search-box" 
                   placeholder="Cari nama kapal...">
        </div>

        <!-- TABLE -->
        <div class="table-responsive">
            <table class="table table-modern align-middle">
                <thead>
                    <tr>
                        <th width="50">#</th>
                        <th width="80">Foto</th>
                        <th>Nama Kapal</th>
                        <th>Pemilik</th>
                        <th>Jenis</th>
                        <th>Harga</th>
                        <th>Max</th>
                        <th>Status</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody id="kapalTable">

                    <?php if(empty($kapal)): ?>
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="ti ti-ship fs-1 d-block mb-2"></i>
                                    Belum ada data kapal
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>

                    <?php $no=1; foreach($kapal as $k): ?>
                    <tr>
                        <td class="text-muted"><?= $no++ ?></td>
                        <td>
                            <?php if(!empty($k['foto_kapal'])): ?>
                                <img src="<?= base_url('uploads/kapal/'.$k['foto_kapal']) ?>" 
                                    class="kapal-thumb">
                            <?php else: ?>
                                <div class="thumb-placeholder">
                                    <i class="ti ti-ship"></i>
                                </div>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="fw-semibold">
                                <?= esc($k['nama_kapal']) ?>
                            </div>
                        </td>

                        <td><?= esc($k['nama_lengkap']) ?></td>

                        <td>
                            <span class="badge bg-light text-dark">
                                <?= ucfirst($k['jenis_kapal']) ?>
                            </span>
                        </td>

                        <td class="fw-semibold text-primary">
                            Rp <?= number_format($k['harga'],0,',','.') ?>
                        </td>

                        <td><?= $k['max_penumpang'] ?> org</td>

                        <td>
                            <?= $k['tersedia'] ? 
                                '<span class="badge-modern-success">Tersedia</span>' :
                                '<span class="badge-modern-danger">Tidak Tersedia</span>' ?>
                        </td>

                        <td>
                            <div class="d-flex gap-2">
                                <a href="<?= site_url('admin/kelola-kapal/edit/'.$k['id_kapal']) ?>" 
                                   class="btn btn-warning btn-sm btn-icon">
                                    <i class="ti ti-edit"></i>
                                </a>

                                <a href="<?= site_url('admin/kelola-kapal/delete/'.$k['id_kapal']) ?>" 
                                   class="btn btn-danger btn-sm btn-icon"
                                   onclick="return confirm('Yakin hapus data ini?')">
                                    <i class="ti ti-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach ?>

                </tbody>
            </table>
        </div>

    </div>
</div>

<script>
document.getElementById("searchInput").addEventListener("keyup", function() {
    let value = this.value.toLowerCase();
    let rows = document.querySelectorAll("#kapalTable tr");

    rows.forEach(function(row) {
        row.style.display = row.innerText.toLowerCase().includes(value) 
            ? "" : "none";
    });
});
</script>

<?= $this->endSection() ?>
