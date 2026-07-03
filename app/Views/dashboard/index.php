<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<!-- Page Header -->
<div class="page-header">
    <h4><i class="bi bi-speedometer2 me-2" style="color:#4f46e5;"></i>Dashboard</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item active">Home</li>
        </ol>
    </nav>
</div>

<!-- Stat Cards -->
<div class="row g-4 mb-4">
    <!-- Jumlah Layanan -->
    <div class="col-12 col-md-4">
        <div class="stat-card primary">
            <div class="stat-icon primary">
                <i class="bi bi-clipboard-check"></i>
            </div>
            <div class="stat-value"><?= $jumlah_layanan ?></div>
            <div class="stat-label">Total Layanan Aktif</div>
            <a href="/layanan" class="stretched-link"></a>
        </div>
    </div>

    <!-- Jumlah Pelanggan -->
    <div class="col-12 col-md-4">
        <div class="stat-card success">
            <div class="stat-icon success">
                <i class="bi bi-people"></i>
            </div>
            <div class="stat-value"><?= $jumlah_pelanggan ?></div>
            <div class="stat-label">Total Pelanggan Terdaftar</div>
            <a href="/pelanggan" class="stretched-link"></a>
        </div>
    </div>

    <!-- Jumlah Keranjang -->
    <div class="col-12 col-md-4">
        <div class="stat-card warning">
            <div class="stat-icon warning">
                <i class="bi bi-cart3"></i>
            </div>
            <div class="stat-value"><?= $jumlah_cart ?></div>
            <div class="stat-label">Item dalam Keranjang</div>
            <a href="/cart" class="stretched-link"></a>
        </div>
    </div>
</div>

