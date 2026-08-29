@extends('layouts.app')

@section('title', $product->name . ' — ' . config('app.name'))
@section('meta_description', $product->short_description)

@section('content')

{{-- ============================================================
     STATUS NOTIFICATION
     ============================================================ --}}
@if (session('status'))
    <div class="mx-auto max-w-[1400px] px-6 sm:px-10 lg:px-16 pt-8">
        <div class="border border-[#b79a5a]/40 bg-[#b79a5a]/10 p-4 text-xs sm:text-sm text-[#111111] flex items-center justify-between">
            <span>{{ session('status') }}</span>
            <span class="font-medium">✓</span>
        </div>
    </div>
@endif

{{-- ============================================================
     PRODUCT MAIN SHOWCASE SECTION
     ============================================================ --}}
<section class="mx-auto max-w-[1400px] px-6 sm:px-10 lg:px-16 py-10 sm:py-16 lg:py-20">
    <div class="grid items-center gap-10 lg:grid-cols-12 lg:gap-16">

        {{-- Left Column: Product Bottle Visual Presentation --}}
        <div class="reveal lg:col-span-6 flex justify-center">
            <div class="relative w-full max-w-[480px] lg:max-w-[520px]">
                <div class="overflow-hidden bg-[#f7f7f5] p-8 sm:p-12 lg:p-16 border border-[#111111]/10 flex items-center justify-center min-h-[360px] sm:min-h-[460px] lg:min-h-[540px]">
                    <img src="{{ $product->imageUrl() }}"
                         alt="{{ $product->name }}"
                         class="h-[280px] sm:h-[380px] lg:h-[460px] w-auto object-contain drop-shadow-[0_20px_35px_rgba(0,0,0,0.22)] transition-transform duration-700 hover:scale-105">
                </div>
            </div>
        </div>

        {{-- Right Column: Product Information & Purchase Options --}}
        <div class="reveal lg:col-span-6 max-w-xl">

            {{-- Breadcrumb & Category --}}
            <div class="flex items-center gap-2 text-xs font-sans text-[#111111]/50">
                <a href="{{ route('products.index') }}" class="hover:text-[#111111] transition">Collection</a>
                <span>/</span>
                <span class="text-[#111111] font-medium">{{ $product->name }}</span>
            </div>

            {{-- Title --}}
            <h1 class="mt-3 sm:mt-4 font-serif text-3xl sm:text-4xl md:text-5xl lg:text-[58px] font-normal text-[#111111] leading-[1.06] tracking-tight">
                {{ $product->name }}
            </h1>

            {{-- Price & Scent Family Badge --}}
            <div class="mt-4 flex flex-wrap items-center gap-3 sm:gap-4 pb-5 sm:pb-6 border-b border-[#111111]/10">
                <span class="font-serif text-2xl sm:text-3xl text-[#111111]">
                    Rp 45.000
                </span>
                <span class="text-xs uppercase tracking-widest text-[#111111]/40">·</span>
                <span class="text-xs uppercase tracking-widest text-[#111111]/60 font-sans">
                    30ml Eau de Parfum
                </span>
                @if ($product->fragrance_family)
                    <span class="text-xs uppercase tracking-widest text-[#b79a5a] font-medium font-sans">
                        · {{ $product->fragrance_family }}
                    </span>
                @endif
            </div>

            {{-- Description --}}
            <div class="mt-6 space-y-4 text-xs sm:text-sm text-[#111111]/70 leading-relaxed font-sans font-light">
                <p>
                    {{ $product->description ?: $product->short_description }}
                </p>
            </div>

            {{-- Specifications Strip --}}
            <div class="mt-8 grid grid-cols-2 gap-4 border-y border-[#111111]/10 py-5 text-xs font-sans">
                <div>
                    <span class="uppercase tracking-widest text-[#111111]/40 font-medium">Ketahanan</span>
                    <p class="mt-1 text-[#111111] font-medium">{{ $product->longevity ?: '6–8 Jam' }}</p>
                </div>
                <div>
                    <span class="uppercase tracking-widest text-[#111111]/40 font-medium">Proyeksi Aroma</span>
                    <p class="mt-1 text-[#111111] font-medium">Sedang hingga Personal</p>
                </div>
                <div>
                    <span class="uppercase tracking-widest text-[#111111]/40 font-medium">Konsentrasi</span>
                    <p class="mt-1 text-[#111111] font-medium">Eau de Parfum (EDP)</p>
                </div>
                <div>
                    <span class="uppercase tracking-widest text-[#111111]/40 font-medium">Formulasi</span>
                    <p class="mt-1 text-[#111111] font-medium">Food-Grade & Premium Oils</p>
                </div>
            </div>

            {{-- Action CTAs --}}
            <div class="mt-8 flex flex-col sm:flex-row items-stretch sm:items-center gap-3 sm:gap-4">
                <a href="#enquire"
                   class="inline-block text-center bg-[#111111] text-white px-8 py-3.5 text-xs font-medium uppercase tracking-widest transition hover:bg-black">
                    Order / Enquire Now
                </a>

                <a href="https://wa.me/6281383415432?text={{ urlencode('Halo Perfu.me, saya ingin memesan ' . $product->name . ' (30ml EDP, Rp 45.000).') }}"
                   target="_blank"
                   rel="noopener"
                   class="inline-flex items-center justify-center gap-2 border border-[#111111]/20 bg-white px-6 py-3.5 text-xs font-medium text-[#111111] uppercase tracking-widest transition hover:border-[#111111]">
                    <svg class="h-4 w-4 fill-current" viewBox="0 0 24 24">
                        <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.312.045-.694.062-2.147-.533-1.859-.762-3.057-2.651-3.15-2.775-.093-.124-.753-.999-.753-1.908s.478-1.355.648-1.54c.17-.185.372-.232.496-.232.124 0 .248.001.357.006.113.006.264-.043.413.315.155.372.53 1.293.576 1.386.046.093.078.201.016.325-.062.124-.093.201-.186.31-.093.109-.196.243-.28.326-.093.093-.19.195-.082.381.109.186.483.796 1.037 1.289.714.636 1.315.834 1.501.927.186.093.294.078.403-.047.109-.124.465-.542.589-.728.124-.186.248-.155.418-.093.17.062 1.084.511 1.27.604.186.093.31.14.356.217.046.077.046.449-.098.854z"/>
                    </svg>
                    Direct WhatsApp
                </a>
            </div>

        </div>

    </div>
