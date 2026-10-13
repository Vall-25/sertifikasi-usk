<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sertifikasi Peserta') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>
        .login-wrapper {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 32px 16px;
}

.login-card {
    width: 100%;
    max-width: 440px;
    margin: 0 auto;
    border: 0;
    border-radius: 20px;
    box-shadow: 0 15px 45px rgba(50, 35, 90, 0.12);
    background: white;
}

.login-logo {
    width: 64px;
    height: 64px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 18px;
    background: #eee8ff;
    color: #6f42c1;
    font-size: 30px;
    font-weight: 700;
}

.login-input {
    min-height: 48px;
    border-radius: 10px;
}

.login-button {
    min-height: 48px;
    border-radius: 10px;
    background: #6f42c1;
    border-color: #6f42c1;
    color: white;
    font-weight: 600;
}

.login-button:hover {
    background: #59339d;
    border-color: #59339d;
    color: white;
}
    </style>
</head>

<body>
    <main class="login-wrapper">
        <div class="login-container">
            {{ $slot }}
        </div>
    </main>
</body>
</html>