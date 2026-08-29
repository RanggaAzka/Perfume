<section class="mx-auto max-w-[1400px] px-8 py-24 sm:px-12 sm:py-32 lg:px-16 lg:py-40 overflow-hidden">
    <div class="grid lg:grid-cols-12 gap-12 lg:gap-14 items-center">
        {{-- Sisi Kiri: Headline & Deskripsi --}}
        <div class="reveal lg:col-span-4 max-w-md">
            <h2 class="font-serif text-3xl sm:text-4xl lg:text-[54px] font-normal text-[#111111] leading-tight">
                Refill Collection
            </h2>
            <p class="mt-5 text-xs sm:text-sm text-[#111111]/70 leading-relaxed font-sans font-light">
                Jelajahi berbagai pilihan aroma yang terinspirasi dari parfum legendaris dunia. Temukan wangi yang sesuai dengan suasana hati, karakter gaya, dan setiap momen harimu.
            </p>

            {{-- Carousel Navigation Buttons (Desktop) --}}
            <div class="hidden sm:flex items-center gap-3 mt-8">
                <button type="button"
                        onclick="document.getElementById('refill-carousel').scrollBy({ left: -310, behavior: 'smooth' })"
                        aria-label="Previous Refills"
                        class="h-9 w-9 border border-[#111111]/30 hover:border-[#111111] flex items-center justify-center text-[#111111] transition hover:bg-[#111111] hover:text-white">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                </button>
                <button type="button"
                        onclick="document.getElementById('refill-carousel').scrollBy({ left: 310, behavior: 'smooth' })"
                        aria-label="Next Refills"
                        class="h-9 w-9 border border-[#111111]/30 hover:border-[#111111] flex items-center justify-center text-[#111111] transition hover:bg-[#111111] hover:text-white">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- Sisi Kanan: Dynamic Refill Cards Horizontal Carousel --}}
        <div class="lg:col-span-8 overflow-hidden">
            <div id="refill-carousel"
                 class="reveal flex overflow-x-auto gap-6 sm:gap-7 pb-6 pt-2 scroll-smooth snap-x snap-mandatory cursor-grab active:cursor-grabbing [scrollbar-width:none] [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden">
                @forelse ($refillPreview as $refill)
                    <div class="shrink-0 w-[230px] sm:w-[260px] lg:w-[280px] snap-start bg-[#333333] text-white p-7 sm:p-8 flex flex-col items-center justify-between text-center min-h-[380px] sm:min-h-[420px] transition-transform duration-300 hover:-translate-y-1 select-none">
                        {{-- Refill Bottle Image --}}
                        <div class="my-auto py-4 flex justify-center items-center">
                            <img src="{{ asset('images/refill-bottle.png') }}"
                                 alt="{{ $refill->name }} Refill Bottle"
                                 loading="lazy"
                                 draggable="false"
                                 class="h-48 sm:h-56 object-contain drop-shadow-[0_14px_22px_rgba(0,0,0,0.55)] pointer-events-none">
                        </div>

                        {{-- Card Info (Nama dari Database) --}}
                        <div class="w-full pt-4 space-y-1">
                            <h3 class="font-sans text-sm sm:text-base text-white font-medium truncate" title="{{ $refill->name }}">
                                {{ $refill->name }}
                            </h3>
                            <p class="text-[11px] text-white/70 font-light pt-1">Longevity</p>
                            <p class="text-[11px] text-white tracking-widest" aria-label="5 out of 5 stars">&#9733;&#9733;&#9733;&#9733;&#9733;</p>
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center text-sm text-[#111111]/50">
                        No refills available at the moment.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</section>
