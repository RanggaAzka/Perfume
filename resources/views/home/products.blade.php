@php
    $vanessenceProduct = $featuredProducts->firstWhere('slug', 'vanessence') ?? $featuredProducts->first();
    $dynamystProduct = $featuredProducts->firstWhere('slug', 'dynamyst') ?? $featuredProducts->skip(1)->first();
@endphp

<section class="mx-auto max-w-[1400px] px-8 py-24 sm:px-12 sm:py-32 lg:px-16 lg:py-40">
    <div class="space-y-36 sm:space-y-44 lg:space-y-52">

        {{-- ITEM 1: VANESSENCE (Text Kiri, Visual Card Kanan) --}}
        <div class="grid items-center gap-16 lg:grid-cols-12">
            {{-- Sisi Kiri: Text --}}
            <div class="reveal lg:col-span-6 lg:pr-8">
                <h2 class="font-serif text-3xl sm:text-4xl lg:text-[54px] font-normal text-[#111111] leading-tight">
                    Vanessence.
                </h2>
                <p class="mt-5 text-xs sm:text-sm text-[#111111]/70 leading-relaxed font-sans font-light max-w-sm">
                    Parfum hangat dan elegan yang memadukan kelembutan vanilla, kesegaran teh hijau, dan sentuhan musk menjadi aroma menenangkan yang bertahan sepanjang hari.
                </p>
                <div class="mt-8">
                    <a href="{{ $vanessenceProduct ? route('products.show', $vanessenceProduct) : route('products.index') }}"
                       class="inline-block text-xs font-medium text-[#111111] border-b border-[#111111] pb-1 transition hover:opacity-60">
                        Discover Vanessence
                    </a>
                </div>
            </div>

            {{-- Sisi Kanan: Visual Card (Botol Besar Overlapping Box) --}}
            <div class="reveal lg:col-span-6 flex justify-center lg:justify-end">
                <div class="relative w-full max-w-[480px] pt-12 pb-6 pl-14 sm:pl-20">
                    {{-- Minimalist Outlined Box --}}
                    <div class="border border-[#111111] bg-white p-8 sm:p-10 pl-32 sm:pl-40 min-h-[300px] sm:min-h-[340px] flex flex-col justify-between">
                        <div>
                            <h3 class="font-serif text-2xl sm:text-3xl text-[#111111] font-normal">
                                Signature Notes
                            </h3>
                            <div class="mt-6 space-y-1 font-sans font-bold text-xl sm:text-2xl text-[#111111] leading-snug">
                                <p>Vanilla</p>
                                <p>Green Tea</p>
                                <p>Musk</p>
                            </div>
                        </div>

                        <div class="mt-8 pt-2">
                            <p class="text-xs text-[#111111] font-sans font-light">Longevity</p>
                            <p class="text-xs text-[#111111] tracking-widest mt-1" aria-label="5 out of 5 stars">&#9733;&#9733;&#9733;&#9733;&#9733;</p>
                        </div>
                    </div>

                    {{-- Bottle Image (Large, Overlapping Box Vertically & Horizontally) --}}
                    <div class="absolute -left-8 sm:-left-16 top-1/2 -translate-y-1/2 flex items-center">
                        <img src="{{ asset('images/vanessence.png') }}"
                             alt="Vanessence Bottle"
                             loading="lazy"
                             class="h-[400px] sm:h-[480px] md:h-[520px] max-w-none object-contain drop-shadow-[0_15px_25px_rgba(0,0,0,0.18)] transition-transform duration-500 hover:scale-105">
                    </div>
                </div>
            </div>
        </div>

        {{-- ITEM 2: DYNAMYST (Card Kiri, Text Kanan - Zigzag Layout) --}}
        <div class="grid items-center gap-16 lg:grid-cols-12">
            {{-- Sisi Kiri: Visual Card (Botol Besar Overlapping Box) --}}
            <div class="reveal lg:col-span-6 order-2 lg:order-1 flex justify-center lg:justify-start">
                <div class="relative w-full max-w-[480px] pt-12 pb-6 pl-14 sm:pl-20">
                    {{-- Minimalist Outlined Box --}}
                    <div class="border border-[#111111] bg-white p-8 sm:p-10 pl-32 sm:pl-40 min-h-[300px] sm:min-h-[340px] flex flex-col justify-between">
                        <div>
                            <h3 class="font-serif text-2xl sm:text-3xl text-[#111111] font-normal">
                                Signature Notes
                            </h3>
                            <div class="mt-6 space-y-1 font-sans font-bold text-xl sm:text-2xl text-[#111111] leading-snug">
                                <p>Citrus</p>
                                <p>Aquatic</p>
                                <p>Woody</p>
                            </div>
                        </div>

                        <div class="mt-8 pt-2">
                            <p class="text-xs text-[#111111] font-sans font-light">Longevity</p>
                            <p class="text-xs text-[#111111] tracking-widest mt-1" aria-label="5 out of 5 stars">&#9733;&#9733;&#9733;&#9733;&#9733;</p>
                        </div>
                    </div>

                    {{-- Bottle Image (Large, Overlapping Box Vertically & Horizontally) --}}
                    <div class="absolute -left-8 sm:-left-16 top-1/2 -translate-y-1/2 flex items-center">
                        <img src="{{ asset('images/dynamyst.png') }}"
                             alt="Dynamyst Bottle"
                             loading="lazy"
                             class="h-[400px] sm:h-[480px] md:h-[520px] max-w-none object-contain drop-shadow-[0_15px_25px_rgba(0,0,0,0.18)] transition-transform duration-500 hover:scale-105">
                    </div>
                </div>
            </div>

            {{-- Sisi Kanan: Text --}}
            <div class="reveal lg:col-span-6 lg:pl-8 order-1 lg:order-2">
                <h2 class="font-serif text-3xl sm:text-4xl lg:text-[54px] font-normal text-[#111111] leading-tight">
                    Dynamyst.
                </h2>
                <p class="mt-5 text-xs sm:text-sm text-[#111111]/70 leading-relaxed font-sans font-light max-w-sm">
                    Dirancang bagi mereka yang aktif dan dinamis, Dynamyst memadukan kesegaran citrus, aquatic accords, dan woody musk yang maskulin serta membangkitkan rasa percaya diri.
                </p>
                <div class="mt-8">
                    <a href="{{ $dynamystProduct ? route('products.show', $dynamystProduct) : route('products.index') }}"
                       class="inline-block text-xs font-medium text-[#111111] border-b border-[#111111] pb-1 transition hover:opacity-60">
                        Discover Dynamyst
                    </a>
                </div>
            </div>
        </div>

    </div>
</section>
