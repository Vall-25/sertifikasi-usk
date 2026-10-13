```blade
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Peserta</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="card shadow-sm">
        <div class="card-body p-4">
            <h3 class="mb-4">Detail Peserta</h3>

            <table class="table table-bordered">
                <tr><th>Nama</th><td>{{ $peserta->nama }}</td></tr>
                <tr><th>NIK</th><td>{{ $peserta->nik }}</td></tr>
                <tr><th>Email</th><td>{{ $peserta->email }}</td></tr>
                <tr><th>No. HP</th><td>{{ $peserta->no_hp }}</td></tr>
                <tr>
                    <th>Tanggal Lahir</th>
                    <td>{{ $peserta->tanggal_lahir->format('d-m-Y') }}</td>
                </tr>
                <tr>
                    <th>Skema</th>
                    <td>{{ $peserta->skema->nama_skema }}</td>
                </tr>
                <tr><th>Alamat</th><td>{{ $peserta->alamat }}</td></tr>
            </table>

            <a href="{{ route('admin.peserta.index') }}"
               class="btn btn-secondary">Kembali</a>

            <a href="{{ route('admin.peserta.edit', ['peserta' => $peserta->id]) }}"
                class="btn btn-warning">
                Edit Peserta
            </a>
        </div>
    </div>
</div>
</body>
</html>
```