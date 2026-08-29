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

        <button type="button" data-mobile-toggle aria-expanded="false" aria-controls="mobile-menu"
                class="flex flex-col gap-1.5 md:hidden p-2">
            <span class="sr-only">Toggle menu</span>
            <span class="h-0.5 w-6 bg-[#111111]"></span>
            <span class="h-0.5 w-6 bg-[#111111]"></span>
            <span class="h-0.5 w-6 bg-[#111111]"></span>
        </button>
    </nav>

    <div id="mobile-menu" data-mobile-menu class="hidden flex-col gap-5 bg-white border-b border-[#E5E7EB] px-8 py-8 shadow-lg md:hidden">
        @foreach ($navLinks as $routeName => $label)
            <a href="{{ route($routeName) }}" class="text-sm font-medium tracking-wide text-[#111111]/80 hover:text-[#111111]">
                {{ $label }}
            </a>
        @endforeach
    </div>
</header>
