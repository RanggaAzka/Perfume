@extends('layouts.app')

@section('title', $product->name . ' — ' . config('app.name'))
@section('meta_description', $product->short_description)

@section('content')

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
                    {{ $product->priceFormatted() }}
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

            {{-- Main Accords --}}
            @if ($product->mainAccordsSorted()->isNotEmpty())
                @php
                    $accordColors = [
                        'Woody' => '#8b5e3c',
                        'Floral' => '#c07a94',
                        'Fresh' => '#6f9e8f',
                        'Citrus' => '#d09a3f',
                        'Sweet' => '#cf7480',
                        'Spicy' => '#b3543e',
                        'Green' => '#7d8b4f',
                        'Aquatic' => '#6d9bbf',
                        'Amber' => '#b0703a',
                        'Gourmand' => '#b97a57',
                        'Leather' => '#5a4a42',
                        'Powdery' => '#a89a8f',
                    ];
                @endphp
                <div class="mt-8">
                    <p class="section-label">Main Accords</p>
                    <div class="mt-4 border border-[#111111]/10 bg-[#f7f7f5] p-5 sm:p-6 space-y-4">
                        @foreach ($product->mainAccordsSorted() as $accord)
                            @php
                                $color = $accordColors[$accord['accord']] ?? '#b79a5a';
                            @endphp
                            <div class="flex items-center gap-3">
                                <span class="flex w-28 shrink-0 items-center gap-2">
                                    <span class="shrink-0 rounded-full" style="width: 6px; height: 6px; background-color: {{ $color }}"></span>
                                    <span class="text-[11px] uppercase tracking-widest text-[#111111] font-sans font-medium">{{ $accord['accord'] }}</span>
                                </span>
                                <div class="flex-1 rounded-full" style="height: 10px; background-color: {{ $color }}1A">
                                    <div class="h-full rounded-full" style="width: {{ $accord['percent'] }}%; height: 100%; background-color: {{ $color }}"></div>
                                </div>
                                <span class="w-9 shrink-0 text-right text-[11px] font-sans font-semibold text-[#111111]">{{ $accord['percent'] }}%</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

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

            {{-- Purchase & CTAs Area --}}
            <div class="mt-8 space-y-4">
                {{-- Add to Cart Form --}}
                <form method="POST" action="{{ route('cart.add') }}" class="flex flex-col sm:flex-row items-stretch gap-3 sm:gap-4">
                    @csrf
                    <input type="hidden" name="type" value="product">
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    {{-- Quantity Stepper (- 1 +) --}}
                    <div class="flex items-center justify-between border border-[#111111]/20 bg-[#f7f7f5] px-3 py-2 sm:w-32 shrink-0">
                        <span class="text-[10px] uppercase tracking-widest text-[#111111]/50 font-medium pl-1">Qty</span>
                        <div class="flex items-center">
                            <button type="button"
                                    onclick="const input = this.parentNode.querySelector('input'); input.value = Math.max(1, parseInt(input.value || '1', 10) - 1);"
                                    class="h-7 w-7 text-sm font-medium text-[#111111] transition hover:bg-[#111111] hover:text-white flex items-center justify-center select-none"
                                    aria-label="Kurangi jumlah">&minus;</button>
                            <input type="number" name="quantity" id="product-qty" value="{{ old('quantity', 1) }}" min="1" max="99" readonly aria-label="Jumlah"
                                   class="w-7 border-0 bg-transparent p-0 text-center text-xs font-semibold text-[#111111] focus:ring-0 select-none [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                            <button type="button"
                                    onclick="const input = this.parentNode.querySelector('input'); input.value = Math.min(99, parseInt(input.value || '1', 10) + 1);"
                                    class="h-7 w-7 text-sm font-medium text-[#111111] transition hover:bg-[#111111] hover:text-white flex items-center justify-center select-none"
                                    aria-label="Tambah jumlah">+</button>
                        </div>
                    </div>

                    <button type="submit"
                            class="group/btn flex-1 inline-flex items-center justify-center gap-2.5 bg-[#111111] text-white hover:bg-[#b79a5a] py-3.5 px-8 text-xs font-medium uppercase tracking-widest transition-all duration-300 shadow-sm">
                        <svg class="h-4 w-4 transition-transform duration-200 group-hover/btn:scale-110" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
                            <line x1="3" y1="6" x2="21" y2="6"/>
                            <path d="M16 10a4 4 0 0 1-8 0"/>
                        </svg>
                        <span>Tambah ke Keranjang</span>
                    </button>
                </form>

                {{-- Direct WhatsApp & Custom Order Links --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <a href="https://wa.me/6281383415432?text={{ urlencode('Halo Perfu.me, saya ingin memesan ' . $product->name . ' (30ml EDP, ' . $product->priceFormatted() . ').') }}"
                       target="_blank"
                       rel="noopener"
                       class="inline-flex items-center justify-center gap-2 border border-[#111111]/20 bg-white px-5 py-3 text-xs font-medium text-[#111111] uppercase tracking-widest transition hover:border-[#111111] hover:bg-[#f7f7f5]">
                        <svg class="h-4 w-4 fill-current text-[#111111]" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.816 9.816 0 0 0 12.04 2zm0 18.15c-1.49 0-2.95-.4-4.22-1.15l-.3-.18-3.12.82.83-3.04-.2-.32a8.196 8.196 0 0 1-1.26-4.38c0-4.54 3.7-8.24 8.24-8.24 2.2 0 4.27.86 5.82 2.42a8.18 8.18 0 0 1 2.41 5.83c.02 4.54-3.68 8.24-8.22 8.24zm4.52-6.16c-.25-.12-1.47-.72-1.69-.81-.23-.08-.39-.12-.56.12-.17.25-.64.81-.79.97-.14.17-.29.19-.54.06-.25-.12-1.05-.39-1.99-1.23-.74-.66-1.23-1.47-1.38-1.72-.14-.25-.02-.38.11-.51.11-.11.25-.29.37-.43.12-.14.17-.25.25-.41.08-.17.04-.31-.02-.43s-.56-1.34-.76-1.84c-.2-.48-.41-.42-.56-.43h-.48c-.17 0-.43.06-.66.31-.22.25-.86.84-.86 2.05s.88 2.38 1 2.55c.13.17 1.73 2.65 4.2 3.71.59.25 1.05.41 1.41.52.59.19 1.13.16 1.56.1.48-.07 1.47-.6 1.68-1.18.21-.58.21-1.07.15-1.18-.07-.12-.23-.19-.48-.31z"/>
                        </svg>
                        <span>Direct WhatsApp</span>
                    </a>

                    <a href="#enquire"
                       class="inline-flex items-center justify-center border border-[#111111]/20 bg-white px-5 py-3 text-xs font-medium text-[#111111] uppercase tracking-widest transition hover:border-[#111111] hover:bg-[#f7f7f5]">
                        <span>Order / Enquire Form &darr;</span>
                    </a>
                </div>
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
            $orderMessage = old('message', 'Halo Perfu.me, saya ingin memesan "' . $product->name . '" (30ml EDP, ' . $product->priceFormatted() . '). Mohon informasi ketersediaan dan pengirimannya.');
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
                                <span class="font-serif text-base sm:text-lg text-[#111111]">{{ $item->priceFormatted() }}</span>
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
