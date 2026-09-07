@php
    $isHome = request()->routeIs('home');
    $navLinks = [
        'home' => 'Home',
        'about' => 'About',
        'story' => 'Story',
        'products.index' => 'Products',
        'refills.index' => 'Refills',
        'contact.create' => 'Contact',
    ];
    $cartCount = app(\App\Services\CartService::class)->count();
@endphp

<header class="{{ $isHome ? 'absolute inset-x-0 top-0 z-40 lg:hidden' : 'sticky top-0 z-40 border-b border-[#E5E7EB] bg-white/95 backdrop-blur' }}">
    <nav class="mx-auto flex max-w-7xl items-center justify-between px-6 py-5 sm:px-10 lg:px-16">
        @if (! $isHome)
            <a href="{{ route('home') }}" class="inline-block transition hover:opacity-80">
                <img src="{{ asset('images/Perfume.png') }}" alt="{{ config('app.name') }}" class="h-5 sm:h-6 object-contain">
            </a>
        @else
            <span></span>
        @endif

        @if (! $isHome)
            <div class="hidden items-center gap-8 md:flex text-xs uppercase tracking-widest text-[#111111]/70 font-medium">
                @foreach ($navLinks as $routeName => $label)
                    <a href="{{ route($routeName) }}"
                       class="transition hover:text-[#111111] {{ request()->routeIs($routeName) ? 'text-[#111111] font-semibold' : '' }}">
                        {{ $label }}
                    </a>
                @endforeach
            </div>
        @endif

        <div class="flex items-center gap-3 sm:gap-5">
            @if (! $isHome)
                <button type="button" data-cart-open
                        aria-label="Buka keranjang"
                        aria-controls="cart-drawer"
                        class="group relative inline-flex items-center justify-center p-2 text-[#111111]/80 transition hover:text-[#111111]">
                    <svg class="h-5 w-5 transition-transform duration-200 group-hover:scale-105" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
                        <line x1="3" y1="6" x2="21" y2="6"/>
                        <path d="M16 10a4 4 0 0 1-8 0"/>
                    </svg>
                    <span data-cart-count
                          class="absolute -top-1 -right-1.5 inline-flex h-[18px] min-w-[18px] items-center justify-center rounded-full bg-[#b79a5a] px-1 text-[9px] font-semibold text-white shadow-sm {{ $cartCount > 0 ? '' : 'hidden' }}">
                        {{ $cartCount > 99 ? '99+' : $cartCount }}
                    </span>
                </button>
            @endif

            <button type="button" data-mobile-toggle aria-expanded="false" aria-controls="mobile-menu"
                    class="flex flex-col gap-1.5 md:hidden p-2">
                <span class="sr-only">Toggle menu</span>
                <span class="h-0.5 w-6 bg-[#111111]"></span>
                <span class="h-0.5 w-6 bg-[#111111]"></span>
                <span class="h-0.5 w-6 bg-[#111111]"></span>
            </button>
        </div>
    </nav>

    <div id="mobile-menu" data-mobile-menu class="hidden flex-col gap-5 bg-white border-b border-[#E5E7EB] px-8 py-8 shadow-lg md:hidden">
        @foreach ($navLinks as $routeName => $label)
            <a href="{{ route($routeName) }}" class="text-sm font-medium tracking-wide text-[#111111]/80 hover:text-[#111111]">
                {{ $label }}
            </a>
        @endforeach
    </div>
</header>
