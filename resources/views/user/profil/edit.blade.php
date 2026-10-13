<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil Peserta</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a href="{{ route('user.dashboard') }}"
           class="navbar-brand">
            Sertifikasi Peserta
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-light btn-sm">
                Logout
            </button>
        </form>
    </div>
</nav>

<div class="container py-5">
    <div class="card shadow-sm mx-auto border-0"
         style="max-width: 750px;">

        <div class="card-body p-4 p-md-5">

            <h3 class="mb-2">Profil Peserta</h3>
            <p class="text-muted mb-4">
                Lihat dan perbarui data milikmu.
            </p>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Data belum berhasil disimpan.</strong>
                    Periksa kembali isian berikut.
                </div>
            @endif

            <form action="{{ route('user.profil.update') }}"
                  method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama" class="form-label">
                        Nama Lengkap
                    </label>
                    <input
                        type="text"
                        id="nama"
                        name="nama"
                        class="form-control @error('nama') is-invalid @enderror"
                        value="{{ old('nama', $peserta->nama) }}"
                        required
                    >
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="nik" class="form-label">NIK</label>
                    <input
                        type="text"
                        id="nik"
                        name="nik"
                        maxlength="16"
                        inputmode="numeric"
                        class="form-control @error('nik') is-invalid @enderror"
                        value="{{ old('nik', $peserta->nik) }}"
                        required
                    >
                    @error('nik')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email', $peserta->email) }}"
                        required
                    >
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="no_hp" class="form-label">Nomor HP</label>
                    <input
                        type="text"
                        id="no_hp"
                        name="no_hp"
                        maxlength="12"
                        inputmode="numeric"
                        class="form-control @error('no_hp') is-invalid @enderror"
                        value="{{ old('no_hp', $peserta->no_hp) }}"
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
                        id="tanggal_lahir"
                        name="tanggal_lahir"
                        class="form-control @error('tanggal_lahir') is-invalid @enderror"
                        value="{{ old('tanggal_lahir', \Illuminate\Support\Carbon::parse($peserta->tanggal_lahir)->format('Y-m-d')) }}"
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
                        id="skema_id"
                        name="skema_id"
                        class="form-select @error('skema_id') is-invalid @enderror"
                        required
                    >
                        <option value="">-- Pilih Skema --</option>

                        @foreach ($skemas as $skema)
                            <option
                                value="{{ $skema->id }}"
                                {{ old('skema_id', $peserta->skema_id) == $skema->id ? 'selected' : '' }}
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
                        id="alamat"
                        name="alamat"
                        rows="3"
                        class="form-control @error('alamat') is-invalid @enderror"
                        required
                    >{{ old('alamat', $peserta->alamat) }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex flex-wrap gap-2">
                    <button type="submit" class="btn btn-primary">
                        Simpan Perubahan
                    </button>

                    <a href="{{ route('user.dashboard') }}"
                       class="btn btn-secondary">
                        Kembali ke Dashboard
                    </a>
                </div>
            </form>

        </div>
    </div>
</div>

</body>
</html>