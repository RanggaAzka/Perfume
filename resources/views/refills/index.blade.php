@extends('layouts.app')

@section('title', 'Refill Collection — ' . config('app.name'))
@section('meta_description', 'Jelajahi koleksi pilihan aroma parfum yang tersedia untuk pengisian ulang langsung di studio Perfu.me Dramaga.')

@section('content')

{{-- ============================================================
     HERO SECTION: REFILL INTRODUCTION & VISUAL
     ============================================================ --}}
<section class="mx-auto max-w-[1400px] px-6 sm:px-10 lg:px-16 pt-12 sm:pt-20 pb-12 sm:pb-16">
    <div class="grid items-center gap-10 lg:grid-cols-12 lg:gap-16">

        {{-- Left: Text & Pricing Strip --}}
        <div class="reveal lg:col-span-6 max-w-xl">
            <p class="section-label">Refill Counter</p>
            <h1 class="mt-4 font-serif text-3xl sm:text-4xl md:text-5xl lg:text-[62px] font-normal text-[#111111] leading-[1.08] tracking-tight">
                Refill Collection.
            </h1>
            <p class="mt-4 sm:mt-5 text-xs sm:text-sm text-[#111111]/70 leading-relaxed font-sans font-light">
                Solusi cerdas dan berkelanjutan untuk menikmati wewangian favoritmu setiap hari. Bawa kembali botol parfummu untuk diisi ulang di studio kami, atau pesan racikan refill segar dalam berbagai pilihan ukuran.
            </p>

            {{-- Bottle Sizes & Pricing Grid --}}
            <div class="mt-8 border border-[#111111]/10 bg-[#f7f7f5] p-5 sm:p-6">
                <span class="text-[11px] font-sans font-medium uppercase tracking-widest text-[#111111]/40">Daftar Ukuran &amp; Harga</span>
                <div class="mt-4 grid grid-cols-2 sm:grid-cols-4 gap-3 text-center">
                    @foreach ($bottleSizes as $ml => $price)
                        <div class="bg-white border border-[#111111]/10 p-3 flex flex-col justify-between">
                            <span class="font-sans text-xs text-[#111111]/60">{{ $ml }} ml</span>
                            <span class="mt-1 font-serif text-sm sm:text-base font-normal text-[#111111]">{{ $price }}</span>
                        </div>
                    @endforeach
                </div>
                <p class="mt-3 pt-3 border-t border-[#111111]/10 text-[11px] uppercase tracking-widest text-[#111111]/50 font-sans text-center">
                    Tarif Refill: Rp {{ number_format($pricePerMl, 0, ',', '.') }} / ml
                </p>
            </div>
        </div>

        {{-- Right: Studio Refill Station Photo & Bottle Inset --}}
        <div class="reveal lg:col-span-6 flex justify-center lg:justify-end">
            <div class="relative w-full max-w-[480px]">
                {{-- Travertine / Studio Station Image --}}
                <div class="overflow-hidden bg-[#f7f7f5] p-3 sm:p-4 border border-[#111111]/10">
                    <img src="{{ asset('images/refill-station.jpg') }}"
                         alt="Perfu.me Refill Station and Decanting Bar"
                         loading="lazy"
                         class="w-full h-[280px] sm:h-[340px] lg:h-[380px] object-cover transition-transform duration-700 hover:scale-[1.02]">
                </div>

                {{-- Inset Badge / Caption --}}
                <div class="mt-3 flex items-center justify-between text-[11px] text-[#111111]/50 font-sans">
                    <span>Perfu.me Decanting Bar — Dramaga, Bogor</span>
                    <span class="text-[#b79a5a] font-medium">20+ Varian Aroma</span>
                </div>
            </div>
        </div>

    </div>
</section>

{{-- ============================================================
     HOW IT WORKS: 3 STEPS
     ============================================================ --}}