<!-- Quick Actions & Info -->
<div class="row g-4">
    <!-- Quick Actions -->
    <div class="col-12 col-lg-6">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center gap-2">
                <i class="bi bi-lightning-charge" style="color:#f59e0b;"></i>
                <span class="fw-600" style="font-weight:600;">Aksi Cepat</span>
            </div>
            <div class="card-body">
                <div class="d-flex flex-column gap-2">
                    <a href="/layanan/create" class="btn d-flex align-items-center gap-3 py-3 px-4"
                       style="background:rgba(79,70,229,0.1); border:1px solid rgba(79,70,229,0.2); color:#e2e8f0; border-radius:10px; transition:all .2s;">
                        <span style="width:36px;height:36px;background:rgba(79,70,229,0.2);border-radius:8px;display:flex;align-items:center;justify-content:center;">
                            <i class="bi bi-plus-circle" style="color:#818cf8;"></i>
                        </span>
                        <div class="text-start">
                            <div style="font-weight:600; font-size:0.85rem;">Tambah Layanan</div>
                            <div style="font-size:0.75rem; color:#64748b;">Daftarkan layanan laundry baru</div>
                        </div>
                        <i class="bi bi-chevron-right ms-auto" style="color:#475569;"></i>
                    </a>

                    <a href="/pelanggan/create" class="btn d-flex align-items-center gap-3 py-3 px-4"
                       style="background:rgba(16,185,129,0.08); border:1px solid rgba(16,185,129,0.2); color:#e2e8f0; border-radius:10px; transition:all .2s;">
                        <span style="width:36px;height:36px;background:rgba(16,185,129,0.15);border-radius:8px;display:flex;align-items:center;justify-content:center;">
                            <i class="bi bi-person-plus" style="color:#34d399;"></i>
                        </span>
                        <div class="text-start">
                            <div style="font-weight:600; font-size:0.85rem;">Tambah Pelanggan</div>
                            <div style="font-size:0.75rem; color:#64748b;">Daftarkan pelanggan baru</div>
                        </div>
                        <i class="bi bi-chevron-right ms-auto" style="color:#475569;"></i>
                    </a>

                    <a href="/cart" class="btn d-flex align-items-center gap-3 py-3 px-4"
                       style="background:rgba(245,158,11,0.08); border:1px solid rgba(245,158,11,0.2); color:#e2e8f0; border-radius:10px; transition:all .2s;">
                        <span style="width:36px;height:36px;background:rgba(245,158,11,0.15);border-radius:8px;display:flex;align-items:center;justify-content:center;">
                            <i class="bi bi-cart3" style="color:#fcd34d;"></i>
                        </span>
                        <div class="text-start">
                            <div style="font-weight:600; font-size:0.85rem;">Lihat Keranjang</div>
                            <div style="font-size:0.75rem; color:#64748b;">Kelola transaksi laundry</div>
                        </div>
                        <i class="bi bi-chevron-right ms-auto" style="color:#475569;"></i>
                    </a>

                    <a href="/layanan/export-pdf" target="_blank" class="btn d-flex align-items-center gap-3 py-3 px-4"
                       style="background:rgba(239,68,68,0.08); border:1px solid rgba(239,68,68,0.2); color:#e2e8f0; border-radius:10px; transition:all .2s;">
                        <span style="width:36px;height:36px;background:rgba(239,68,68,0.15);border-radius:8px;display:flex;align-items:center;justify-content:center;">
                            <i class="bi bi-file-earmark-pdf" style="color:#fca5a5;"></i>
                        </span>
                        <div class="text-start">
                            <div style="font-weight:600; font-size:0.85rem;">Export PDF Layanan</div>
                            <div style="font-size:0.75rem; color:#64748b;">Cetak daftar layanan laundry</div>
                        </div>
                        <i class="bi bi-chevron-right ms-auto" style="color:#475569;"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- System Info -->
    <div class="col-12 col-lg-6">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center gap-2">
                <i class="bi bi-info-circle" style="color:#06b6d4;"></i>
                <span class="fw-600" style="font-weight:600;">Informasi Sistem</span>
            </div>
            <div class="card-body">
                <div class="d-flex flex-column gap-3">
                    <div class="d-flex justify-content-between align-items-center py-2 px-3"
                         style="background:rgba(15,23,42,0.5); border-radius:8px; border:1px solid rgba(255,255,255,0.05);">
                        <span style="color:#64748b; font-size:0.85rem;">Aplikasi</span>
                        <span style="color:#e2e8f0; font-weight:600; font-size:0.85rem;">Laundry Management System</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center py-2 px-3"
                         style="background:rgba(15,23,42,0.5); border-radius:8px; border:1px solid rgba(255,255,255,0.05);">
                        <span style="color:#64748b; font-size:0.85rem;">Framework</span>
                        <span style="color:#e2e8f0; font-weight:600; font-size:0.85rem;">CodeIgniter 4</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center py-2 px-3"
                         style="background:rgba(15,23,42,0.5); border-radius:8px; border:1px solid rgba(255,255,255,0.05);">
                        <span style="color:#64748b; font-size:0.85rem;">UI Framework</span>
                        <span style="color:#e2e8f0; font-weight:600; font-size:0.85rem;">Bootstrap 5</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center py-2 px-3"
                         style="background:rgba(15,23,42,0.5); border-radius:8px; border:1px solid rgba(255,255,255,0.05);">
                        <span style="color:#64748b; font-size:0.85rem;">PDF Generator</span>
                        <span style="color:#e2e8f0; font-weight:600; font-size:0.85rem;">DomPDF</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center py-2 px-3"
                         style="background:rgba(15,23,42,0.5); border-radius:8px; border:1px solid rgba(255,255,255,0.05);">
                        <span style="color:#64748b; font-size:0.85rem;">Login sebagai</span>
                        <span style="color:#818cf8; font-weight:600; font-size:0.85rem;">
                            <i class="bi bi-person-circle me-1"></i>
                            <?= esc(session('user_nama')) ?>
                        </span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center py-2 px-3"
                         style="background:rgba(15,23,42,0.5); border-radius:8px; border:1px solid rgba(255,255,255,0.05);">
                        <span style="color:#64748b; font-size:0.85rem;">Tanggal & Waktu</span>
                        <span style="color:#e2e8f0; font-weight:600; font-size:0.85rem;" id="datetime"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Live clock
    function updateTime() {
        const now = new Date();
        document.getElementById('datetime').textContent = now.toLocaleString('id-ID', {
            dateStyle: 'medium',
            timeStyle: 'short'
        });
    }
    updateTime();
    setInterval(updateTime, 1000);
</script>
<?= $this->endSection() ?>
