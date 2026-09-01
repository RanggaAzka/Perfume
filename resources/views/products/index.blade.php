@extends('layouts.app')

@section('title', 'Our Collection — ' . config('app.name'))
@section('meta_description', 'Jelajahi koleksi Eau de Parfum signature dari Perfu.me — diracik dengan karakter premium, perpaduan aroma khas, dan harga yang jujur.')

@section('content')

{{-- ============================================================
     COLLECTION HERO HEADER
     ============================================================ --}}
<section class="mx-auto max-w-[1400px] px-6 sm:px-10 lg:px-16 pt-12 sm:pt-20 pb-10 sm:pb-12">
    <div class="reveal max-w-2xl">
        <p class="section-label">Collection</p>
        <h1 class="mt-4 font-serif text-3xl sm:text-4xl md:text-5xl lg:text-[62px] font-normal text-[#111111] leading-[1.08] tracking-tight">
            Signature Fragrances.
        </h1>
        <p class="mt-4 sm:mt-5 text-xs sm:text-sm text-[#111111]/70 leading-relaxed font-sans font-light">
            Diramu teliti dalam <em>small batch</em> menggunakan <em>fragrance oil</em> pilihan, alkohol <em>food-grade</em>, dan perpaduan notes yang penuh pertimbangan. Temukan wangi yang diciptakan untuk menyempurnakan rasa percaya dirimu.
        </p>
    </div>
</section>

{{-- ============================================================
     PRODUCTS SHOWCASE GRID
     ============================================================ --}}