<section class="border-y border-[#111111]/10 bg-[#f7f7f5] py-14 sm:py-20">
    <div class="mx-auto max-w-[1400px] px-6 sm:px-10 lg:px-16">

        <div class="reveal mb-10 sm:mb-12 max-w-lg">
            <p class="section-label">Cara Kerja</p>
            <h2 class="mt-3 font-serif text-2xl sm:text-3xl lg:text-4xl text-[#111111] font-normal leading-tight">
                Simple, Conscious, Accessible.
            </h2>
        </div>

        <div class="grid gap-px bg-[#111111]/10 md:grid-cols-3">
            <div class="reveal bg-white p-6 sm:p-8 flex flex-col justify-between">
                <div>
                    <span class="text-xs font-sans font-medium text-[#111111]/40 uppercase tracking-widest">Langkah 01</span>
                    <h3 class="mt-3 font-serif text-lg sm:text-xl text-[#111111] font-normal">Pilih Aroma Favorit</h3>
                    <p class="mt-2 text-xs sm:text-sm leading-relaxed text-[#111111]/70 font-sans font-light">
                        Pilih dari 20+ varian aroma inspirasi dunia yang terdaftar pada direktori kami di bawah ini.
                    </p>
                </div>
            </div>

            <div class="reveal bg-white p-6 sm:p-8 flex flex-col justify-between">
                <div>
                    <span class="text-xs font-sans font-medium text-[#111111]/40 uppercase tracking-widest">Langkah 02</span>
                    <h3 class="mt-3 font-serif text-lg sm:text-xl text-[#111111] font-normal">Tentukan Ukuran Botol</h3>
                    <p class="mt-2 text-xs sm:text-sm leading-relaxed text-[#111111]/70 font-sans font-light">
                        Bawa botol spray milikmu sendiri atau gunakan flacon kaca eksklusif yang tersedia di studio (15ml, 30ml, 45ml, 100ml).
                    </p>
                </div>
            </div>

            <div class="reveal bg-white p-6 sm:p-8 flex flex-col justify-between">
                <div>
                    <span class="text-xs font-sans font-medium text-[#111111]/40 uppercase tracking-widest">Langkah 03</span>
                    <h3 class="mt-3 font-serif text-lg sm:text-xl text-[#111111] font-normal">Pengisian Segar di Tempat</h3>
                    <p class="mt-2 text-xs sm:text-sm leading-relaxed text-[#111111]/70 font-sans font-light">
                        Parfum ditakar dan diisikan langsung menggunakan minyak wangi murni dan pelarut food-grade yang aman di kulit.
                    </p>
                </div>
            </div>
        </div>

    </div>
</section>

{{-- ============================================================
     REFILL DIRECTORY & REQUEST FORM
     ============================================================ --}}
