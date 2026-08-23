@php
    $isHome = request()->routeIs('home');
    $navLinks = [
        'home' => 'Home',
        'about' => 'About',
        'story' => 'Story',
        'products.index' => 'Collection',
        'refills.index' => 'Refill',
        // 'ingredients' => 'Ingredients',
        'contact.create' => 'Contact',
    ];
@endphp

<header class="{{ $isHome ? 'absolute inset-x-0 top-0 z-40' : 'sticky top-0 z-40 border-b border-black/5 bg-white/90 backdrop-blur' }}">
    <nav class="mx-auto flex max-w-7xl items-center justify-between px-6 py-6 md:px-10 lg:px-16">
        @unless ($isHome)
            <a href="{{ route('home') }}" class="font-serif text-2xl italic tracking-wide text-ink">
                {{ config('app.name') }}
            </a>
        @else
            <span></span>
        @endunless

        @unless ($isHome)
            <div class="hidden items-center gap-10 md:flex">
                @foreach ($navLinks as $routeName => $label)
                    <a href="{{ route($routeName) }}"
                       class="text-sm text-ink/60 transition hover:text-gold {{ request()->routeIs($routeName) ? 'text-gold' : '' }}">
                        {{ $label }}
                    </a>
                @endforeach
            </div>
        @endunless

        <button type="button" data-mobile-toggle aria-expanded="false" aria-controls="mobile-menu"
                class="flex flex-col gap-1.5 md:hidden">
            <span class="sr-only">Toggle menu</span>
            <span class="h-px w-7 {{ $isHome ? 'bg-white' : 'bg-ink' }}"></span>
            <span class="h-px w-7 {{ $isHome ? 'bg-white' : 'bg-ink' }}"></span>
        </button>
    </nav>

    <div id="mobile-menu" data-mobile-menu class="hidden flex-col gap-6 bg-white px-8 py-10 shadow-lg md:hidden">
        @foreach ($navLinks as $routeName => $label)
            <a href="{{ route($routeName) }}" class="text-sm text-ink/80">{{ $label }}</a>
        @endforeach
    </div>
</header>
