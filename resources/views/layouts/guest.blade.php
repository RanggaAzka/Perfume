<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Sign in' }} — {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-screen items-center justify-center bg-white px-6 text-ink">
    <div class="w-full max-w-sm">
        <div class="mb-10 text-center">
            <a href="{{ route('home') }}" class="font-serif text-2xl">{{ config('app.name') }}</a>
        </div>
        @yield('content')
    </div>
</body>
</html>
