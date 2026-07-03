<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-2">
    <div>
        <h4><i class="bi bi-trash3 me-2" style="color:#ef4444;"></i>Tong Sampah - Pelanggan</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="/dashboard" style="color:#64748b;">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/pelanggan" style="color:#64748b;">Data Pelanggan</a></li>
                <li class="breadcrumb-item active">Tong Sampah</li>
            </ol>
        </nav>
    </div>
    <a href="/pelanggan" class="btn btn-sm" style="background:rgba(79,70,229,0.15); border:1px solid rgba(79,70,229,0.3); color:#818cf8;">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-header">
        <span style="font-weight:600; color:#fca5a5;">
            <i class="bi bi-trash3 me-1"></i> Data Pelanggan Terhapus (Soft Delete)
        </span>
    </div>
    <div class="card-body p-0">
        <?php if (empty($pelanggan)): ?>
        <div class="text-center py-5">
            <i class="bi bi-trash" style="font-size:3rem; color:#334155;"></i>
            <p class="mt-3" style="color:#64748b;">Tong sampah kosong. Tidak ada pelanggan yang dihapus.</p>
        </div>
        <?php else: ?>
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>No. HP</th>
                        <th>Alamat</th>
                        <th>Dihapus Pada</th>
                        <th style="width:180px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($pelanggan as $item): ?>
                    <tr>
                        <td><span style="color:#475569; font-size:0.8rem;"><?= $no++ ?></span></td>
                        <td style="color:#94a3b8; text-decoration:line-through;"><?= esc($item['nama']) ?></td>
                        <td><span style="color:#64748b;"><?= esc($item['no_hp'] ?? '-') ?></span></td>
                        <td><span style="color:#64748b; font-size:0.8rem;"><?= esc($item['alamat'] ?? '-') ?></span></td>
                        <td>
                            <span style="color:#64748b; font-size:0.8rem;">
                                <?= date('d M Y H:i', strtotime($item['deleted_at'])) ?>
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <button type="button" class="btn btn-sm"
                                    style="background:rgba(16,185,129,0.15); border:1px solid rgba(16,185,129,0.3); color:#34d399;"
                                    onclick="confirmRestore('/pelanggan/restore/<?= $item['id'] ?>', '<?= esc($item['nama']) ?>')">
                                    <i class="bi bi-arrow-counterclockwise me-1"></i> Pulihkan
                                </button>
                                <button type="button" class="btn btn-sm"
                                    style="background:rgba(239,68,68,0.15); border:1px solid rgba(239,68,68,0.3); color:#fca5a5;"
                                    onclick="confirmForceDelete('/pelanggan/force-delete/<?= $item['id'] ?>', '<?= esc($item['nama']) ?>')">
                                    <i class="bi bi-x-circle me-1"></i> Hapus Permanen
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>
