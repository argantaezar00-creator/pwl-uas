<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Laundry Management System</title>
    <meta name="description" content="Login ke Sistem Manajemen Laundry">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * { font-family: 'Inter', sans-serif; }

        body {
            min-height: 100vh;
            background: #020617;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        /* Animated background */
        .bg-glow {
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.15;
            animation: float 8s ease-in-out infinite;
            pointer-events: none;
        }

        .bg-glow-1 {
            width: 400px; height: 400px;
            background: #4f46e5;
            top: -100px; left: -100px;
            animation-delay: 0s;
        }

        .bg-glow-2 {
            width: 300px; height: 300px;
            background: #06b6d4;
            bottom: -80px; right: -80px;
            animation-delay: 3s;
        }

        .bg-glow-3 {
            width: 200px; height: 200px;
            background: #8b5cf6;
            top: 50%; left: 60%;
            animation-delay: 6s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-20px) scale(1.05); }
        }

        /* Grid dots background */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: radial-gradient(rgba(79,70,229,0.15) 1px, transparent 1px);
            background-size: 32px 32px;
            pointer-events: none;
        }

        .login-wrapper {
            width: 100%;
            max-width: 440px;
            padding: 1rem;
            position: relative;
            z-index: 10;
        }

        .login-card {
            background: rgba(15, 23, 42, 0.85);
            backdrop-filter: blur(24px);
            border: 1px solid rgba(79, 70, 229, 0.25);
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 25px 60px rgba(0,0,0,0.5),
                        inset 0 1px 0 rgba(255,255,255,0.05);
        }

        .login-logo {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #4f46e5, #06b6d4);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            margin: 0 auto 1rem;
            box-shadow: 0 8px 24px rgba(79, 70, 229, 0.4);
        }

        .login-title {
            font-size: 1.6rem;
            font-weight: 800;
            color: #f1f5f9;
            text-align: center;
            margin-bottom: 0.25rem;
        }

        .login-subtitle {
            font-size: 0.8rem;
            color: #64748b;
            text-align: center;
            margin-bottom: 2rem;
        }

        .form-control {
            background: rgba(30, 41, 59, 0.8) !important;
            border: 1px solid rgba(79, 70, 229, 0.25) !important;
            color: #e2e8f0 !important;
            border-radius: 10px !important;
            padding: 0.7rem 1rem !important;
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            border-color: #4f46e5 !important;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2) !important;
        }

        .form-control::placeholder { color: #475569; }

        .input-group-text {
            background: rgba(79, 70, 229, 0.1) !important;
            border: 1px solid rgba(79, 70, 229, 0.25) !important;
            color: #818cf8 !important;
            border-radius: 10px 0 0 10px !important;
        }

        .input-group .form-control {
            border-radius: 0 10px 10px 0 !important;
        }

        .form-label {
            color: #94a3b8;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.4rem;
        }

        .btn-login {
            background: linear-gradient(135deg, #4f46e5, #6d28d9);
            border: none;
            border-radius: 10px;
            padding: 0.75rem;
            font-weight: 600;
            font-size: 0.9rem;
            color: white;
            width: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 4px 16px rgba(79, 70, 229, 0.4);
            letter-spacing: 0.025em;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #3730a3, #5b21b6);
            box-shadow: 0 6px 20px rgba(79, 70, 229, 0.5);
            transform: translateY(-2px);
            color: white;
        }

        .btn-login:active { transform: translateY(0); }

        .alert {
            border-radius: 10px;
            font-size: 0.85rem;
            border: none;
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5;
        }

        .demo-info {
            background: rgba(79, 70, 229, 0.08);
            border: 1px solid rgba(79, 70, 229, 0.2);
            border-radius: 10px;
            padding: 0.75rem 1rem;
            margin-top: 1.25rem;
            font-size: 0.8rem;
            color: #64748b;
        }

        .demo-info code {
            background: rgba(79, 70, 229, 0.2);
            color: #818cf8;
            padding: 0.1em 0.3em;
            border-radius: 4px;
        }
    </style>
</head>
<body>

<!-- Background Glows -->
<div class="bg-glow bg-glow-1"></div>
<div class="bg-glow bg-glow-2"></div>
<div class="bg-glow bg-glow-3"></div>

<div class="login-wrapper">
    <div class="login-card">
        <!-- Logo -->
        <div class="login-logo">
            <i class="bi bi-water text-white"></i>
        </div>

        <h1 class="login-title">LaundryApp</h1>
        <p class="login-subtitle">Masuk ke sistem manajemen laundry</p>

        <!-- Flash Messages -->
        <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger d-flex align-items-center gap-2 mb-3">
            <i class="bi bi-exclamation-triangle-fill"></i>
            <?= esc(session()->getFlashdata('error')) ?>
        </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success d-flex align-items-center gap-2 mb-3" style="background:rgba(16,185,129,0.15); border:1px solid rgba(16,185,129,0.3); color:#6ee7b7;">
            <i class="bi bi-check-circle-fill"></i>
            <?= esc(session()->getFlashdata('success')) ?>
        </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger mb-3">
            <ul class="mb-0 ps-3">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>

        <!-- Login Form -->
        <form action="/login" method="post" id="loginForm">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                    <input
                        type="text"
                        class="form-control"
                        id="username"
                        name="username"
                        placeholder="Masukkan username"
                        value="<?= old('username') ?>"
                        required
                        autocomplete="username"
                    >
                </div>
            </div>

            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input
                        type="password"
                        class="form-control"
                        id="password"
                        name="password"
                        placeholder="Masukkan password"
                        required
                        autocomplete="current-password"
                    >
                    <button type="button" class="btn" id="togglePassword"
                        style="background:rgba(79,70,229,0.1); border:1px solid rgba(79,70,229,0.25); border-left:none; border-radius:0 10px 10px 0; color:#818cf8;">
                        <i class="bi bi-eye" id="eyeIcon"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn-login" id="btnLogin">
                <i class="bi bi-box-arrow-in-right me-2"></i>
                Masuk
            </button>
        </form>

        <!-- Demo Credentials -->
        <div class="demo-info text-center">
            <i class="bi bi-info-circle me-1"></i>
            Demo: Username <code>admin</code> / Password <code>admin123</code>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Toggle password visibility
    document.getElementById('togglePassword').addEventListener('click', function () {
        const pwd = document.getElementById('password');
        const eye = document.getElementById('eyeIcon');
        if (pwd.type === 'password') {
            pwd.type = 'text';
            eye.className = 'bi bi-eye-slash';
        } else {
            pwd.type = 'password';
            eye.className = 'bi bi-eye';
        }
    });

    // Loading state on submit
    document.getElementById('loginForm').addEventListener('submit', function() {
        const btn = document.getElementById('btnLogin');
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Memproses...';
        btn.disabled = true;
    });
</script>
</body>
</html>
