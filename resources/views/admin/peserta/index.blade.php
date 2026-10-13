<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Peserta</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-primary">
    <div class="container">
        <a href="{{ route('admin.dashboard') }}"
           class="navbar-brand">Sertifikasi Peserta</a>

        <a href="{{ route('admin.dashboard') }}"
           class="btn btn-light btn-sm">Kembali</a>
    </div>
</nav>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2>Data Peserta</h2>
            <p class="text-muted mb-0">Kelola seluruh data peserta sertifikasi.</p>
        </div>

        <a href="{{ route('admin.peserta.create') }}"
           class="btn btn-primary">+ Tambah Peserta</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>Email</th>
                            <th>No. Telepon</th>
                            <th>Skema</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pesertas as $peserta)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $peserta->nama }}</td>
                                <td>{{ $peserta->nik }}</td>
                                <td>{{ $peserta->email }}</td>
                                <td>{{ $peserta->no_hp }}</td>
                                <td>{{ $peserta->skema->nama_skema ?? '-' }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('admin.peserta.show', $peserta) }}"
                                           class="btn btn-info btn-sm">Detail</a>

                                        <a href="{{ route('admin.peserta.edit', $peserta->id) }}"
                                             class="btn btn-warning btn-sm">
                                             Edit
                                            </a>
                                        <form action="{{ route('admin.peserta.destroy', $peserta) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus peserta ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    Belum ada data peserta.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>
</html>