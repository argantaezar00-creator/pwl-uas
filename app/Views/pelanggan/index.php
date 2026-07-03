<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-2">
    <div>
        <h4><i class="bi bi-people me-2" style="color:#10b981;"></i>Data Pelanggan</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="/dashboard" style="color:#64748b;">Dashboard</a></li>
                <li class="breadcrumb-item active">Data Pelanggan</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex gap-2 flex-wrap">
        <a href="/pelanggan/trash" class="btn btn-sm" style="background:rgba(239,68,68,0.15); border:1px solid rgba(239,68,68,0.3); color:#fca5a5;">
            <i class="bi bi-trash3 me-1"></i> Tong Sampah
        </a>
        <a href="/pelanggan/create" class="btn btn-sm" style="background:linear-gradient(135deg,#10b981,#059669); border:none; color:white;">
            <i class="bi bi-person-plus me-1"></i> Tambah Pelanggan
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between gap-2 flex-wrap">
        <span style="font-weight:600; font-size:0.9rem;">
            <i class="bi bi-table me-1" style="color:#10b981;"></i> Daftar Pelanggan
        </span>
        <!-- Search Form -->
        <form method="get" action="/pelanggan" class="d-flex gap-2">
            <div class="input-group input-group-sm" style="width:250px;">
                <span class="input-group-text"><i class="bi bi-search"></i></span>
                <input type="text" class="form-control" name="q" placeholder="Cari nama / no. HP..." value="<?= esc($keyword ?? '') ?>">
                <button type="submit" class="btn btn-sm" style="background:linear-gradient(135deg,#10b981,#059669); border:none; color:white;">Cari</button>
                <?php if (!empty($keyword)): ?>
                <a href="/pelanggan" class="btn btn-sm" style="background:rgba(255,255,255,0.1); border:1px solid rgba(255,255,255,0.15); color:#e2e8f0;">
                    <i class="bi bi-x"></i>
                </a>
                <?php endif; ?>
            </div>
        </form>
    </div>
    <div class="card-body p-0">
        <?php if (empty($pelanggan)): ?>
        <div class="text-center py-5">
            <i class="bi bi-people" style="font-size:3rem; color:#334155;"></i>
            <p class="mt-3" style="color:#64748b;">
                <?= !empty($keyword) ? 'Tidak ada pelanggan yang cocok dengan pencarian "' . esc($keyword) . '".' : 'Belum ada data pelanggan.' ?>
            </p>
        </div>
        <?php else: ?>
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th style="width:50px;">#</th>
                        <th>Nama</th>
                        <th>No. HP</th>
                        <th>Alamat</th>
                        <th style="width:160px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = ($pager->getCurrentPage('pelanggan') - 1) * 10 + 1; ?>
                    <?php foreach ($pelanggan as $item): ?>
                    <tr>
                        <td><span style="color:#475569; font-size:0.8rem;"><?= $no++ ?></span></td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div style="width:32px;height:32px;background:linear-gradient(135deg,#10b981,#059669);border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:0.8rem;color:white;flex-shrink:0;">
                                    <?= strtoupper(substr($item['nama'], 0, 1)) ?>
                                </div>
                                <span style="font-weight:600; color:#f1f5f9;"><?= esc($item['nama']) ?></span>
                            </div>
                        </td>
                        <td>
                            <?php if (!empty($item['no_hp'])): ?>
                            <span class="badge" style="background:rgba(6,182,212,0.15); color:#67e8f9; font-size:0.8rem; padding:0.4em 0.8em;">
                                <i class="bi bi-phone me-1"></i><?= esc($item['no_hp']) ?>
                            </span>
                            <?php else: ?>
                            <span style="color:#475569; font-size:0.8rem;">-</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <span style="color:#94a3b8; font-size:0.85rem;">
                                <?= !empty($item['alamat']) ? esc(substr($item['alamat'], 0, 40)) . (strlen($item['alamat']) > 40 ? '...' : '') : '-' ?>
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="/pelanggan/edit/<?= $item['id'] ?>" class="btn btn-sm"
                                   style="background:rgba(6,182,212,0.15); border:1px solid rgba(6,182,212,0.3); color:#67e8f9;">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <button type="button" class="btn btn-sm"
                                    style="background:rgba(239,68,68,0.15); border:1px solid rgba(239,68,68,0.3); color:#fca5a5;"
                                    onclick="confirmDelete('/pelanggan/delete/<?= $item['id'] ?>', '<?= esc($item['nama']) ?>')">
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
                Menampilkan halaman <?= $pager->getCurrentPage('pelanggan') ?> dari <?= $pager->getPageCount('pelanggan') ?>
            </small>
            <div>
                <?php
                $currentPage = $pager->getCurrentPage('pelanggan');
                $totalPages  = $pager->getPageCount('pelanggan');
                ?>
                <nav>
                    <ul class="pagination pagination-sm mb-0">
                        <?php if ($currentPage > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="/pelanggan?page_pelanggan=<?= $currentPage - 1 ?><?= !empty($keyword) ? '&q=' . urlencode($keyword) : '' ?>">
                                <i class="bi bi-chevron-left"></i>
                            </a>
                        </li>
                        <?php endif; ?>

                        <?php for ($i = max(1, $currentPage - 2); $i <= min($totalPages, $currentPage + 2); $i++): ?>
                        <li class="page-item <?= $i == $currentPage ? 'active' : '' ?>">
                            <a class="page-link" href="/pelanggan?page_pelanggan=<?= $i ?><?= !empty($keyword) ? '&q=' . urlencode($keyword) : '' ?>"><?= $i ?></a>
                        </li>
                        <?php endfor; ?>

                        <?php if ($currentPage < $totalPages): ?>
                        <li class="page-item">
                            <a class="page-link" href="/pelanggan?page_pelanggan=<?= $currentPage + 1 ?><?= !empty($keyword) ? '&q=' . urlencode($keyword) : '' ?>">
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

<?= $this->endSection() ?>
