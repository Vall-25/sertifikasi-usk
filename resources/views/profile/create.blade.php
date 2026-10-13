<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lengkapi Data Peserta | Sertifikasi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background: #f4f5fb;
        }

        .form-card {
            border: none;
            border-radius: 16px;
            overflow: hidden;
        }

        .form-header {
            background: #6f42c1;
            color: white;
            padding: 28px;
        }

        .form-body {
            padding: 30px;
        }

        .form-label {
            font-weight: 600;
        }

        .form-control,
        .form-select {
            padding: 11px 13px;
            border-radius: 8px;
        }

        .btn-primary {
            background: #6f42c1;
            border-color: #6f42c1;
            padding: 12px;
            border-radius: 8px;
        }

        .btn-primary:hover {
            background: #59339d;
            border-color: #59339d;
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-7">

                <div class="text-center mb-4">
                    <h4 class="fw-bold text-dark">Sistem Sertifikasi Kompetensi</h4>
                    <p class="text-secondary mb-0">
                        Lengkapi data diri untuk melanjutkan pendaftaran.
                    </p>
                </div>

                <div class="card form-card shadow-sm">
                    <div class="form-header">
                        <h3 class="fw-bold mb-2">Data Peserta</h3>
                        <p class="mb-0">
                            Isi seluruh data dengan benar.
                        </p>
                    </div>

                    <div class="form-body">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Data belum dapat disimpan.</strong>
                                <ul class="mb-0 mt-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('user.profil.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <input
                                    type="text"
                                    id="nama"
                                    name="nama"
                                    class="form-control @error('nama') is-invalid @enderror"
                                    value="{{ old('nama', auth()->user()->name) }}"
                                    placeholder="Masukkan nama lengkap"
                                    maxlength="255"
                                    required
                                >
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email Akun</label>
                                <input
                                    type="email"
                                    id="email"
                                    class="form-control bg-light"
                                    value="{{ auth()->user()->email }}"
                                    readonly
                                >
                                <small class="text-secondary">
                                    Email diambil dari akun yang digunakan untuk login.
                                </small>
                            </div>

                            <div class="mb-3">
                                <label for="nik" class="form-label">NIK</label>
                                <input
                                    type="text"
                                    id="nik"
                                    name="nik"
                                    class="form-control @error('nik') is-invalid @enderror"
                                    value="{{ old('nik') }}"
                                    placeholder="Masukkan 16 digit NIK"
                                    inputmode="numeric"
                                    minlength="16"
                                    maxlength="16"
                                    pattern="[0-9]{16}"
                                    required
                                >
                                @error('nik')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="no_hp" class="form-label">Nomor HP</label>
                                <input
                                    type="text"
                                    id="no_hp"
                                    name="no_hp"
                                    class="form-control @error('no_hp') is-invalid @enderror"
                                    value="{{ old('no_hp') }}"
                                    placeholder="Masukkan 12 digit nomor HP"
                                    inputmode="numeric"
                                    minlength="12"
                                    maxlength="12"
                                    pattern="[0-9]{12}"
                                    required
                                >
                                @error('no_hp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input
                                    type="date"
                                    id="tanggal_lahir"
                                    name="tanggal_lahir"
                                    class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                    value="{{ old('tanggal_lahir') }}"
                                    max="{{ date('Y-m-d') }}"
                                    required
                                >
                                @error('tanggal_lahir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="skema_id" class="form-label">Skema Sertifikasi</label>
                                <select
                                    id="skema_id"
                                    name="skema_id"
                                    class="form-select @error('skema_id') is-invalid @enderror"
                                    required
                                >
                                    <option value="">-- Pilih Skema Sertifikasi --</option>

                                    @foreach ($skemas as $skema)
                                        <option
                                            value="{{ $skema->id }}"
                                            {{ old('skema_id') == $skema->id ? 'selected' : '' }}
                                        >
                                            {{ $skema->nama_skema }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('skema_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                @if ($skemas->isEmpty())
                                    <div class="text-danger small mt-2">
                                        Belum ada skema sertifikasi. Silakan hubungi admin.
                                    </div>
                                @endif
                            </div>

                            <div class="mb-4">
                                <label for="alamat" class="form-label">Alamat Lengkap</label>
                                <textarea
                                    id="alamat"
                                    name="alamat"
                                    rows="3"
                                    class="form-control @error('alamat') is-invalid @enderror"
                                    placeholder="Masukkan alamat lengkap"
                                    maxlength="1000"
                                    required
                                >{{ old('alamat') }}</textarea>

                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button
                                type="submit"
                                class="btn btn-primary w-100"
                                {{ $skemas->isEmpty() ? 'disabled' : '' }}
                            >
                                Simpan Data Peserta
                            </button>

                        </form>
                    </div>
                </div>

                <p class="text-center text-secondary small mt-4">
                    Pastikan seluruh data yang dimasukkan sudah benar.
                </p>

            </div>
        </div>
    </div>
</body>
</html>