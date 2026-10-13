```blade
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Skema</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2>Data Skema</h2>
            <p class="text-muted">Kelola skema sertifikasi</p>
        </div>
        <a href="{{ route('admin.skema.create') }}"
           class="btn btn-primary">
            + Tambah Skema
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>No.</th>
                            <th>Nama Skema</th>
                            <th>Kode Skema</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($skemas as $skema)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $skema->nama_skema }}</td>
                                <td>{{ $skema->kode_skema }}</td>
                                <td>{{ $skema->deskripsi ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('admin.skema.edit', $skema) }}"
                                       class="btn btn-warning btn-sm">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.skema.destroy', $skema) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus skema ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-danger btn-sm">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">
                                    Belum ada data skema.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <a href="{{ route('admin.dashboard') }}"
               class="btn btn-secondary">
                Kembali ke Dashboard
            </a>
        </div>
    </div>
</div>

</body>
</html>
```