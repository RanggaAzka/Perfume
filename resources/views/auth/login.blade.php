@extends('layouts.guest')

@section('title', 'Admin Sign In')

@section('content')
    <div class="mb-6 text-center">
        <p class="section-label">Authentication</p>
        <h1 class="mt-1 font-serif text-2xl text-[#111111] font-normal">Sign In to Dashboard</h1>
        <p class="mt-1.5 text-xs text-[#111111]/60 font-sans font-light">
            Masukkan kredensial administrator Anda untuk mengelola produk, refill, dan pesan pelanggan.
        </p>
    </div>

    @if ($errors->any())
        <div class="mb-6 border border-red-500/30 bg-red-500/10 p-3.5 text-xs text-red-800">
            <div class="flex items-center gap-2">
                <svg class="h-4 w-4 shrink-0 text-red-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
                <span>{{ $errors->first() }}</span>
            </div>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="block text-xs uppercase tracking-widest text-[#111111]/50 font-medium">Alamat Email *</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                   placeholder="admin@example.com"
                   class="mt-1.5 w-full border border-[#111111]/20 bg-[#f7f7f5] px-4 py-3 text-xs text-[#111111] focus:border-[#111111] focus:bg-white focus:outline-none transition">
        </div>

        <div>
            <label for="password" class="block text-xs uppercase tracking-widest text-[#111111]/50 font-medium">Kata Sandi *</label>
            <input type="password" name="password" id="password" required
                   placeholder="••••••••"
                   class="mt-1.5 w-full border border-[#111111]/20 bg-[#f7f7f5] px-4 py-3 text-xs text-[#111111] focus:border-[#111111] focus:bg-white focus:outline-none transition">
        </div>

        <div class="flex items-center justify-between pt-1">
            <label class="flex items-center gap-2 text-xs text-[#111111]/70 cursor-pointer select-none">
                <input type="checkbox" name="remember" class="rounded border-[#111111]/30 text-[#111111] focus:ring-[#111111]">
                <span>Ingat saya di perangkat ini</span>
            </label>
        </div>

        <button type="submit"
                class="w-full bg-[#111111] text-white py-3.5 text-xs font-medium uppercase tracking-widest transition hover:bg-[#b79a5a] shadow-sm">
            Masuk ke Panel Admin &rarr;
        </button>
    </form>
@endsection
