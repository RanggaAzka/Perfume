@php
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

<section class="relative overflow-hidden bg-ink md:grid md:grid-cols-2 md:bg-white">
    <div class="relative z-10 flex min-h-[640px] flex-col justify-between gap-10 px-6 pb-10 pt-8 text-white md:min-h-[760px] md:px-16 md:pb-12 md:pt-10 md:text-ink">
        <a href="{{ route('home') }}" class="font-serif text-2xl italic tracking-wide">
            {{ config('app.name') }}
        </a>

        <div class="flex flex-col gap-5">
            <h1 class="font-serif text-5xl leading-[1.05] md:text-7xl">
                Smell Good.<br>Feel Confident.
            </h1>
            <p class="max-w-sm text-sm leading-relaxed text-white/70 md:text-ink/60">
                Discover affordable fragrances with premium character, designed for every moment.
            </p>
            <a href="{{ route('products.index') }}"
               class="mt-2 inline-block w-fit border-b border-current pb-1 text-sm transition hover:border-gold hover:text-gold">
                Discover Scents
            </a>
        </div>

        <nav class="hidden gap-8 md:flex">
            @foreach ($navLinks as $routeName => $label)
                <a href="{{ route($routeName) }}"
                   class="text-sm text-ink/60 transition hover:text-gold {{ request()->routeIs($routeName) ? 'text-gold' : '' }}">
                    {{ $label }}
                </a>
            @endforeach
        </nav>
    </div>

    <div class="relative min-h-[420px] bg-gradient-to-br from-ink to-black md:min-h-[760px]">
        <img src="{{ asset('images/hero-bottles.svg') }}" alt="Vanessence and Dynamyst perfume bottles"
             class="absolute inset-0 z-0 h-full w-full object-cover object-center md:-left-14 md:w-[calc(100%+3.5rem)]">
    </div>
</section>
