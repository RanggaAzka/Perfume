<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', $title ?? 'Sign In') — {{ config('app.name') }}</title>
    <meta name="theme-color" content="#111111">

    {{-- Favicon & App Icons (images/P-Logo.png) --}}
    <link rel="icon" type="image/png" href="{{ asset('images/P-Logo.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/P-Logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/P-Logo.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-screen items-center justify-center bg-[#f7f7f5] px-6 py-12 text-ink antialiased">
    <div class="w-full max-w-md">
        <div class="mb-8 text-center">
            <a href="{{ route('home') }}" class="inline-block transition hover:opacity-80" aria-label="Perfu.me">
                <img src="{{ asset('images/P-Logo.png') }}" alt="{{ config('app.name') }}" class="h-10 w-10 mx-auto object-contain">
            </a>
            <p class="mt-2 text-[10px] font-medium uppercase tracking-widest text-[#111111]/40 font-sans">
                Admin Console
            </p>
        </div>

        <div class="border border-[#111111]/10 bg-white p-8 sm:p-10 shadow-xl">
            @yield('content')
        </div>

        <div class="mt-6 text-center">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 text-xs text-[#111111]/50 hover:text-[#111111] transition font-sans">
                <span>&larr;</span>
                <span>Kembali ke Website Utama</span>
            </a>
        </div>
    </div>
</body>
</html>
