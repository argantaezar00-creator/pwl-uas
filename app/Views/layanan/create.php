<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="page-header">
    <h4><i class="bi bi-plus-circle me-2" style="color:#4f46e5;"></i>Tambah Layanan</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="/dashboard" style="color:#64748b;">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/layanan" style="color:#64748b;">Data Layanan</a></li>
            <li class="breadcrumb-item active">Tambah</li>
        </ol>
    </nav>
</div>

<div class="row justify-content-center">
    <div class="col-12 col-lg-7">
        <div class="card">
            <div class="card-header d-flex align-items-center gap-2">
                <i class="bi bi-clipboard-plus" style="color:#4f46e5;"></i>
                <span style="font-weight:600;">Form Tambah Layanan</span>
            </div>
            <div class="card-body p-4">

                <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0 ps-3">
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>

                <form action="/layanan/store" method="post" id="formLayanan">
                    <?= csrf_field() ?>

                    <div class="mb-4">
                        <label for="nama_layanan" class="form-label">Nama Layanan <span style="color:#ef4444;">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-clipboard-check"></i></span>
                            <input type="text" class="form-control" id="nama_layanan" name="nama_layanan"
                                placeholder="Contoh: Cuci Setrika"
                                value="<?= old('nama_layanan') ?>" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="harga" class="form-label">Harga (Rp) <span style="color:#ef4444;">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" id="harga" name="harga"
                                placeholder="Contoh: 9000"
                                value="<?= old('harga') ?>" min="0" step="500" required>
                            <span class="input-group-text">/kg</span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="estimasi_hari" class="form-label">Estimasi Hari <span style="color:#ef4444;">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-calendar-check"></i></span>
                            <input type="number" class="form-control" id="estimasi_hari" name="estimasi_hari"
                                placeholder="Contoh: 2"
                                value="<?= old('estimasi_hari') ?>" min="1" required>
                            <span class="input-group-text">Hari</span>
                        </div>
                    </div>

                    <div class="d-flex gap-2 justify-content-end">
                        <a href="/layanan" class="btn" style="background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.1); color:#94a3b8;">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i> Simpan Layanan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
