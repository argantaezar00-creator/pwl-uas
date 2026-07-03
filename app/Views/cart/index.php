<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-2">
    <div>
        <h4><i class="bi bi-cart3 me-2" style="color:#f59e0b;"></i>Keranjang Laundry</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="/dashboard" style="color:#64748b;">Dashboard</a></li>
                <li class="breadcrumb-item active">Keranjang</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex gap-2">
        <a href="/layanan" class="btn btn-sm" style="background:rgba(79,70,229,0.15); border:1px solid rgba(79,70,229,0.3); color:#818cf8;">
            <i class="bi bi-plus-circle me-1"></i> Tambah Layanan
        </a>
        <?php if (!empty($contents)): ?>
        <button type="button" class="btn btn-sm" style="background:rgba(239,68,68,0.15); border:1px solid rgba(239,68,68,0.3); color:#fca5a5;"
            onclick="confirmDestroyCart()">
            <i class="bi bi-trash3 me-1"></i> Kosongkan
        </button>
        <?php endif; ?>
    </div>
</div>

<?php if (empty($contents)): ?>
<!-- Keranjang Kosong -->
<div class="card">
    <div class="card-body text-center py-5">
        <div style="width:80px;height:80px;background:rgba(245,158,11,0.1);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 1.5rem;">
            <i class="bi bi-cart-x" style="font-size:2.5rem; color:#fcd34d;"></i>
        </div>
        <h5 style="color:#f1f5f9; margin-bottom:0.5rem;">Keranjang Kosong</h5>
        <p style="color:#64748b; font-size:0.9rem; margin-bottom:1.5rem;">Belum ada layanan yang ditambahkan ke keranjang.</p>
        <a href="/layanan" class="btn btn-sm btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Pilih Layanan
        </a>
    </div>
</div>

