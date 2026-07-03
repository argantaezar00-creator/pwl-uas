<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="page-header">
    <h4><i class="bi bi-pencil-square me-2" style="color:#06b6d4;"></i>Edit Pelanggan</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="/dashboard" style="color:#64748b;">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/pelanggan" style="color:#64748b;">Data Pelanggan</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </nav>
</div>

<div class="row justify-content-center">
    <div class="col-12 col-lg-7">
        <div class="card">
            <div class="card-header d-flex align-items-center gap-2">
                <i class="bi bi-pencil-square" style="color:#06b6d4;"></i>
                <span style="font-weight:600;">Form Edit Pelanggan</span>
                <span class="badge ms-auto" style="background:rgba(79,70,229,0.2); color:#818cf8;">#<?= $pelanggan['id'] ?></span>
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

                <form action="/pelanggan/update/<?= $pelanggan['id'] ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="mb-4">
                        <label for="nama" class="form-label">Nama Pelanggan <span style="color:#ef4444;">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text" class="form-control" id="nama" name="nama"
                                value="<?= old('nama', esc($pelanggan['nama'])) ?>" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="no_hp" class="form-label">No. HP</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-phone"></i></span>
                            <input type="text" class="form-control" id="no_hp" name="no_hp"
                                value="<?= old('no_hp', esc($pelanggan['no_hp'] ?? '')) ?>">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="alamat" class="form-label">Alamat</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3"><?= old('alamat', esc($pelanggan['alamat'] ?? '')) ?></textarea>
                        </div>
                    </div>

                    <div class="d-flex gap-2 justify-content-end">
                        <a href="/pelanggan" class="btn" style="background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.1); color:#94a3b8;">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i> Update Pelanggan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
