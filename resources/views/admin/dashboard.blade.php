<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-primary">
    <div class="container">
        <span class="navbar-brand">Sertifikasi Peserta</span>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-light btn-sm">Logout</button>
        </form>
    </div>
</nav>

<div class="container py-4">
    <h2 class="mb-4">Dashboard Admin</h2>

    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Total Peserta</h6>
                    <h2>{{ $totalPeserta }}</h2>
                    <a href="{{ route('admin.peserta.index') }}"
                       class="btn btn-primary btn-sm">Kelola Peserta</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Total Skema</h6>
                    <h2>{{ $totalSkema }}</h2>
                    <a href="{{ route('admin.skema.index') }}"
                       class="btn btn-success btn-sm">Kelola Skema</a>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h5 class="mb-3">Cari Peserta</h5>

            <form method="GET" action="{{ route('admin.dashboard') }}"
                  class="row g-2 mb-4">
                <div class="col-md-10">
                    <input type="text" name="search"
                           value="{{ $keyword }}"
                           class="form-control"
                           placeholder="Cari nama, NIK, email, atau nomor telepon...">
                </div>
                <div class="col-md-2 d-grid">
                    <button class="btn btn-primary">Cari</button>
                </div>
            </form>

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
                                <td>{{ $pesertas->firstItem() + $loop->index }}</td>
                                <td>{{ $peserta->nama }}</td>
                                <td>{{ $peserta->nik }}</td>
                                <td>{{ $peserta->email }}</td>
                                <td>{{ $peserta->no_hp }}</td>
                                <td>{{ $peserta->skema->nama_skema ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('admin.peserta.show', $peserta) }}"
                                       class="btn btn-info btn-sm">Detail</a>
                                    <a href="{{ route('admin.peserta.edit', $peserta) }}"
                                       class="btn btn-warning btn-sm">Edit</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    Data peserta tidak ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $pesertas->links() }}
        </div>
    </div>
</div>

</body>
</html>