```blade
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Skema</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card shadow-sm mx-auto" style="max-width: 700px;">
        <div class="card-body p-4">
            <h3 class="mb-4">Tambah Skema Sertifikasi</h3>

            <form action="{{ route('admin.skema.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama Skema</label>
                    <input type="text" name="nama_skema"
                           class="form-control @error('nama_skema') is-invalid @enderror"
                           value="{{ old('nama_skema') }}" required>
                    @error('nama_skema')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Kode Skema</label>
                    <input type="text" name="kode_skema"
                           class="form-control @error('kode_skema') is-invalid @enderror"
                           value="{{ old('kode_skema') }}" required>
                    @error('kode_skema')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" rows="4"
                              class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>
                <a href="{{ route('admin.skema.index') }}"
                   class="btn btn-secondary">
                    Batal
                </a>
            </form>
        </div>
    </div>
</div>

</body>
</html>
```