<section class="mx-auto max-w-7xl px-6 py-24 md:px-10">
    <div class="grid gap-12 md:grid-cols-[1fr_1.3fr] md:items-start">
        <div class="reveal">
            <p class="section-label">Refill Collection</p>
            <h2 class="mt-3 font-serif text-4xl leading-tight">Beyond our signature scents.</h2>
            <p class="mt-6 max-w-sm text-sm leading-relaxed text-ink/60">
                Beyond our signature fragrances, discover a curated selection of scents available for refill
                in-store — a rotating directory of familiar names, always on hand.
            </p>
            <a href="{{ route('refills.index') }}"
               class="mt-8 inline-block w-fit border-b border-ink/40 pb-1 text-sm text-ink transition hover:border-gold hover:text-gold">
                Explore Refill Collection
            </a>
        </div>

        <div class="reveal">
            @if ($refillPreview->isEmpty())
                <p class="text-sm text-ink/50">New refill fragrances are being added soon.</p>
            @else
                <ul class="grid grid-cols-2 gap-x-8 gap-y-4 border-t border-black/10 pt-8 sm:grid-cols-3">
                    @foreach ($refillPreview as $refill)
                        <li class="font-serif text-lg leading-snug">{{ $refill->name }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</section>
