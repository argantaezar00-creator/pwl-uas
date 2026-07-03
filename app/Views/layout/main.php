<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'LaundryApp') ?> - Laundry Management System</title>
    <meta name="description" content="Sistem Manajemen Laundry - Kelola layanan dan pelanggan laundry Anda dengan mudah.">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- DataTables -->
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --sidebar-width: 260px;
            --primary: #4f46e5;
            --primary-dark: #3730a3;
            --primary-light: #818cf8;
            --secondary: #06b6d4;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --dark: #0f172a;
            --darker: #020617;
            --card-bg: #1e293b;
            --sidebar-bg: #0f172a;
            --body-bg: #111827;
            --text-muted-custom: #94a3b8;
            --border-color: #1e3a5f;
        }

        * {
            font-family: 'Inter', sans-serif;
            box-sizing: border-box;
        }

        body {
            background-color: var(--body-bg);
            color: #e2e8f0;
            min-height: 100vh;
        }

        /* ===== SIDEBAR ===== */
        #sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: linear-gradient(160deg, #0f172a 0%, #1a1040 100%);
            border-right: 1px solid rgba(79, 70, 229, 0.2);
            display: flex;
            flex-direction: column;
            z-index: 1000;
            transition: transform 0.3s ease;
            overflow-y: auto;
        }

        .sidebar-brand {
            padding: 1.5rem 1.25rem;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        .sidebar-brand .brand-logo {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            margin-right: 10px;
            flex-shrink: 0;
        }

        .sidebar-brand span {
            font-weight: 700;
            font-size: 1rem;
            color: #f1f5f9;
            line-height: 1.2;
        }

        .sidebar-brand small {
            font-size: 0.65rem;
            color: var(--text-muted-custom);
            letter-spacing: 0.05em;
        }

        .sidebar-nav {
            padding: 1rem 0;
            flex: 1;
        }

        .nav-section-label {
            font-size: 0.65rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #475569;
            padding: 0.5rem 1.25rem;
            margin-top: 0.5rem;
        }

        .sidebar-nav .nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.625rem 1.25rem;
            color: #94a3b8;
            border-radius: 0;
            transition: all 0.2s ease;
            font-size: 0.875rem;
            font-weight: 500;
            position: relative;
            margin: 0.1rem 0.5rem;
            border-radius: 8px;
        }

        .sidebar-nav .nav-link:hover {
            color: #e2e8f0;
            background: rgba(79, 70, 229, 0.15);
        }

        .sidebar-nav .nav-link.active {
            color: #fff;
            background: linear-gradient(135deg, rgba(79,70,229,0.4), rgba(6,182,212,0.2));
            border: 1px solid rgba(79, 70, 229, 0.3);
        }

        .sidebar-nav .nav-link .nav-icon {
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
        }

        .sidebar-nav .nav-link.text-danger:hover {
            background: rgba(239,68,68,0.15);
            color: #fca5a5;
        }

        .sidebar-footer {
            padding: 1rem 1.25rem;
            border-top: 1px solid rgba(255,255,255,0.05);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.85rem;
            color: white;
            flex-shrink: 0;
        }

        /* ===== MAIN CONTENT ===== */
        #main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: margin 0.3s ease;
        }

        .topbar {
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(79, 70, 229, 0.15);
            padding: 0.75rem 1.5rem;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .page-content {
            padding: 1.5rem;
        }

        /* ===== CARDS ===== */
        .card {
            background: var(--card-bg);
            border: 1px solid rgba(79, 70, 229, 0.15);
            border-radius: 12px;
            color: #e2e8f0;
        }

        .card-header {
            background: rgba(79, 70, 229, 0.08);
            border-bottom: 1px solid rgba(79, 70, 229, 0.15);
            border-radius: 12px 12px 0 0 !important;
            padding: 0.875rem 1.25rem;
        }

        /* ===== STAT CARDS ===== */
        .stat-card {
            background: var(--card-bg);
            border-radius: 16px;
            padding: 1.5rem;
            border: 1px solid rgba(79, 70, 229, 0.15);
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
        }

        .stat-card.primary::before { background: linear-gradient(90deg, var(--primary), var(--secondary)); }
        .stat-card.success::before { background: linear-gradient(90deg, var(--success), #34d399); }
        .stat-card.warning::before { background: linear-gradient(90deg, var(--warning), #fcd34d); }

        .stat-icon {
            width: 52px;
            height: 52px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .stat-icon.primary { background: rgba(79, 70, 229, 0.15); color: var(--primary-light); }
        .stat-icon.success { background: rgba(16, 185, 129, 0.15); color: #34d399; }
        .stat-icon.warning { background: rgba(245, 158, 11, 0.15); color: #fcd34d; }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: #f1f5f9;
            line-height: 1;
        }

        .stat-label {
            font-size: 0.8rem;
            color: var(--text-muted-custom);
            margin-top: 0.25rem;
        }

        /* ===== TABLE ===== */
        .table {
            color: #e2e8f0;
        }

        .table thead th {
            background: rgba(79, 70, 229, 0.1);
            border-color: rgba(79, 70, 229, 0.2);
            color: #94a3b8;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 0.75rem 1rem;
        }

        .table tbody td {
            border-color: rgba(255,255,255,0.05);
            padding: 0.75rem 1rem;
            vertical-align: middle;
        }

        .table tbody tr:hover td {
            background: rgba(79, 70, 229, 0.06);
        }

        /* ===== BUTTONS ===== */
        .btn-primary {
            background: linear-gradient(135deg, var(--primary), #6d28d9);
            border: none;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--primary-dark), #5b21b6);
            box-shadow: 0 6px 16px rgba(79, 70, 229, 0.4);
            transform: translateY(-1px);
        }

        .btn-sm {
            font-size: 0.75rem;
            padding: 0.3rem 0.6rem;
        }

        /* ===== FORM CONTROLS ===== */
        .form-control, .form-select {
            background: rgba(15, 23, 42, 0.8);
            border: 1px solid rgba(79, 70, 229, 0.25);
            color: #e2e8f0;
            border-radius: 8px;
        }

        .form-control:focus, .form-select:focus {
            background: rgba(15, 23, 42, 0.9);
            border-color: var(--primary);
            color: #e2e8f0;
            box-shadow: 0 0 0 0.25rem rgba(79, 70, 229, 0.25);
        }

        .form-control::placeholder {
            color: #475569;
        }

        .form-label {
            color: #94a3b8;
            font-size: 0.85rem;
            font-weight: 500;
            margin-bottom: 0.35rem;
        }

        .input-group-text {
            background: rgba(79, 70, 229, 0.15);
            border: 1px solid rgba(79, 70, 229, 0.25);
            color: var(--primary-light);
        }

        /* ===== BADGES ===== */
        .badge {
            font-size: 0.7rem;
            font-weight: 600;
            padding: 0.35em 0.65em;
        }

        /* ===== ALERTS ===== */
        .alert {
            border: none;
            border-radius: 10px;
        }

        /* ===== PAGINATION ===== */
        .pagination .page-link {
            background: var(--card-bg);
            border-color: rgba(79, 70, 229, 0.2);
            color: #94a3b8;
        }

        .pagination .page-item.active .page-link {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        .pagination .page-link:hover {
            background: rgba(79, 70, 229, 0.2);
            color: #e2e8f0;
        }

        /* ===== DATATABLE ===== */
        .dataTables_wrapper .dataTables_filter input,
        .dataTables_wrapper .dataTables_length select {
            background: rgba(15, 23, 42, 0.8);
            border: 1px solid rgba(79, 70, 229, 0.25);
            color: #e2e8f0;
            border-radius: 6px;
            padding: 0.25rem 0.5rem;
        }

        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            color: #94a3b8 !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: rgba(79, 70, 229, 0.2) !important;
            border-color: transparent !important;
            color: #e2e8f0 !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: var(--primary) !important;
            border-color: var(--primary) !important;
            color: white !important;
        }

        /* ===== PAGE HEADER ===== */
        .page-header {
            margin-bottom: 1.5rem;
        }

        .page-header h4 {
            font-weight: 700;
            color: #f1f5f9;
            margin: 0;
        }

        .breadcrumb-item, .breadcrumb-item a {
            color: #64748b;
            font-size: 0.8rem;
        }

        .breadcrumb-item.active {
            color: var(--primary-light);
        }

        /* ===== MOBILE ===== */
        @media (max-width: 768px) {
            #sidebar { transform: translateX(-100%); }
            #sidebar.show { transform: translateX(0); }
            #main-content { margin-left: 0; }
        }

        /* ===== SCROLLBAR ===== */
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: var(--darker); }
        ::-webkit-scrollbar-thumb { background: rgba(79,70,229,0.4); border-radius: 10px; }
    </style>
</head>
<body>

<!-- SIDEBAR -->
<nav id="sidebar">
    <div class="sidebar-brand d-flex align-items-center">
        <div class="brand-logo">
            <i class="bi bi-water text-white"></i>
        </div>
        <div>
            <span>LaundryApp</span><br>
            <small>Management System</small>
        </div>
    </div>

    <div class="sidebar-nav">
        <div class="nav-section-label">MAIN MENU</div>
        <a href="/dashboard" class="nav-link <?= (current_url(true)->getPath() == '/dashboard') ? 'active' : '' ?>">
            <i class="bi bi-speedometer2 nav-icon"></i>
            Dashboard
        </a>
        <a href="/layanan" class="nav-link <?= (strpos(current_url(), '/layanan') !== false) ? 'active' : '' ?>">
            <i class="bi bi-clipboard-check nav-icon"></i>
            Data Layanan
        </a>
        <a href="/pelanggan" class="nav-link <?= (strpos(current_url(), '/pelanggan') !== false) ? 'active' : '' ?>">
            <i class="bi bi-people nav-icon"></i>
            Data Pelanggan
        </a>

        <div class="nav-section-label">TRANSAKSI</div>
        <a href="/cart" class="nav-link <?= (strpos(current_url(), '/cart') !== false) ? 'active' : '' ?>">
            <i class="bi bi-cart3 nav-icon"></i>
            Keranjang
            <?php
            $cartLib = \Config\Services::cart();
            $cartCount = count($cartLib->contents());
            if ($cartCount > 0):
            ?>
            <span class="badge rounded-pill ms-auto" style="background: var(--primary); font-size:0.65rem;"><?= $cartCount ?></span>
            <?php endif; ?>
        </a>
    </div>

    <div class="sidebar-footer">
        <div class="user-info">
            <div class="user-avatar">
                <?= strtoupper(substr(session('user_nama') ?? 'A', 0, 1)) ?>
            </div>
            <div class="flex-grow-1 overflow-hidden">
                <div class="text-white fw-600" style="font-size:0.8rem; font-weight:600; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                    <?= esc(session('user_nama') ?? 'Admin') ?>
                </div>
                <div style="font-size:0.7rem; color:#475569;">@<?= esc(session('username') ?? '') ?></div>
            </div>
            <a href="/logout" class="text-danger" title="Logout" onclick="return confirmLogout()">
                <i class="bi bi-box-arrow-right fs-5"></i>
            </a>
        </div>
    </div>
</nav>

<!-- MAIN CONTENT -->
<div id="main-content">
    <!-- TOPBAR -->
    <div class="topbar d-flex align-items-center">
        <button class="btn btn-sm d-md-none me-2" id="sidebarToggle" style="background:rgba(79,70,229,0.2); border:none; color:#94a3b8;">
            <i class="bi bi-list fs-5"></i>
        </button>
        <div>
            <h6 class="mb-0 fw-600" style="color:#f1f5f9; font-size:0.9rem; font-weight:600;"><?= esc($title ?? 'Dashboard') ?></h6>
        </div>
        <div class="ms-auto d-flex align-items-center gap-2">
            <a href="/cart" class="btn btn-sm position-relative" style="background:rgba(79,70,229,0.15); border:1px solid rgba(79,70,229,0.3); color:#94a3b8;">
                <i class="bi bi-cart3"></i>
                <?php if ($cartCount > 0): ?>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size:0.6rem;">
                    <?= $cartCount ?>
                </span>
                <?php endif; ?>
            </a>
            <a href="/logout" class="btn btn-sm" style="background:rgba(239,68,68,0.15); border:1px solid rgba(239,68,68,0.3); color:#fca5a5;" onclick="return confirmLogout()">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
        </div>
    </div>

    <!-- PAGE CONTENT -->
    <div class="page-content">
        <?= $this->renderSection('content') ?>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Sidebar toggle mobile
    document.getElementById('sidebarToggle')?.addEventListener('click', function() {
        document.getElementById('sidebar').classList.toggle('show');
    });

    // Confirm logout
    function confirmLogout() {
        Swal.fire({
            title: 'Konfirmasi Logout',
            text: 'Apakah Anda yakin ingin keluar?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#4f46e5',
            confirmButtonText: 'Ya, Logout',
            cancelButtonText: 'Batal',
            background: '#1e293b',
            color: '#e2e8f0',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '/logout';
            }
        });
        return false;
    }

    // Confirm delete
    function confirmDelete(url, name) {
        Swal.fire({
            title: 'Hapus Data?',
            html: `Data <strong>${name}</strong> akan dipindah ke tong sampah.`,
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

    // Confirm force delete
    function confirmForceDelete(url, name) {
        Swal.fire({
            title: 'Hapus Permanen?',
            html: `Data <strong>${name}</strong> akan dihapus <strong>secara permanen</strong> dan tidak dapat dipulihkan!`,
            icon: 'error',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#4f46e5',
            confirmButtonText: 'Ya, Hapus Permanen!',
            cancelButtonText: 'Batal',
            background: '#1e293b',
            color: '#e2e8f0',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }

    // Confirm restore
    function confirmRestore(url, name) {
        Swal.fire({
            title: 'Pulihkan Data?',
            html: `Data <strong>${name}</strong> akan dipulihkan.`,
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#10b981',
            cancelButtonColor: '#4f46e5',
            confirmButtonText: 'Ya, Pulihkan!',
            cancelButtonText: 'Batal',
            background: '#1e293b',
            color: '#e2e8f0',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }

    // SweetAlert flash messages
    <?php if (session()->getFlashdata('success')): ?>
    Swal.fire({
        title: 'Berhasil!',
        text: '<?= session()->getFlashdata('success') ?>',
        icon: 'success',
        timer: 3000,
        showConfirmButton: false,
        background: '#1e293b',
        color: '#e2e8f0',
        toast: true,
        position: 'top-end',
    });
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
    Swal.fire({
        title: 'Error!',
        text: '<?= session()->getFlashdata('error') ?>',
        icon: 'error',
        timer: 4000,
        showConfirmButton: false,
        background: '#1e293b',
        color: '#e2e8f0',
        toast: true,
        position: 'top-end',
    });
    <?php endif; ?>
</script>

<?= $this->renderSection('scripts') ?>

</body>
</html>