</section>

{{-- ============================================================
     THE OLFACTIVE PYRAMID / SIGNATURE NOTES
     ============================================================ --}}
@php
    $top = $product->topNotes();
    $heart = $product->heartNotes();
    $base = $product->baseNotes();
@endphp

@if ($top->isNotEmpty() || $heart->isNotEmpty() || $base->isNotEmpty())
    <section class="border-t border-[#111111]/10 bg-[#f7f7f5] py-16 sm:py-24">
        <div class="mx-auto max-w-[1400px] px-6 sm:px-10 lg:px-16">

            <div class="text-center max-w-xl mx-auto mb-12 sm:mb-16 reveal">
                <p class="section-label">Olfactive Architecture</p>
                <h2 class="mt-3 font-serif text-3xl sm:text-4xl text-[#111111] font-normal leading-tight">
                    The Notes Symphony
                </h2>
                <p class="mt-3 text-xs sm:text-sm text-[#111111]/70 font-sans font-light">
                    Setiap fase {{ $product->name }} berkembang anggun seiring waktu, memancarkan lapisan karakter wangi yang berbeda.
                </p>
            </div>

            <div class="grid gap-px bg-[#111111]/10 md:grid-cols-3">

                {{-- Top Notes --}}
                <div class="reveal bg-white p-6 sm:p-8 lg:p-10 flex flex-col justify-between">
                    <div>
                        <span class="text-[11px] font-sans font-medium uppercase tracking-widest text-[#111111]/40">Movement 01</span>
                        <h3 class="mt-3 font-serif text-xl sm:text-2xl text-[#111111] font-normal">Top Notes</h3>
                        <p class="mt-1 text-[11px] text-[#111111]/50 font-sans">15–30 menit pertama pemakaian</p>

                        <div class="mt-5 sm:mt-6 flex flex-wrap gap-2">
                            @forelse ($top as $note)
                                <span class="bg-[#f7f7f5] border border-[#111111]/10 px-3 py-1.5 text-xs font-sans text-[#111111]">
                                    {{ $note->name }}
                                </span>
                            @empty
                                <span class="text-xs text-[#111111]/50 font-sans">&mdash;</span>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- Heart Notes --}}
                <div class="reveal bg-white p-6 sm:p-8 lg:p-10 flex flex-col justify-between">
                    <div>
                        <span class="text-[11px] font-sans font-medium uppercase tracking-widest text-[#111111]/40">Movement 02</span>
                        <h3 class="mt-3 font-serif text-xl sm:text-2xl text-[#111111] font-normal">Heart Notes</h3>
                        <p class="mt-1 text-[11px] text-[#111111]/50 font-sans">2–4 jam fase inti aroma</p>

                        <div class="mt-5 sm:mt-6 flex flex-wrap gap-2">
                            @forelse ($heart as $note)
                                <span class="bg-[#f7f7f5] border border-[#111111]/10 px-3 py-1.5 text-xs font-sans text-[#111111]">
                                    {{ $note->name }}
                                </span>
                            @empty
                                <span class="text-xs text-[#111111]/50 font-sans">&mdash;</span>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- Base Notes --}}
                <div class="reveal bg-white p-6 sm:p-8 lg:p-10 flex flex-col justify-between">
                    <div>
                        <span class="text-[11px] font-sans font-medium uppercase tracking-widest text-[#111111]/40">Movement 03</span>
                        <h3 class="mt-3 font-serif text-xl sm:text-2xl text-[#111111] font-normal">Base Notes</h3>
                        <p class="mt-1 text-[11px] text-[#111111]/50 font-sans">6+ jam jejak kehangatan aroma</p>

                        <div class="mt-5 sm:mt-6 flex flex-wrap gap-2">
                            @forelse ($base as $note)
                                <span class="bg-[#f7f7f5] border border-[#111111]/10 px-3 py-1.5 text-xs font-sans text-[#111111]">
                                    {{ $note->name }}
                                </span>
                            @empty
                                <span class="text-xs text-[#111111]/50 font-sans">&mdash;</span>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>
