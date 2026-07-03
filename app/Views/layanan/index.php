<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-2">
    <div>
        <h4><i class="bi bi-clipboard-check me-2" style="color:#4f46e5;"></i>Data Layanan</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="/dashboard" style="color:#64748b;">Dashboard</a></li>
                <li class="breadcrumb-item active">Data Layanan</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex gap-2 flex-wrap">
        <a href="/layanan/trash" class="btn btn-sm" style="background:rgba(239,68,68,0.15); border:1px solid rgba(239,68,68,0.3); color:#fca5a5;">
            <i class="bi bi-trash3 me-1"></i> Tong Sampah
        </a>
        <a href="/layanan/export-pdf" target="_blank" class="btn btn-sm" style="background:rgba(239,68,68,0.8); border:none; color:white;">
            <i class="bi bi-file-earmark-pdf me-1"></i> Export PDF
        </a>
        <a href="/layanan/create" class="btn btn-sm btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Tambah Layanan
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between gap-2 flex-wrap">
        <span style="font-weight:600; font-size:0.9rem;">
            <i class="bi bi-table me-1" style="color:#4f46e5;"></i> Daftar Layanan
        </span>
        <!-- Search Form -->
        <form method="get" action="/layanan" class="d-flex gap-2">
            <div class="input-group input-group-sm" style="width:250px;">
                <span class="input-group-text"><i class="bi bi-search"></i></span>
                <input type="text" class="form-control" name="q" placeholder="Cari layanan..." value="<?= esc($keyword ?? '') ?>">
                <button type="submit" class="btn btn-sm btn-primary">Cari</button>
                <?php if (!empty($keyword)): ?>
                <a href="/layanan" class="btn btn-sm" style="background:rgba(255,255,255,0.1); border:1px solid rgba(255,255,255,0.15); color:#e2e8f0;">
                    <i class="bi bi-x"></i>
                </a>
                <?php endif; ?>
            </div>
        </form>
    </div>
    <div class="card-body p-0">
        <?php if (empty($layanan)): ?>
        <div class="text-center py-5">
            <i class="bi bi-inbox" style="font-size:3rem; color:#334155;"></i>
            <p class="mt-3" style="color:#64748b;">
                <?= !empty($keyword) ? 'Tidak ada layanan yang cocok dengan pencarian "' . esc($keyword) . '".' : 'Belum ada data layanan.' ?>
            </p>
        </div>
        <?php else: ?>
        <div class="table-responsive">
            <table class="table table-hover mb-0" id="layananTable">
                <thead>
                    <tr>
                        <th style="width:50px;">#</th>
                        <th>Nama Layanan</th>
                        <th>Harga</th>
                        <th>Estimasi</th>
                        <th style="width:220px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = ($pager->getCurrentPage('layanan') - 1) * 10 + 1; ?>
                    <?php foreach ($layanan as $item): ?>
                    <tr>
                        <td><span style="color:#475569; font-size:0.8rem;"><?= $no++ ?></span></td>
                        <td>
                            <div style="font-weight:600; color:#f1f5f9;"><?= esc($item['nama_layanan']) ?></div>
                        </td>
                        <td>
                            <span class="badge" style="background:rgba(16,185,129,0.15); color:#34d399; font-size:0.8rem; padding:0.4em 0.8em;">
                                Rp <?= number_format($item['harga'], 0, ',', '.') ?>
                            </span>
                        </td>
                        <td>
                            <span class="badge" style="background:rgba(79,70,229,0.15); color:#818cf8; font-size:0.8rem; padding:0.4em 0.8em;">
                                <i class="bi bi-clock me-1"></i><?= $item['estimasi_hari'] ?> Hari
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-1 flex-wrap">
                                <!-- Tambah ke Keranjang -->
                                <button type="button" class="btn btn-sm"
                                    style="background:rgba(245,158,11,0.15); border:1px solid rgba(245,158,11,0.3); color:#fcd34d;"
                                    onclick="addToCart(<?= $item['id'] ?>, '<?= esc($item['nama_layanan']) ?>')">
                                    <i class="bi bi-cart-plus"></i>
                                </button>
                                <!-- Edit -->
                                <a href="/layanan/edit/<?= $item['id'] ?>" class="btn btn-sm"
                                   style="background:rgba(6,182,212,0.15); border:1px solid rgba(6,182,212,0.3); color:#67e8f9;">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <!-- Hapus -->
                                <button type="button" class="btn btn-sm"
                                    style="background:rgba(239,68,68,0.15); border:1px solid rgba(239,68,68,0.3); color:#fca5a5;"
                                    onclick="confirmDelete('/layanan/delete/<?= $item['id'] ?>', '<?= esc($item['nama_layanan']) ?>')">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <?php if ($pager): ?>
        <div class="d-flex justify-content-between align-items-center p-3 flex-wrap gap-2">
            <small style="color:#64748b;">
                Menampilkan halaman <?= $pager->getCurrentPage('layanan') ?> dari <?= $pager->getPageCount('layanan') ?>
            </small>
            <div>
                <?php
                $currentPage = $pager->getCurrentPage('layanan');
                $totalPages  = $pager->getPageCount('layanan');
                ?>
                <nav>
                    <ul class="pagination pagination-sm mb-0">
                        <?php if ($currentPage > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="/layanan?page_layanan=<?= $currentPage - 1 ?><?= !empty($keyword) ? '&q=' . urlencode($keyword) : '' ?>">
                                <i class="bi bi-chevron-left"></i>
                            </a>
                        </li>
                        <?php endif; ?>

                        <?php for ($i = max(1, $currentPage - 2); $i <= min($totalPages, $currentPage + 2); $i++): ?>
                        <li class="page-item <?= $i == $currentPage ? 'active' : '' ?>">
                            <a class="page-link" href="/layanan?page_layanan=<?= $i ?><?= !empty($keyword) ? '&q=' . urlencode($keyword) : '' ?>"><?= $i ?></a>
                        </li>
                        <?php endfor; ?>

                        <?php if ($currentPage < $totalPages): ?>
                        <li class="page-item">
                            <a class="page-link" href="/layanan?page_layanan=<?= $currentPage + 1 ?><?= !empty($keyword) ? '&q=' . urlencode($keyword) : '' ?>">
                                <i class="bi bi-chevron-right"></i>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </div>
        <?php endif; ?>
        <?php endif; ?>
    </div>
</div>

<!-- Modal Add to Cart -->
<div class="modal fade" id="cartModal" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content" style="background:#1e293b; border:1px solid rgba(79,70,229,0.3);">
            <div class="modal-header" style="border-bottom:1px solid rgba(79,70,229,0.2);">
                <h6 class="modal-title" style="color:#f1f5f9;"><i class="bi bi-cart-plus me-2"></i>Tambah ke Keranjang</h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="/cart/add" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="layanan_id" id="cartLayananId">
                <div class="modal-body">
                    <p style="color:#94a3b8; font-size:0.85rem;" id="cartLayananName"></p>
                    <div class="mb-3">
                        <label class="form-label">Jumlah (kg)</label>
                        <input type="number" class="form-control" name="qty" value="1" min="1" max="100">
                    </div>
                </div>
                <div class="modal-footer" style="border-top:1px solid rgba(79,70,229,0.2);">
                    <button type="button" class="btn btn-sm" style="background:rgba(255,255,255,0.1); border:none; color:#94a3b8;" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-sm btn-primary">
                        <i class="bi bi-cart-plus me-1"></i> Tambahkan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    function addToCart(id, name) {
        document.getElementById('cartLayananId').value = id;
        document.getElementById('cartLayananName').textContent = 'Layanan: ' + name;
        new bootstrap.Modal(document.getElementById('cartModal')).show();
    }
</script>
<?= $this->endSection() ?>
