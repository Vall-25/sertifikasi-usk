<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Sertifikasi Kompetensi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #f4f0ff, #eef2ff);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .login-card {
            width: 100%;
            max-width: 950px;
            overflow: hidden;
            border: none;
            border-radius: 20px;
            box-shadow: 0 15px 45px rgba(49, 35, 91, .12);
        }

        .login-banner {
            background: linear-gradient(145deg, #6f42c1, #49308c);
            color: white;
            min-height: 550px;
            padding: 45px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-form {
            padding: 45px;
            background: white;
        }

        .brand-icon {
            width: 62px;
            height: 62px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255,255,255,.15);
            border-radius: 16px;
            font-size: 30px;
            margin-bottom: 28px;
        }

        .form-control {
            padding: 12px 14px;
            border-radius: 9px;
        }

        .form-control:focus {
            border-color: #6f42c1;
            box-shadow: 0 0 0 .2rem rgba(111,66,193,.15);
        }

        .btn-login {
            background: #6f42c1;
            color: white;
            padding: 12px;
            border-radius: 9px;
            font-weight: 600;
        }

        .btn-login:hover {
            background: #59339d;
            color: white;
        }

        .register-link {
            color: #6f42c1;
            font-weight: 600;
            text-decoration: none;
        }

        @media (max-width: 767px) {
            .login-banner {
                min-height: auto;
                padding: 30px;
            }

            .login-form {
                padding: 30px 24px;
            }
        }
    </style>
</head>
<body>

<div class="card login-card">
    <div class="row g-0">

        <div class="col-md-5">
            <div class="login-banner">
                <div class="brand-icon">
                    <i class="bi bi-patch-check-fill"></i>
                </div>

                <h2 class="fw-bold mb-3">Sertifikasi Kompetensi</h2>

                <p class="text-white-50">
                    Sistem informasi untuk pengelolaan data peserta
                    dan skema sertifikasi kompetensi.
                </p>

                <hr class="border-light opacity-25">

                <div class="d-flex align-items-center gap-3 mt-3">
                    <i class="bi bi-shield-check fs-3"></i>
                    <div>
                        <div class="fw-semibold">Akses Aman</div>
                        <small class="text-white-50">
                            Masuk menggunakan akun terdaftar.
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="login-form">

                <h3 class="fw-bold mb-2">Selamat Datang!</h3>
                <p class="text-secondary mb-4">
                    Silakan login untuk melanjutkan.
                </p>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close"
                            data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        Email atau password tidak valid.
                        Periksa kembali data login kamu.
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">
                            Email
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') }}"
                            placeholder="nama@email.com"
                            autocomplete="username"
                            required autofocus
                        >

                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">
                            Password
                        </label>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control"
                            placeholder="Masukkan password"
                            autocomplete="current-password"
                            required
                        >
                    </div>

                    <div class="form-check mb-4">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="remember"
                            id="remember"
                        >
                        <label class="form-check-label" for="remember">
                            Ingat saya
                        </label>
                    </div>

                    <button type="submit" class="btn btn-login w-100">
                        <i class="bi bi-box-arrow-in-right me-2"></i>
                        Login
                    </button>
                </form>

                <div class="text-center mt-4">
                    <span class="text-secondary">
                        Belum punya akun?
                    </span>
                    <a href="{{ route('register') }}" class="register-link">
                        Daftar sekarang
                    </a>
                </div>

                <div class="text-center mt-4">
                    <a href="{{ route('welcome') }}"
                        class="text-secondary small text-decoration-none">
                        <i class="bi bi-arrow-left me-1"></i>
                        Kembali ke halaman utama
                    </a>
                </div>

            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>