<section class="mx-auto max-w-[1400px] px-6 sm:px-10 lg:px-16 pb-16 sm:pb-28">
    @if ($products->isEmpty())
        <div class="border border-[#111111]/10 bg-[#f7f7f5] p-12 sm:p-16 text-center">
            <p class="text-sm text-[#111111]/60">Varian signature baru saat ini sedang dalam proses peracikan di lab kami — silakan cek kembali segera.</p>
        </div>
    @else
        <div class="grid gap-8 sm:gap-10 lg:grid-cols-2 lg:gap-14">
            @foreach ($products as $product)
                <div class="reveal group flex flex-col justify-between border border-[#111111]/10 bg-[#f7f7f5] p-6 sm:p-10 lg:p-12 transition-all duration-500 hover:border-[#111111]/30 hover:shadow-lg">

                    {{-- Top Card Header: Badge & Category --}}
                    <div class="flex items-center justify-between border-b border-[#111111]/10 pb-4 sm:pb-5">
                        <span class="text-[11px] font-sans font-medium uppercase tracking-widest text-[#111111]/50">
                            Eau de Parfum · 30ml
                        </span>
                        @if ($product->fragrance_family)
                            <span class="text-[11px] font-sans font-medium uppercase tracking-widest text-[#b79a5a]">
                                {{ $product->fragrance_family }}
                            </span>
                        @endif
                    </div>

                    {{-- Center: Bottle Display --}}
                    <div class="my-6 sm:my-10 flex items-center justify-center py-4 sm:py-6">
                        <a href="{{ route('products.show', $product) }}" class="inline-block">
                            <img src="{{ $product->imageUrl() }}"
                                 alt="{{ $product->name }}"
                                 loading="lazy"
                                 class="h-[260px] sm:h-[340px] lg:h-[380px] w-auto object-contain drop-shadow-[0_15px_25px_rgba(0,0,0,0.18)] transition-transform duration-500 group-hover:scale-105">
                        </a>
                    </div>

                    {{-- Bottom: Details & CTA --}}
                    <div class="border-t border-[#111111]/10 pt-5 sm:pt-6">
                        <div class="flex items-baseline justify-between gap-4">
                            <h2 class="font-serif text-2xl sm:text-3xl lg:text-4xl font-normal text-[#111111]">
                                <a href="{{ route('products.show', $product) }}" class="transition hover:opacity-75">
                                    {{ $product->name }}
                                </a>
                            </h2>
                            <span class="font-serif text-lg sm:text-xl lg:text-2xl text-[#111111]">
                                {{ $product->priceFormatted() }}
                            </span>
                        </div>

                        <p class="mt-3 text-xs sm:text-sm text-[#111111]/70 leading-relaxed font-sans font-light">
                            {{ $product->short_description }}
                        </p>

                        {{-- Fragrance Notes Tags --}}
                        @if ($product->fragranceNotes->isNotEmpty())
                            <div class="mt-5 sm:mt-6 flex flex-wrap items-center gap-2">
                                <span class="text-[11px] uppercase tracking-widest text-[#111111]/40 font-medium mr-1">Notes:</span>
                                @foreach ($product->fragranceNotes as $note)
                                    <span class="inline-block bg-white px-2.5 sm:px-3 py-1 text-[11px] font-sans font-light text-[#111111]/80 border border-[#111111]/10">
                                        {{ $note->name }}
                                    </span>
                                @endforeach
                            </div>
                        @endif

                        {{-- Action Link & Longevity --}}
                        <div class="mt-6 sm:mt-8 flex items-center justify-between pt-2">
                            <a href="{{ route('products.show', $product) }}"
                               class="inline-flex items-center gap-1 text-xs font-medium tracking-wider text-[#111111] border-b border-[#111111] pb-0.5 transition hover:text-[#b79a5a] hover:border-[#b79a5a] uppercase">
                                <span>View Scent Details</span>
                                <span aria-hidden="true">&rarr;</span>
                            </a>

                            @if ($product->longevity)
                                <span class="text-[11px] text-[#111111]/50 font-sans font-light">
                                    Longevity: {{ $product->longevity }}
                                </span>
                            @endif
                        </div>

                        {{-- Add to Cart Form --}}
                        <form method="POST" action="{{ route('cart.add') }}" class="mt-5 flex items-stretch gap-2.5 border-t border-[#111111]/10 pt-4">
                            @csrf
                            <input type="hidden" name="type" value="product">
                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            {{-- Quantity Stepper (- 1 +) --}}
                            <div class="flex items-center border border-[#111111]/20 bg-white">
                                <button type="button"
                                        onclick="const input = this.parentNode.querySelector('input'); input.value = Math.max(1, parseInt(input.value || '1', 10) - 1);"
                                        class="h-full w-7 text-sm font-medium text-[#111111] transition hover:bg-[#111111] hover:text-white flex items-center justify-center select-none"
                                        aria-label="Kurangi jumlah">&minus;</button>
                                <input type="number" name="quantity" value="1" min="1" max="99" readonly aria-label="Jumlah"
                                       class="w-7 border-0 bg-transparent p-0 text-center text-xs font-semibold text-[#111111] focus:ring-0 select-none [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                                <button type="button"
                                        onclick="const input = this.parentNode.querySelector('input'); input.value = Math.min(99, parseInt(input.value || '1', 10) + 1);"
                                        class="h-full w-7 text-sm font-medium text-[#111111] transition hover:bg-[#111111] hover:text-white flex items-center justify-center select-none"
                                        aria-label="Tambah jumlah">+</button>
                            </div>

                            <button type="submit"
                                    class="group/btn flex-1 inline-flex items-center justify-center gap-2 bg-[#111111] text-white hover:bg-[#b79a5a] px-4 py-2.5 text-[11px] font-medium uppercase tracking-widest transition-all duration-300">
                                <svg class="h-4 w-4 transition-transform duration-200 group-hover/btn:scale-110" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
                                    <line x1="3" y1="6" x2="21" y2="6"/>
                                    <path d="M16 10a4 4 0 0 1-8 0"/>
                                </svg>
                                <span>Tambah ke Keranjang</span>
                            </button>
                        </form>
                    </div>

                </div>
            @endforeach
        </div>
    @endif
</section>

{{-- ============================================================
     REFILL PROMO BANNER
     ============================================================ --}}
<section class="border-t border-[#111111]/10 bg-white">
    <div class="mx-auto max-w-[1400px] px-6 sm:px-10 lg:px-16 py-16 sm:py-24">
        <div class="grid items-center gap-8 lg:grid-cols-12">
            <div class="reveal lg:col-span-8 max-w-2xl">
                <p class="section-label">Refill Station</p>
                <h2 class="mt-3 font-serif text-2xl sm:text-3xl lg:text-4xl text-[#111111] font-normal leading-tight">
                    Looking for everyday versatility?
                </h2>
                <p class="mt-3 sm:mt-4 text-xs sm:text-sm text-[#111111]/70 font-sans font-light leading-relaxed">
                    Jelajahi direktori refill kami dengan lebih dari 20+ pilihan inspirasi aroma dunia mulai dari Rp 20.000. Bawa botol parfummu sendiri atau pilih dari koleksi botol kaca eksklusif kami.
                </p>
            </div>
            <div class="reveal lg:col-span-4 flex lg:justify-end">
                <a href="{{ route('refills.index') }}"
                   class="inline-block bg-[#111111] text-white px-8 py-3.5 text-xs font-medium uppercase tracking-widest transition hover:bg-black">
                    Explore Refills &rarr;
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
