<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Data Peserta</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a href="{{ route('admin.dashboard') }}" class="navbar-brand">
            Sertifikasi Peserta
        </a>

        <a href="{{ route('admin.peserta.index') }}"
           class="btn btn-light btn-sm">
            Kembali
        </a>
    </div>
</nav>

<div class="container py-4">
    <div class="card border-0 shadow-sm mx-auto" style="max-width: 800px">
        <div class="card-body p-4">
            <h3 class="mb-1">Tambah Data Peserta</h3>
            <p class="text-muted mb-4">
                Pilih akun yang sudah register, lalu lengkapi data sertifikasinya.
            </p>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Periksa kembali data berikut:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if ($users->isEmpty())
                <div class="alert alert-warning">
                    <strong>Tidak ada akun yang tersedia.</strong>
                    <p class="mb-0 mt-1">
                        Belum ada akun user yang menunggu penambahan data
                        peserta. Minta user melakukan register terlebih dahulu,
                        atau periksa apakah akun tersebut sudah memiliki data
                        peserta.
                    </p>
                </div>

                <a href="{{ route('admin.peserta.index') }}"
                   class="btn btn-secondary">
                    Kembali ke Data Peserta
                </a>
            @else
                <form action="{{ route('admin.peserta.store') }}"
                      method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="user_id" class="form-label">
                            Akun Peserta yang Sudah Register
                        </label>

                        <select
                            name="user_id"
                            id="user_id"
                            class="form-select @error('user_id') is-invalid @enderror"
                            required
                        >
                            <option value="">-- Pilih akun --</option>

                            @foreach ($users as $user)
                                <option
                                    value="{{ $user->id }}"
                                    @selected(old('user_id') == $user->id)
                                >
                                    {{ $user->name }} — {{ $user->email }}
                                </option>
                            @endforeach
                        </select>

                        @error('user_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <div class="form-text">
                            Nama dan email peserta akan mengikuti akun yang dipilih.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="nik" class="form-label">NIK</label>
                        <input
                            type="text"
                            name="nik"
                            id="nik"
                            class="form-control @error('nik') is-invalid @enderror"
                            value="{{ old('nik') }}"
                            inputmode="numeric"
                            maxlength="16"
                            placeholder="16 digit angka"
                            required
                        >
                        @error('nik')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="no_hp" class="form-label">
                            Nomor Telepon
                        </label>
                        <input
                            type="text"
                            name="no_hp"
                            id="no_hp"
                            class="form-control @error('no_hp') is-invalid @enderror"
                            value="{{ old('no_hp') }}"
                            inputmode="numeric"
                            maxlength="12"
                            placeholder="12 digit angka"
                            required
                        >
                        @error('no_hp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_lahir" class="form-label">
                            Tanggal Lahir
                        </label>
                        <input
                            type="date"
                            name="tanggal_lahir"
                            id="tanggal_lahir"
                            class="form-control @error('tanggal_lahir') is-invalid @enderror"
                            value="{{ old('tanggal_lahir') }}"
                            required
                        >
                        @error('tanggal_lahir')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="skema_id" class="form-label">
                            Skema Sertifikasi
                        </label>
                        <select
                            name="skema_id"
                            id="skema_id"
                            class="form-select @error('skema_id') is-invalid @enderror"
                            required
                        >
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
                        @error('skema_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea
                            name="alamat"
                            id="alamat"
                            rows="3"
                            class="form-control @error('alamat') is-invalid @enderror"
                            placeholder="Masukkan alamat lengkap"
                            required
                        >{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            Simpan Peserta
                        </button>

                        <a href="{{ route('admin.peserta.index') }}"
                           class="btn btn-secondary">
                            Batal
                        </a>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>

</body>
</html>