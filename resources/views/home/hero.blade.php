@php
    $navLinks = [
        'about' => ['label' => 'About', 'url' => route('about')],
        'story' => ['label' => 'Story', 'url' => route('story')],
        'products' => ['label' => 'Products', 'url' => route('products.index')],
        'refills' => ['label' => 'Refills', 'url' => route('refills.index')],
        'contact' => ['label' => 'Contact', 'url' => route('contact.create')],
    ];
@endphp

<section class="relative w-full min-h-screen lg:h-screen lg:min-h-[800px] bg-white overflow-hidden flex flex-col justify-between">
    {{-- Dark Block Rectangle on Right Side (Full Height 100% top to bottom) --}}
    <div class="absolute right-0 top-0 bottom-0 h-full w-full lg:w-[37%] bg-[#363636] hidden lg:block pointer-events-none z-0"></div>

    {{-- Main Container (Full Height Flex layout: Logo at top, Headline in middle, Nav at bottom) --}}
    <div class="relative z-10 mx-auto w-full max-w-[1440px] h-full min-h-screen lg:min-h-[800px] flex flex-col justify-between px-8 py-8 sm:px-12 sm:py-10 lg:px-16 lg:py-12">
        {{-- Header / Logo --}}
        <div class="z-20">
            <a href="{{ route('home') }}" class="inline-block transition hover:opacity-80">
                <img src="{{ asset('images/Perfume.png') }}"
                     alt="Perfu.me"
                     class="h-9 sm:h-11 md:h-12 w-24 object-contain">
            </a>
        </div>

        {{-- Hero Content (Left) & Mobile Bottles --}}
        <div class="grid lg:grid-cols-12 items-center my-auto py-8 lg:py-0 z-20">
            {{-- Sisi Kiri: Headline & CTA --}}
            <div class="lg:col-span-6 max-w-lg">
                <h1 class="font-serif text-4xl sm:text-5xl md:text-6xl lg:text-[72px] font-normal text-[#111111] leading-[1.06] tracking-tight">
                    Smell Good, Feel Confident.
                </h1>
                <p class="mt-5 text-xs sm:text-sm text-[#111111]/70 leading-relaxed font-sans font-light max-w-sm">
                    Temukan parfum berkualitas dengan karakter aroma premium yang terjangkau, dirancang untuk menemani setiap momen percaya dirimu.
                </p>
                <div class="mt-8">
                    <a href="{{ route('products.index') }}"
                       class="inline-block text-xs tracking-wider text-[#111111] border-b border-[#111111] pb-1 transition hover:opacity-60 font-medium">
                        Discover Scents
                    </a>
                </div>
            </div>

            {{-- Mobile-only bottle display (Stacked below text on small screens) --}}
            <div class="lg:hidden mt-10 flex justify-center">
                <img src="{{ asset('images/hero-bottles.png') }}"
                     alt="Perfu.me Signature Bottles"
                     class="w-full max-w-[360px] object-contain drop-shadow-xl animate-float">
            </div>
        </div>

        {{-- Minimalist Bottom Navigation --}}
        <div class="z-20 pt-6">
            <nav class="flex items-center flex-wrap gap-8 sm:gap-10 text-xs text-[#111111]/80 font-sans tracking-wide">
                @foreach ($navLinks as $item)
                    <a href="{{ $item['url'] }}" class="transition hover:text-[#111111]">
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </nav>
        </div>
    </div>

    {{-- Desktop Floating Bottles (Centered across the split line boundary between white & dark shape) --}}
    <div class="hidden lg:flex absolute right-[16%] xl:right-[17%] top-1/2 -translate-y-1/2 z-10 pointer-events-none items-center justify-center">
        <img src="{{ asset('images/hero-bottles.png') }}"
             alt="Perfu.me Signature Bottles"
             class="w-[640px] xl:w-[760px] max-w-none object-contain drop-shadow-[0_20px_35px_rgba(0,0,0,0.35)] animate-float">
    </div>
</section>