@endif

{{-- ============================================================
     ORDER & ENQUIRY FORM
     ============================================================ --}}
<section id="enquire" class="border-t border-[#111111]/10 bg-white py-16 sm:py-24">
    <div class="mx-auto max-w-2xl px-6 sm:px-10">
        <div class="reveal text-center mb-10 sm:mb-12">
            <p class="section-label">Order &amp; Enquiry</p>
            <h2 class="mt-3 font-serif text-3xl sm:text-4xl text-[#111111] font-normal">
                Reserve {{ $product->name }}
            </h2>
            <p class="mt-3 text-xs sm:text-sm text-[#111111]/70 font-sans font-light">
                Isi data pemesanan di bawah ini dan tim kami akan segera menghubungi Anda melalui WhatsApp atau email untuk konfirmasi pesanan.
            </p>
        </div>

        @php
            $orderMessage = old('message', 'Halo Perfu.me, saya ingin memesan "' . $product->name . '" (30ml EDP, Rp 45.000). Mohon informasi ketersediaan dan pengirimannya.');
        @endphp

        <form method="POST" action="{{ route('contact.store') }}" class="reveal space-y-6">
            @csrf
            <input type="hidden" name="type" value="product">
            <input type="hidden" name="product_name" value="{{ $product->name }}">

            <div>
                <label for="name" class="text-xs uppercase tracking-widest text-[#111111]/50 font-medium">Nama Lengkap *</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                       placeholder="e.g. Alex Pratama"
                       class="mt-2 w-full border border-[#111111]/20 bg-[#f7f7f5] px-4 py-3 text-xs text-[#111111] focus:border-[#111111] focus:bg-white focus:outline-none transition">
                @error('name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="email" class="text-xs uppercase tracking-widest text-[#111111]/50 font-medium">Alamat Email *</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                       placeholder="alex@example.com"
                       class="mt-2 w-full border border-[#111111]/20 bg-[#f7f7f5] px-4 py-3 text-xs text-[#111111] focus:border-[#111111] focus:bg-white focus:outline-none transition">
                @error('email') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="phone" class="text-xs uppercase tracking-widest text-[#111111]/50 font-medium">Nomor WhatsApp *</label>
                <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" required
                       placeholder="e.g. 081383415432"
                       class="mt-2 w-full border border-[#111111]/20 bg-[#f7f7f5] px-4 py-3 text-xs text-[#111111] focus:border-[#111111] focus:bg-white focus:outline-none transition">
                @error('phone') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="message" class="text-xs uppercase tracking-widest text-[#111111]/50 font-medium">Pesan / Catatan Tambahan *</label>
                <textarea name="message" id="message" rows="4" required
                          class="mt-2 w-full border border-[#111111]/20 bg-[#f7f7f5] px-4 py-3 text-xs text-[#111111] focus:border-[#111111] focus:bg-white focus:outline-none transition">{{ $orderMessage }}</textarea>
                @error('message') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <button type="submit"
                    class="w-full bg-[#111111] text-white py-4 text-xs font-medium uppercase tracking-widest transition hover:bg-black">
                Kirim Permintaan Pemesanan &rarr;
            </button>
        </form>
    </div>
</section>

{{-- ============================================================
     DISCOVER ANOTHER SCENT (RELATED PRODUCTS)
     ============================================================ --}}
@if ($related->isNotEmpty())
    <section class="border-t border-[#111111]/10 bg-[#f7f7f5] py-16 sm:py-24">
        <div class="mx-auto max-w-[1400px] px-6 sm:px-10 lg:px-16">
            <div class="reveal text-center mb-10 sm:mb-12">
                <p class="section-label">The House Collection</p>
                <h2 class="mt-3 font-serif text-3xl sm:text-4xl text-[#111111] font-normal">
                    Discover Another Scent
                </h2>
            </div>

            <div class="grid gap-6 sm:gap-8 sm:grid-cols-2 max-w-4xl mx-auto">
                @foreach ($related as $item)
                    <div class="reveal group border border-[#111111]/10 bg-white p-6 sm:p-8 flex flex-col justify-between hover:border-[#111111]/30 transition-all duration-300">
                        <div class="flex justify-center py-4 sm:py-6">
                            <a href="{{ route('products.show', $item) }}">
                                <img src="{{ $item->imageUrl() }}"
                                     alt="{{ $item->name }}"
                                     loading="lazy"
                                     class="h-44 sm:h-52 w-auto object-contain drop-shadow-md group-hover:scale-105 transition-transform duration-500">
                            </a>
                        </div>
                        <div class="border-t border-[#111111]/10 pt-5">
                            <div class="flex items-baseline justify-between">
                                <h3 class="font-serif text-xl sm:text-2xl text-[#111111]">
                                    <a href="{{ route('products.show', $item) }}" class="transition hover:opacity-75">
                                        {{ $item->name }}
                                    </a>
                                </h3>
                                <span class="font-serif text-base sm:text-lg text-[#111111]">Rp 45.000</span>
                            </div>
                            <p class="mt-2 text-xs text-[#111111]/70 font-sans font-light leading-relaxed">
                                {{ $item->short_description }}
                            </p>
                            <div class="mt-5 sm:mt-6">
                                <a href="{{ route('products.show', $item) }}"
                                   class="inline-block text-xs font-medium tracking-wider text-[#111111] border-b border-[#111111] pb-1 transition hover:opacity-50 uppercase">
                                    Explore {{ $item->name }} &rarr;
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif

@endsection
