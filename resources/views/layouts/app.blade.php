<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name'))</title>
    <meta name="description" content="@yield('meta_description', 'Affordable fragrances with premium character, designed for every moment.')">
    <meta name="theme-color" content="#111111">

    {{-- Favicon & App Icons (images/P-Logo.png) --}}
    <link rel="icon" type="image/png" href="{{ asset('images/P-Logo.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/P-Logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/P-Logo.png') }}">

    {{-- Open Graph & Twitter Cards --}}
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:title" content="@yield('title', config('app.name'))">
    <meta property="og:description" content="@yield('meta_description', 'Affordable fragrances with premium character, designed for every moment.')">
    <meta property="og:type" content="website">
    <meta property="og:image" content="{{ asset('images/Perfume.png') }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', config('app.name'))">
    <meta name="twitter:description" content="@yield('meta_description', 'Affordable fragrances with premium character, designed for every moment.')">
    <meta name="twitter:image" content="{{ asset('images/Perfume.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-ink">
    <x-navbar />

    <main>
        @yield('content')
    </main>

    <x-footer />

    {{-- Cart slide-over drawer (guest, session based) --}}
    @include('components.cart-drawer')

    {{-- Success confirmation popup for form submissions --}}
    @include('components.success-modal')

    @stack('scripts')
</body>
</html>
