<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Peserta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-primary">
    <div class="container">
        <span class="navbar-brand">Sertifikasi Peserta</span>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-light">
                Logout
            </button>
        </form>
    </div>
</nav>

<div class="container py-5">
    <h2>Dashboard Peserta</h2>
    <p class="text-muted">
        Selamat datang, {{ auth()->user()->name }}.
    </p>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($peserta)
        <div class="card shadow-sm mt-4">
            <div class="card-header bg-white">
                <h5 class="mb-0">Data Peserta Saya</h5>
            </div>

            <div class="card-body">
                <p><strong>Nama:</strong> {{ $peserta->nama }}</p>
                <p><strong>NIK:</strong> {{ $peserta->nik }}</p>
                <p><strong>Email:</strong> {{ $peserta->email }}</p>
                <p><strong>No. HP:</strong> {{ $peserta->no_hp }}</p>
                <p><strong>Tanggal Lahir:</strong> {{ $peserta->tanggal_lahir }}</p>
                <p><strong>Alamat:</strong> {{ $peserta->alamat }}</p>
                <p>
                    <strong>Skema:</strong>
                    {{ $peserta->skema->nama_skema ?? '-' }}
                </p>

                <a href="{{ route('user.profil.edit') }}"
                   class="btn btn-primary">
                    Edit Data Saya
                </a>
            </div>
        </div>
    @else
        <div class="alert alert-info mt-4">
            <h5>Data peserta belum tersedia</h5>
            <p class="mb-0">
                Akun kamu sudah terdaftar, tetapi data peserta belum
                ditambahkan atau dihubungkan oleh admin.
                Silakan hubungi admin.
            </p>
        </div>
    @endif
</div>

</body>
</html>