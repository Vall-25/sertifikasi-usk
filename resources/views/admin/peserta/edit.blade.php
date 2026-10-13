```blade
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Peserta</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card shadow-sm mx-auto" style="max-width: 700px;">
        <div class="card-body p-4">
            <h3 class="mb-4">Edit Data Peserta</h3>
            
           <form action="{{ route('admin.peserta.update', $peserta->id) }}"
      method="POST">
    @csrf
    @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama"
                           class="form-control @error('nama') is-invalid @enderror"
                           value="{{ old('nama', $peserta->nama) }}" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">NIK</label>
                    <input type="text" name="nik" maxlength="16"
                           class="form-control @error('nik') is-invalid @enderror"
                           value="{{ old('nik', $peserta->nik) }}" required>
                    @error('nik')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email"
                           class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email', $peserta->email) }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">No. HP</label>
                    <input type="text" name="no_hp" maxlength="12"
                           class="form-control @error('no_hp') is-invalid @enderror"
                           value="{{ old('no_hp', $peserta->no_hp) }}" required>
                    @error('no_hp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir"
                           class="form-control @error('tanggal_lahir') is-invalid @enderror"
                           value="{{ old('tanggal_lahir', $peserta->tanggal_lahir->format('Y-m-d')) }}"
                           required>
                    @error('tanggal_lahir')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Skema Sertifikasi</label>
                    <select name="skema_id"
                            class="form-select @error('skema_id') is-invalid @enderror"
                            required>
                        <option value="">-- Pilih Skema --</option>
                        @foreach ($skemas as $skema)
                            <option value="{{ $skema->id }}"
                                {{ old('skema_id', $peserta->skema_id) == $skema->id ? 'selected' : '' }}>
                                {{ $skema->nama_skema }}
                            </option>
                        @endforeach
                    </select>
                    @error('skema_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" rows="3"
                              class="form-control @error('alamat') is-invalid @enderror"
                              required>{{ old('alamat', $peserta->alamat) }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.peserta.index') }}"
                   class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>

</body>
</html>
```