<?php else: ?>
<div class="row g-4">
    <!-- Cart Items -->
    <div class="col-12 col-lg-8">
        <div class="card">
            <div class="card-header d-flex align-items-center gap-2">
                <i class="bi bi-list-check" style="color:#f59e0b;"></i>
                <span style="font-weight:600;">Item Keranjang (<?= count($contents) ?> item)</span>
            </div>
            <div class="card-body p-0">
                <?php foreach ($contents as $rowid => $item): ?>
                <div class="p-3" style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <!-- Icon -->
                        <div style="width:48px;height:48px;background:linear-gradient(135deg,rgba(245,158,11,0.2),rgba(245,158,11,0.05));border-radius:12px;display:flex;align-items:center;justify-content:center;border:1px solid rgba(245,158,11,0.2);flex-shrink:0;">
                            <i class="bi bi-water" style="color:#fcd34d; font-size:1.2rem;"></i>
                        </div>

                        <!-- Info -->
                        <div class="flex-grow-1">
                            <div style="font-weight:600; color:#f1f5f9; font-size:0.95rem;"><?= esc($item['name']) ?></div>
                            <div style="font-size:0.8rem; color:#64748b;">
                                <i class="bi bi-clock me-1"></i>Estimasi <?= $item['options']['estimasi_hari'] ?? '-' ?> hari
                                &nbsp;•&nbsp;
                                <span style="color:#34d399;">Rp <?= number_format($item['price'], 0, ',', '.') ?>/kg</span>
                            </div>
                        </div>

                        <!-- Update Qty Form -->
                        <form action="/cart/update" method="post" class="d-flex align-items-center gap-2">
                            <?= csrf_field() ?>
                            <input type="hidden" name="rowid" value="<?= esc($rowid) ?>">
                            <div class="input-group input-group-sm" style="width:120px;">
                                <button type="button" class="btn btn-sm"
                                    style="background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.1); color:#e2e8f0;"
                                    onclick="decreaseQty('qty_<?= $rowid ?>')">−</button>
                                <input type="number" class="form-control text-center" name="qty" id="qty_<?= $rowid ?>"
                                    value="<?= $item['qty'] ?>" min="1" max="100"
                                    style="background:rgba(15,23,42,0.8); color:#e2e8f0; border-color:rgba(79,70,229,0.25);">
                                <button type="button" class="btn btn-sm"
                                    style="background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.1); color:#e2e8f0;"
                                    onclick="increaseQty('qty_<?= $rowid ?>')">+</button>
                            </div>
                            <button type="submit" class="btn btn-sm" title="Update"
                                style="background:rgba(79,70,229,0.2); border:1px solid rgba(79,70,229,0.3); color:#818cf8;">
                                <i class="bi bi-arrow-clockwise"></i>
                            </button>
                        </form>

                        <!-- Subtotal -->
                        <div class="text-end" style="min-width:100px;">
                            <div style="font-weight:700; color:#fcd34d; font-size:0.95rem;">
                                Rp <?= number_format($item['subtotal'], 0, ',', '.') ?>
                            </div>
                            <div style="font-size:0.75rem; color:#475569;"><?= $item['qty'] ?> kg</div>
                        </div>

                        <!-- Remove -->
                        <button type="button" class="btn btn-sm"
                            style="background:rgba(239,68,68,0.15); border:1px solid rgba(239,68,68,0.3); color:#fca5a5; flex-shrink:0;"
                            onclick="confirmRemoveItem('/cart/remove/<?= $rowid ?>', '<?= esc($item['name']) ?>')">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Summary -->
    <div class="col-12 col-lg-4">
        <div class="card" style="position:sticky; top:80px;">
            <div class="card-header d-flex align-items-center gap-2">
                <i class="bi bi-receipt" style="color:#f59e0b;"></i>
                <span style="font-weight:600;">Ringkasan Pembayaran</span>
            </div>
            <div class="card-body">
                <!-- Item list summary -->
                <?php foreach ($contents as $item): ?>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div>
                        <div style="font-size:0.8rem; color:#94a3b8;"><?= esc($item['name']) ?></div>
                        <div style="font-size:0.75rem; color:#475569;"><?= $item['qty'] ?> kg × Rp <?= number_format($item['price'], 0, ',', '.') ?></div>
                    </div>
                    <div style="font-size:0.85rem; color:#e2e8f0; font-weight:600;">
                        Rp <?= number_format($item['subtotal'], 0, ',', '.') ?>
                    </div>
                </div>
                <?php endforeach; ?>

                <hr style="border-color:rgba(255,255,255,0.08); margin: 1rem 0;">

                <!-- Total -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span style="font-weight:700; color:#f1f5f9;">TOTAL</span>
                    <span style="font-size:1.25rem; font-weight:800; color:#fcd34d;">
                        Rp <?= number_format($total, 0, ',', '.') ?>
                    </span>
                </div>

                <!-- Info badges -->
                <div class="d-flex flex-wrap gap-1 mb-3">
                    <span class="badge" style="background:rgba(79,70,229,0.2); color:#818cf8;">
                        <i class="bi bi-box me-1"></i><?= count($contents) ?> jenis layanan
                    </span>
                    <span class="badge" style="background:rgba(16,185,129,0.2); color:#34d399;">
                        <i class="bi bi-bag me-1"></i>
                        <?php $totalKg = array_sum(array_column($contents, 'qty')); echo $totalKg; ?> kg total
                    </span>
                </div>

                <!-- Checkout info -->
                <div style="background:rgba(245,158,11,0.08); border:1px solid rgba(245,158,11,0.2); border-radius:10px; padding:0.75rem; font-size:0.8rem; color:#94a3b8;">
                    <i class="bi bi-info-circle me-1" style="color:#fcd34d;"></i>
                    Harga dihitung per kilogram. Silahkan konfirmasi ke kasir untuk melanjutkan pembayaran.
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    function increaseQty(id) {
        const input = document.getElementById(id);
        input.value = parseInt(input.value) + 1;
    }

    function decreaseQty(id) {
        const input = document.getElementById(id);
        if (parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
        }
    }

    function confirmRemoveItem(url, name) {
        Swal.fire({
            title: 'Hapus dari Keranjang?',
            html: `Item <strong>${name}</strong> akan dihapus dari keranjang.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#4f46e5',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            background: '#1e293b',
            color: '#e2e8f0',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }

    function confirmDestroyCart() {
        Swal.fire({
            title: 'Kosongkan Keranjang?',
            text: 'Semua item akan dihapus dari keranjang.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#4f46e5',
            confirmButtonText: 'Ya, Kosongkan!',
            cancelButtonText: 'Batal',
            background: '#1e293b',
            color: '#e2e8f0',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '/cart/destroy';
            }
        });
    }
</script>
<?= $this->endSection() ?>
