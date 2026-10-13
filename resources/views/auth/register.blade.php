
<x-guest-layout>
    <div class="card login-card">
        <div class="card-body p-4 p-md-5">

            <div class="text-center mb-4">
                <div class="login-logo mb-3">S</div>
                <h3 class="fw-bold mb-2">Buat Akun Baru</h3>
                <p class="text-secondary mb-0">
                    Daftar untuk memulai sertifikasi kompetensi
                </p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">Nama Lengkap</label>
                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        class="form-control login-input @error('name') is-invalid @enderror"
                        placeholder="Masukkan nama lengkap"
                        required
                        autofocus
                        autocomplete="name"
                    >
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="form-control login-input @error('email') is-invalid @enderror"
                        placeholder="nama@email.com"
                        required
                        autocomplete="username"
                    >
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold">Password</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        class="form-control login-input @error('password') is-invalid @enderror"
                        placeholder="Minimal 8 karakter"
                        required
                        autocomplete="new-password"
                    >
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="form-label fw-semibold">
                        Konfirmasi Password
                    </label>
                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        class="form-control login-input"
                        placeholder="Ulangi password"
                        required
                        autocomplete="new-password"
                    >
                </div>

                <button type="submit" class="btn login-button w-100">
                    Daftar Sekarang
                </button>
            </form>

            <div class="text-center mt-4">
                <span class="text-secondary">Sudah punya akun?</span>
                <a href="{{ route('login') }}"
                   class="text-decoration-none fw-semibold"
                   style="color: #6f42c1;">
                    Login
                </a>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('welcome') }}"
                   class="text-decoration-none small text-secondary">
                    &larr; Kembali ke halaman utama
                </a>
            </div>

        </div>
    </div>
</x-guest-layout>