<section class="mx-auto max-w-[1400px] px-6 sm:px-10 lg:px-16 py-16 sm:py-24">

    @if ($grouped->isEmpty())
        <div class="border border-[#111111]/10 bg-[#f7f7f5] p-12 sm:p-16 text-center">
            <p class="text-sm text-[#111111]/60">Varian aroma refill baru sedang disiapkan — silakan cek kembali segera.</p>
        </div>
    @else
        <div class="grid gap-12 lg:grid-cols-12 lg:gap-16 items-start">

            {{-- Left Column: Alphabetical Scents Directory --}}
            <div class="reveal lg:col-span-7">
                <div class="mb-6 flex items-baseline justify-between border-b border-[#111111]/10 pb-4">
                    <div>
                        <p class="section-label">Aroma Directory</p>
                        <h2 class="mt-1 font-serif text-2xl sm:text-3xl text-[#111111] font-normal">Daftar Pilihan Aroma</h2>
                    </div>
                    <span class="text-xs text-[#111111]/50 font-sans">Klik untuk memilih</span>
                </div>

                <div class="divide-y divide-[#111111]/10">
                    @foreach ($grouped as $letter => $refills)
                        <div class="grid gap-4 sm:gap-6 py-5 sm:py-6 sm:grid-cols-[50px_1fr] items-baseline">
                            <p class="font-serif text-3xl sm:text-4xl text-[#111111]/25 font-normal">{{ $letter }}</p>
                            <ul class="grid gap-2.5 sm:grid-cols-2">
                                @foreach ($refills as $refill)
                                    <li>
                                        <button type="button"
                                                data-refill="{{ $refill->name }}"
                                                class="refill-option group w-full text-left p-2.5 border border-transparent hover:border-[#111111]/10 hover:bg-[#f7f7f5] transition-all duration-200 flex items-center justify-between">
                                            <span class="font-serif text-base sm:text-lg text-[#111111] group-hover:text-[#b79a5a] transition">
                                                {{ $refill->name }}
                                            </span>
                                            <span class="text-[11px] text-[#111111]/30 group-hover:text-[#b79a5a] font-sans font-light opacity-0 group-hover:opacity-100 transition">
                                                Pilih &rarr;
                                            </span>
                                        </button>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Right Column: Refill Request Form (Sticky on desktop) --}}
            <div id="refill-request" class="reveal lg:col-span-5 sticky top-24">
                <div class="border border-[#111111]/10 bg-white p-6 sm:p-8 shadow-sm">
                    <form method="POST" action="{{ route('contact.store') }}" class="space-y-5">
                        @csrf
                        <input type="hidden" name="type" value="refill">

                        <div>
                            <span class="text-[11px] font-sans font-medium uppercase tracking-widest text-[#111111]/40">Order Online</span>
                            <h2 class="mt-1 font-serif text-2xl text-[#111111] font-normal">Request a Refill</h2>
                            <p class="mt-1 text-xs text-[#111111]/65 font-sans font-light">
                                Pilih aroma dari daftar di sebelah kiri atau ketikkan aroma yang Anda inginkan.
                            </p>
                            <div id="selected-refill-container" class="{{ old('selected_refill') ? '' : 'hidden' }} mt-3">
                                <span class="text-[11px] uppercase tracking-widest text-[#111111]/40 block mb-1">Aroma Terpilih:</span>
                                <span id="selected-refill"
                                      class="inline-block bg-[#b79a5a]/15 text-[#111111] px-3 py-1.5 text-xs font-medium border border-[#b79a5a]/40">
                                    {{ old('selected_refill') }}
                                </span>
                            </div>
                        </div>

                        <div>
                            <label for="name" class="block text-xs uppercase tracking-widest text-[#111111]/50 font-medium">Nama Lengkap *</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                   placeholder="e.g. Alex Pratama"
                                   class="mt-1.5 w-full border border-[#111111]/20 bg-[#f7f7f5] px-3.5 py-2.5 text-xs text-[#111111] focus:border-[#111111] focus:bg-white focus:outline-none transition">
                            @error('name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-xs uppercase tracking-widest text-[#111111]/50 font-medium">Alamat Email *</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                   placeholder="alex@example.com"
                                   class="mt-1.5 w-full border border-[#111111]/20 bg-[#f7f7f5] px-3.5 py-2.5 text-xs text-[#111111] focus:border-[#111111] focus:bg-white focus:outline-none transition">
                            @error('email') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-xs uppercase tracking-widest text-[#111111]/50 font-medium">Nomor WhatsApp *</label>
                            <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" required
                                   placeholder="+62 8xx xxxx xxxx"
                                   class="mt-1.5 w-full border border-[#111111]/20 bg-[#f7f7f5] px-3.5 py-2.5 text-xs text-[#111111] focus:border-[#111111] focus:bg-white focus:outline-none transition">
                            @error('phone') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="bottle_size" class="block text-xs uppercase tracking-widest text-[#111111]/50 font-medium">Ukuran Botol</label>
                            <select name="bottle_size" id="bottle_size"
                                    class="mt-1.5 w-full border border-[#111111]/20 bg-[#f7f7f5] px-3.5 py-2.5 text-xs text-[#111111] focus:border-[#111111] focus:bg-white focus:outline-none transition">
                                <option value="">Pilih ukuran botol (opsional)</option>
                                @foreach ($bottleSizes as $ml => $price)
                                    <option value="{{ $ml }}" @selected(old('bottle_size') == $ml)>{{ $ml }} ml — {{ $price }}</option>
                                @endforeach
                            </select>
                            @error('bottle_size') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <input type="hidden" name="selected_refill" value="{{ old('selected_refill') }}">

                        <div>
                            <label for="message" class="block text-xs uppercase tracking-widest text-[#111111]/50 font-medium">Pesan / Permintaan Refill *</label>
                            <textarea name="message" id="message" rows="3" required
                                      placeholder="Tuliskan varian aroma yang diinginkan atau detail pemesanan..."
                                      class="mt-1.5 w-full border border-[#111111]/20 bg-[#f7f7f5] px-3.5 py-2.5 text-xs text-[#111111] focus:border-[#111111] focus:bg-white focus:outline-none transition">{{ old('message') }}</textarea>
                            @error('message') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <button type="submit"
                                class="w-full bg-[#111111] text-white py-3.5 text-xs font-medium uppercase tracking-widest transition hover:bg-black">
                            Send Refill Request &rarr;
                        </button>
                    </form>

                    {{-- Add to Cart (separate form, no checkout fields required) --}}
                    <form method="POST" action="{{ route('cart.add') }}" class="mt-6 space-y-4 border-t border-[#111111]/10 pt-6">
                        @csrf
                        <input type="hidden" name="type" value="refill">
                        <input type="hidden" name="refill_name" id="refill_name" value="{{ old('selected_refill') }}">

                        <div>
                            <span class="text-[11px] font-sans font-medium uppercase tracking-widest text-[#b79a5a]">Order Lebih dari Satu?</span>
                            <p class="mt-1 text-xs text-[#111111]/65 font-sans font-light">
                                Tambahkan refill ini ke keranjang untuk digabung dengan pesanan lain, lalu checkout sekali.
                            </p>
                        </div>

                        <div class="grid grid-cols-2 gap-3 items-end">
                            <div>
                                <label for="cart_bottle_size" class="block text-xs uppercase tracking-widest text-[#111111]/50 font-medium">Ukuran Botol *</label>
                                <select name="bottle_size" id="cart_bottle_size" required
                                        class="mt-1.5 w-full border border-[#111111]/20 bg-[#f7f7f5] px-3.5 py-2.5 text-xs text-[#111111] focus:border-[#111111] focus:bg-white focus:outline-none transition">
                                    <option value="">Pilih ukuran</option>
                                    @foreach ($bottleSizes as $ml => $price)
                                        <option value="{{ $ml }}">{{ $ml }} ml — {{ $price }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs uppercase tracking-widest text-[#111111]/50 font-medium">Jumlah *</label>
                                <div class="mt-1.5 flex h-[38px] items-center justify-between border border-[#111111]/20 bg-[#f7f7f5] px-2">
                                    <button type="button"
                                            onclick="const input = this.parentNode.querySelector('input'); input.value = Math.max(1, parseInt(input.value || '1', 10) - 1);"
                                            class="h-7 w-7 text-sm font-medium text-[#111111] transition hover:bg-[#111111] hover:text-white flex items-center justify-center select-none"
                                            aria-label="Kurangi jumlah">&minus;</button>
                                    <input type="number" name="quantity" id="cart_quantity" value="1" min="1" max="99" readonly aria-label="Jumlah"
                                           class="w-8 border-0 bg-transparent p-0 text-center text-xs font-semibold text-[#111111] focus:ring-0 select-none [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                                    <button type="button"
                                            onclick="const input = this.parentNode.querySelector('input'); input.value = Math.min(99, parseInt(input.value || '1', 10) + 1);"
                                            class="h-7 w-7 text-sm font-medium text-[#111111] transition hover:bg-[#111111] hover:text-white flex items-center justify-center select-none"
                                            aria-label="Tambah jumlah">+</button>
                                </div>
                            </div>
                        </div>

                        @error('refill_name')
                            <p class="text-xs text-red-600">{{ $message }}</p>
                        @enderror

                        <button type="submit" data-cart-submit
                                class="group/btn w-full inline-flex items-center justify-center gap-2 bg-[#111111] text-white hover:bg-[#b79a5a] py-3.5 text-xs font-medium uppercase tracking-widest transition-all duration-300 shadow-sm">
                            <svg class="h-4 w-4 transition-transform duration-200 group-hover/btn:scale-110" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
                                <line x1="3" y1="6" x2="21" y2="6"/>
                                <path d="M16 10a4 4 0 0 1-8 0"/>
                            </svg>
                            <span>+ Tambahkan ke Keranjang</span>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    @endif

    <div class="mt-16 border-t border-[#111111]/10 pt-8 text-xs sm:text-sm text-[#111111]/60 font-sans flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <p>Ketersediaan aroma refill dapat berubah sewaktu-waktu. Kunjungi counter kami di Dramaga atau hubungi kami untuk informasi aroma tertentu.</p>
        <a href="{{ route('contact.create') }}" class="shrink-0 text-xs font-medium tracking-wider text-[#111111] border-b border-[#111111] pb-1 transition hover:opacity-50 uppercase">
            Contact Us &rarr;
        </a>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var options = document.querySelectorAll('.refill-option');
        if (!options.length) return;

        var messageField = document.getElementById('message');
        var indicator = document.getElementById('selected-refill');
        var container = document.getElementById('selected-refill-container');
        var hiddenRefill = document.querySelector('input[name="selected_refill"]');
        var cartRefill = document.getElementById('refill_name');
        var sizeField = document.getElementById('bottle_size');
        var form = indicator ? indicator.closest('form') : null;
        var current = '';

        function selectedSize() {
            return sizeField && sizeField.value ? sizeField.value : '';
        }

        function composeMessage(name) {
            var size = selectedSize();
            return size
                ? 'Halo Perfu.me, saya ingin memesan refill untuk varian "' + name + '" — ukuran ' + size + ' ml.'
                : 'Halo Perfu.me, saya ingin memesan refill untuk varian "' + name + '".';
        }

        function updateIndicator(name) {
            if (!indicator) return;
            var size = selectedSize();
            indicator.textContent = name + (size ? ' \u00B7 ' + size + ' ml' : '');
            if (container) container.classList.remove('hidden');
        }

        function selectRefill(name) {
            current = name;
            options.forEach(function (btn) {
                if (btn.dataset.refill === name) {
                    btn.classList.add('bg-[#b79a5a]/10', 'border-[#b79a5a]/40');
                } else {
                    btn.classList.remove('bg-[#b79a5a]/10', 'border-[#b79a5a]/40');
                }
            });

            messageField.value = composeMessage(name);
            updateIndicator(name);

            if (hiddenRefill) {
                hiddenRefill.value = name;
            }

            if (cartRefill) {
                cartRefill.value = name;
            }

            if (window.innerWidth < 1024 && form) {
                form.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
            messageField.focus();
        }

        options.forEach(function (btn) {
            btn.addEventListener('click', function () {
                selectRefill(this.dataset.refill);
            });
        });

        if (sizeField) {
            sizeField.addEventListener('change', function () {
                if (!current) return;
                messageField.value = composeMessage(current);
                updateIndicator(current);
            });
        }
    });
</script>

@endsection
