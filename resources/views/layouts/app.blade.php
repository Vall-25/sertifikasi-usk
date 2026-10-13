<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sertifikasi Peserta') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background: #f5f3ff;
        }

        .logout-area {
            display: flex;
            justify-content: flex-end;
            padding: 12px 28px;
            background: white;
            border-bottom: 1px solid #e9e5f5;
        }

        .logout-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            color: #dc3545;
            background: white;
            border: 1px solid #dc3545;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: .2s;
        }

        .logout-btn:hover {
            color: white;
            background: #dc3545;
        }

        main {
            padding: 24px;
        }
    </style>
</head>

<body class="antialiased">
    <div class="min-h-screen">

        @include('layouts.navigation')

        @auth
            <div class="logout-area">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <span aria-hidden="true">↪</span>
                        Logout
                    </button>
                </form>
            </div>
        @endauth

        @isset($header)
            <header class="bg-white shadow-sm">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <main>
            {{ $slot }}
        </main>

    </div>
</body>
</html>