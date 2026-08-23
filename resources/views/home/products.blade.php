<section class="mx-auto max-w-7xl px-6 py-20 md:px-10 md:py-28">
    <div class="space-y-24 md:space-y-32">
        @foreach ($featuredProducts as $product)
            @php $reversed = $loop->index % 2 === 1; @endphp

            <div class="grid items-center gap-16 md:grid-cols-2 md:gap-14">
                {{-- Text column --}}
                <div class="reveal {{ $reversed ? 'md:order-2' : '' }}">
                    @if ($product->fragrance_family)
                        <p class="text-xs uppercase tracking-widest2 text-ink/40">{{ $product->fragrance_family }}</p>
                    @endif
                    <h3 class="mt-2 font-serif text-4xl italic">{{ $product->name }}.</h3>
                    <p class="mt-5 max-w-sm text-sm leading-relaxed text-ink/60">
                        {{ $product->short_description }}
                    </p>
                    <a href="{{ route('products.show', $product) }}"
                       class="mt-6 inline-block w-fit border-b border-ink/40 pb-1 text-sm text-ink transition hover:border-gold hover:text-gold">
                        Discover {{ $product->name }}
                    </a>
                </div>

                {{-- Layered visual: bottle (upper-left) with a Signature Notes card overlapping lower-right --}}
                <div class="reveal relative h-[380px] md:h-[460px] {{ $reversed ? 'md:order-1' : '' }}">
                    <img src="{{ $product->imageUrl() }}" alt="{{ $product->name }}" loading="lazy"
                         class="absolute left-0 top-0 h-[72%] w-[58%] object-contain drop-shadow-xl transition duration-700 hover:scale-105">

                    <div class="absolute bottom-0 right-0 w-[64%] border border-black/10 bg-white p-7 md:p-9">
                        <p class="text-xs uppercase tracking-wide text-ink/40">Signature Notes</p>
                        <ul class="mt-4 space-y-1 font-serif text-xl leading-snug md:text-2xl">
                            @forelse ($product->fragranceNotes as $note)
                                <li>{{ $note->name }}</li>
                            @empty
                                <li class="text-ink/30">&mdash;</li>
                            @endforelse
                        </ul>
                        <p class="mt-5 text-xs uppercase tracking-wide text-ink/40">Longevity</p>
                        <p class="mt-1 text-ink" aria-label="{{ $product->longevity }}">&#9733;&#9733;&#9733;&#9733;&#9733;</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
