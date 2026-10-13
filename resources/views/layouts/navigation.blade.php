
<nav class="bg-white border-b border-gray-200">
    @php
        $dashboardRoute = auth()->user()->role === 'admin'
            ? 'admin.dashboard'
            : 'user.dashboard';
    @endphp

    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-16">

            <a href="{{ route($dashboardRoute) }}"
               class="text-xl font-bold text-purple-700 no-underline">
                Sertifikasi Peserta
            </a>

            <div class="flex items-center gap-5">
                <a href="{{ route($dashboardRoute) }}"
                   class="text-gray-700 hover:text-purple-700 no-underline">
                    Dashboard
                </a>

                <div class="hidden sm:block text-sm text-gray-600">
                    {{ auth()->user()->name }}
                    <span class="text-gray-400">
                        ({{ auth()->user()->role === 'admin' ? 'Admin' : 'Peserta' }})
                    </span>
                </div>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                            class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700">
                        Logout
                    </button>
                </form>
            </div>

        </div>
    </div>
</nav>
