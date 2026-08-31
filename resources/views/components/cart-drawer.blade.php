@php
    $cartItems = app(\App\Services\CartService::class);
    $items = $cartItems->items();
    $subtotal = $cartItems->subtotal();
    $cartCount = $cartItems->count();
    $autoOpen = session('cart_open') === true
        || $errors->hasAny(['name', 'email', 'phone', 'message', 'cart']);
@endphp

{{-- ============================================================
     CART DRAWER (slide-over from the right)
     ============================================================ --}}
<div id="cart-drawer" data-cart-drawer @if ($autoOpen) data-cart-open-on-load="1" @endif
     class="fixed inset-0 z-50 hidden" aria-hidden="true">

    {{-- Backdrop: blur + dim the page behind the drawer --}}
    <div data-cart-backdrop class="absolute inset-0 bg-black/30 backdrop-blur-sm"></div>

    {{-- Panel --}}
    <div role="dialog" aria-modal="true" aria-labelledby="cart-drawer-title" data-cart-panel
         class="absolute right-0 top-0 flex h-full w-full max-w-md translate-x-full flex-col bg-white shadow-2xl transition-transform duration-300 ease-out">

        {{-- Header --}}
        <div class="flex items-center justify-between border-b border-[#111111]/10 px-6 py-5">
            <div>
                <p class="section-label">Your Order</p>
                <h2 id="cart-drawer-title" class="mt-1 font-serif text-2xl text-[#111111] font-normal">Keranjang</h2>
            </div>
            <div class="flex items-center gap-4">
                @if ($cartCount > 0)
                    <a href="{{ route('products.index') }}" data-cart-tambah-link
                       class="text-[11px] uppercase tracking-widest text-[#111111]/50 hover:text-[#111111] transition">
                        Tambah
                    </a>
                @endif
                <button type="button" data-cart-close aria-label="Tutup keranjang"
                        class="flex h-9 w-9 items-center justify-center border border-[#111111]/20 text-[#111111] transition hover:border-[#111111]">
                    <svg class="h-4 w-4 fill-current" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M18.3 5.71 12 12l6.3 6.29-1.41 1.42L10.59 13.4 6.3 17.71 4.89 16.29 11.17 12l-6.28-6.29L6.3 4.29l4.29 4.3 6-6.3L18.3 5.71z"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Body --}}
        <div id="cart-drawer-body" class="flex-1 overflow-y-auto">
            @if ($cartCount > 0)
                <div class="px-6 py-6 divide-y divide-[#111111]/10">
                    @foreach ($items as $line)
                        <div class="py-5 flex flex-col gap-4" data-line-key="{{ $line['key'] }}">
                            <div class="flex items-start justify-between gap-4">
                                <div class="min-w-0">
                                    <p class="font-serif text-base text-[#111111] leading-snug">
                                        @if ($line['url'])
                                            <a href="{{ $line['url'] }}" class="transition hover:text-[#b79a5a]">{{ $line['label'] }}</a>
                                        @else
                                            {{ $line['label'] }}
                                        @endif
                                    </p>
                                    <p class="mt-1 text-[11px] uppercase tracking-widest text-[#111111]/50 font-sans">
                                        {{ $line['size_label'] }}
                                        @if ($line['type'] === 'refill') Refill @else Eau de Parfum @endif
                                    </p>
                                    @if (! $line['available'])
                                        <p class="mt-2 text-[11px] text-red-600 font-sans font-medium">Item tidak lagi tersedia.</p>
                                    @endif
                                </div>

                                <form method="POST" action="{{ route('cart.remove', $line['key']) }}"
                                      data-cart-remove-form
                                      onsubmit="return confirm('Hapus item ini dari keranjang?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" data-cart-remove aria-label="Hapus {{ $line['label'] }}"
                                            class="text-xs text-[#111111]/40 hover:text-red-600 transition uppercase tracking-wider">
                                        Hapus
                                    </button>
                                </form>
                            </div>

                            <div class="flex items-center justify-between">
                                @if ($line['available'])
                                    <form method="POST" action="{{ route('cart.update', $line['key']) }}" class="flex items-center gap-2">
                                        @csrf
                                        @method('PATCH')
                                        <button type="button" data-cart-dec data-target="#cdr-qty-{{ Str::slug($line['key'], '-') }}"
                                                class="h-7 w-7 border border-[#111111]/20 text-[#111111] text-sm transition hover:border-[#111111]">&minus;</button>
                                        <span data-qty-display class="w-8 text-center text-sm font-medium text-[#111111]">{{ $line['quantity'] }}</span>
                                        <button type="button" data-cart-inc data-target="#cdr-qty-{{ Str::slug($line['key'], '-') }}"
                                                class="h-7 w-7 border border-[#111111]/20 text-[#111111] text-sm transition hover:border-[#111111]">+</button>
                                        <input type="hidden" name="quantity" id="cdr-qty-{{ Str::slug($line['key'], '-') }}" value="{{ $line['quantity'] }}">
                                    </form>
                                @endif

                                <div class="text-right">
                                    <p data-line-subtotal class="font-serif text-base text-[#111111]">
                                        {{ $line['available'] ? 'Rp ' . number_format($line['subtotal'], 0, ',', '.') : '—' }}
                                    </p>
                                    <p class="text-[11px] text-[#111111]/40 font-sans">
                                        {{ $line['available'] ? 'Rp ' . number_format($line['unit_price'], 0, ',', '.') . ' / pc' : '' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Subtotal --}}
                <div class="border-t border-[#111111]/10 px-6 py-5">
                    <div class="flex items-center justify-between">
                        <span class="text-xs uppercase tracking-widest text-[#111111]/50 font-sans font-medium">Subtotal</span>
                        <span data-cart-subtotal class="font-serif text-2xl text-[#111111]">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                    @if ($items->where('available', false)->isNotEmpty())
                        <p class="mt-2 text-[11px] text-red-600 font-sans">
                            Item tidak tersedia tidak ikut dihitung — hapus atau sesuaikan sebelum checkout.
                        </p>
                    @endif
                </div>

                {{-- Checkout form --}}
                <div class="border-t border-[#111111]/10 px-6 py-6">
                    <form method="POST" action="{{ route('cart.checkout') }}" class="space-y-4">
                        @csrf

                        @if ($errors->hasAny(['name', 'email', 'phone', 'message', 'cart']))
                            <div class="border border-red-500/40 bg-red-500/10 p-3 text-xs text-[#111111]">
                                <ul class="list-inside list-disc space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div>
                            <label for="cdr-name" class="block text-xs uppercase tracking-widest text-[#111111]/50 font-medium">Nama Lengkap *</label>
                            <input type="text" name="name" id="cdr-name" value="{{ old('name') }}" required
                                   placeholder="e.g. Alex Pratama"
                                   class="mt-1.5 w-full border border-[#111111]/20 bg-[#f7f7f5] px-3.5 py-2.5 text-xs text-[#111111] focus:border-[#111111] focus:bg-white focus:outline-none transition">
                        </div>

                        <div>
                            <label for="cdr-email" class="block text-xs uppercase tracking-widest text-[#111111]/50 font-medium">Alamat Email *</label>
                            <input type="email" name="email" id="cdr-email" value="{{ old('email') }}" required
                                   placeholder="alex@example.com"
                                   class="mt-1.5 w-full border border-[#111111]/20 bg-[#f7f7f5] px-3.5 py-2.5 text-xs text-[#111111] focus:border-[#111111] focus:bg-white focus:outline-none transition">
                        </div>

                        <div>
                            <label for="cdr-phone" class="block text-xs uppercase tracking-widest text-[#111111]/50 font-medium">Nomor WhatsApp *</label>
                            <input type="tel" name="phone" id="cdr-phone" value="{{ old('phone') }}" required
                                   placeholder="+62 8xx xxxx xxxx"
                                   class="mt-1.5 w-full border border-[#111111]/20 bg-[#f7f7f5] px-3.5 py-2.5 text-xs text-[#111111] focus:border-[#111111] focus:bg-white focus:outline-none transition">
                        </div>

                        <div>
                            <label for="cdr-message" class="block text-xs uppercase tracking-widest text-[#111111]/50 font-medium">Catatan Tambahan (opsional)</label>
                            <textarea name="message" id="cdr-message" rows="2"
                                      placeholder="Alamat pengiriman, waktu pengambilan, atau detail lainnya..."
                                      class="mt-1.5 w-full border border-[#111111]/20 bg-[#f7f7f5] px-3.5 py-2.5 text-xs text-[#111111] focus:border-[#111111] focus:bg-white focus:outline-none transition">{{ old('message') }}</textarea>
                        </div>

                        <button type="submit"
                                class="w-full bg-[#111111] text-white py-3.5 text-xs font-medium uppercase tracking-widest transition hover:bg-black">
                            Kirim Permintaan Pesanan &rarr;
                        </button>
                    </form>
                </div>
            @else
                @include('components.cart-drawer-empty')
            @endif
        </div>
    </div>
</div>