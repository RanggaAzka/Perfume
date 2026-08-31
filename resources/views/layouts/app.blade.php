<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name'))</title>
    <meta name="description" content="@yield('meta_description', 'Affordable fragrances with premium character, designed for every moment.')">

    <meta property="og:title" content="@yield('title', config('app.name'))">
    <meta property="og:description" content="@yield('meta_description', 'Affordable fragrances with premium character, designed for every moment.')">
    <meta property="og:type" content="website">

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
