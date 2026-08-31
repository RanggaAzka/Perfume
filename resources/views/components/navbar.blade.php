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
            <button type="button" data-cart-open
                    aria-label="Buka keranjang"
                    aria-controls="cart-drawer"
                    class="relative inline-flex items-center justify-center p-1.5 text-[#111111]/80 transition hover:text-[#111111]">
                <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M7 4c-1.105 0-2 .895-2 2 0 .552-.448 1-1 1s-1-.448-1-1C3 3.344 4.344 2 6 2h1c2.21 0 4 1.586 4 3.43V6h9.603c.697 0 1.198.703.978 1.371l-1.652 5.955c-.347 1.248-1.481 2.06-2.781 2.06H10.854l-.477 2h7.64c1.179 0 2.135.956 2.135 2.135 0 1.548-1.255 2.803-2.803 2.803H12c-1.893 0-3.62-.976-4.525-2.5H6.5C4.007 18.003 2 15.996 2 13.5v-8c0-1.379 1.121-2.5 2.5-2.5H7zm1 6.5v-3C8 5.673 7.327 5 6.5 5S5 5.673 5 6.5v3C5 10.327 5.673 11 6.5 11s1.5-.673 1.5-1.5zM6.5 13l2 2-2 2H12a4.5 4.5 0 0 0 4.5-4.5V13H6.5z"/>
                </svg>
                <span data-cart-count
                      class="absolute -top-1 -right-1 inline-flex h-4 w-4 items-center justify-center rounded-full bg-[#b79a5a] text-[9px] font-semibold text-white {{ $cartCount > 0 ? '' : 'hidden' }}">
                    {{ $cartCount > 99 ? '99+' : $cartCount }}
                </span>
            </button>

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
