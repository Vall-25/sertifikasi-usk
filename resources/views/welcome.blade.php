<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Selamat Datang | Sertifikasi Peserta</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>
        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #f5f1ff, #e8eaff);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .welcome-card {
            width: 100%;
            max-width: 700px;
            background: white;
            border-radius: 24px;
            padding: 55px 35px;
            text-align: center;
            box-shadow: 0 15px 45px rgba(50, 35, 90, .12);
        }

        .logo {
            width: 80px;
            height: 80px;
            margin: 0 auto 24px;
            border-radius: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #eee8ff;
            color: #6f42c1;
            font-size: 38px;
            font-weight: bold;
        }

        .welcome-title {
            color: #30204f;
            font-weight: 700;
        }

        .welcome-description {
            max-width: 480px;
            margin: 16px auto 30px;
            color: #6c757d;
            line-height: 1.8;
        }

        .btn-purple {
            background: #6f42c1;
            color: white;
            border: 1px solid #6f42c1;
        }

        .btn-purple:hover {
            background: #59339d;
            color: white;
        }

        .btn-outline-purple {
            color: #6f42c1;
            border: 1px solid #6f42c1;
        }

        .btn-outline-purple:hover {
            background: #6f42c1;
            color: white;
        }
    </style>
</head>

<body>
    <main class="welcome-card">
        <div class="logo">S</div>

        <h1 class="welcome-title">Selamat Datang!</h1>

        <h4 class="mt-3">Sistem Informasi Sertifikasi Peserta</h4>

        <p class="welcome-description">
            Selamat datang di platform sertifikasi kompetensi.
            Silakan login jika sudah memiliki akun atau daftar
            untuk membuat akun baru dan memulai perjalanan sertifikasi Anda.
        </p>

        <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
            <a href="{{ route('login') }}" class="btn btn-primary">
                Login
            </a>

            <a href="{{ route('register') }}" class="btn btn-outline-primary">
                Register
            </a>
            
        </div>

        <p class="text-secondary small mt-4 mb-0">
            Sistem Informasi Sertifikasi Kompetensi
        </p>
    </main>
</body>
</html>