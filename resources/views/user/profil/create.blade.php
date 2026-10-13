<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lengkapi Profil Peserta - Sertifikasi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f3ff;
            font-family: Arial, sans-serif;
        }

        .navbar-custom {
            background: #6f42c1;
        }

        .navbar-brand {
            color: white;
            font-weight: bold;
        }

        .navbar-brand:hover {
            color: #eee;
        }

        .profile-card {
            max-width: 850px;
            margin: 40px auto;
            border: none;
            border-radius: 16px;
            box-shadow: 0 8px 25px rgba(55, 30, 100, .10);
        }

        .card-header-custom {
            background: #6f42c1;
            color: white;
            padding: 24px;
            border-radius: 16px 16px 0 0;
        }

        .form-label {
            font-weight: 600;
            color: #343047;
        }

        .form-control, .form-select {
            padding: 11px 13px;
            border-radius: 8px;
        }

        .btn-purple {
            background: #6f42c1;
            color: white;
            border: none;
            padding: 11px 24px;
            border-radius: 8px;
        }

        .btn-purple:hover {
            background: #59339d;
            color: white;
        }

        .btn-logout {
            color: white;
            border: 1px solid white;
            border-radius: 8px;
        }

        .btn-logout:hover {
            background: white;
            color: #6f42c1;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-custom navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('welcome') }}">
                Sertifikasi Peserta
            </a>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-logout btn-sm">
                    Logout
                </button>
            </form>
        </div>
    </nav>

    <div class="container">
        <div class="card profile-card">
            <div class="card-header-custom">
                <h3 class="mb-2">Lengkapi Profil Peserta</h3>
                <p class="mb-0">
                    Isi data diri dengan benar untuk melanjutkan proses sertifikasi.
                </p>
            </div>

            <div class="card-body p-4 p-md-5">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Periksa kembali data yang kamu masukkan.</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('user.profil.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input
                                type="text"
                                name="nama"
                                id="nama"
                                class="form-control"
                                value="{{ old('nama', auth()->user()->name) }}"
                                required
                            >
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email Akun</label>
                            <input
                                type="email"
                                id="email"
                                class="form-control"
                                value="{{ auth()->user()->email }}"
                                readonly
                            >
                            <div class="form-text">Email mengikuti akun yang digunakan untuk login.</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="nik" class="form-label">NIK</label>
                            <input
                                type="text"
                                name="nik"
                                id="nik"
                                class="form-control"
                                value="{{ old('nik') }}"
                                inputmode="numeric"
                                minlength="16"
                                maxlength="16"
                                pattern="[0-9]{16}"
                                placeholder="Masukkan 16 digit NIK"
                                required
                            >
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="no_hp" class="form-label">Nomor HP</label>
                            <input
                                type="text"
                                name="no_hp"
                                id="no_hp"
                                class="form-control"
                                value="{{ old('no_hp') }}"
                                inputmode="numeric"
                                minlength="12"
                                maxlength="12"
                                pattern="[0-9]{12}"
                                placeholder="Masukkan 12 digit nomor HP"
                                required
                            >
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input
                                type="date"
                                name="tanggal_lahir"
                                id="tanggal_lahir"
                                class="form-control"
                                value="{{ old('tanggal_lahir') }}"
                                max="{{ date('Y-m-d') }}"
                                required
                            >
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="skema_id" class="form-label">Skema Sertifikasi</label>
                            <select name="skema_id" id="skema_id" class="form-select" required>
                                <option value="">-- Pilih Skema --</option>
                                @foreach ($skemas as $skema)
                                    <option
                                        value="{{ $skema->id }}"
                                        @selected(old('skema_id') == $skema->id)
                                    >
                                        {{ $skema->nama_skema }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 mb-4">
                            <label for="alamat" class="form-label">Alamat Lengkap</label>
                            <textarea
                                name="alamat"
                                id="alamat"
                                class="form-control"
                                rows="3"
                                placeholder="Masukkan alamat lengkap"
                                required
                            >{{ old('alamat') }}</textarea>
                        </div>
                    </div>

                    <div class="d-flex flex-column flex-sm-row justify-content-between gap-3">
                        <a href="{{ route('welcome') }}" class="btn btn-outline-secondary">
                            Kembali ke Welcome
                        </a>

                        <button type="submit" class="btn btn-purple">
                            Simpan Profil
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <p class="text-center text-muted mb-4">
            &copy; {{ date('Y') }} Sertifikasi Peserta
        </p>
    </div>
</body>
</html>