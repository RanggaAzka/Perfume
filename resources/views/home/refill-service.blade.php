<section class="border-y border-black/10 bg-ink px-6 py-24 text-center text-white md:px-10">
    <p class="section-label text-white/50">Refill Service</p>
    <h2 class="reveal mx-auto mt-4 max-w-2xl font-serif text-4xl leading-tight md:text-5xl">
        Refill your favorite scent.
    </h2>
    <p class="mx-auto mt-6 max-w-md text-sm leading-relaxed text-white/60">
        A curated selection of fragrances available for refill at our store.
    </p>

    @if ($siteSettings && ($siteSettings->address || $siteSettings->store_hours))
        <p class="mx-auto mt-4 max-w-md text-xs uppercase tracking-widest2 text-white/40">
            {{ collect([$siteSettings->address, $siteSettings->store_hours])->filter()->join(' · ') }}
        </p>
    @endif

    <div class="mt-10 flex flex-wrap items-center justify-center gap-8">
        <a href="{{ route('refills.index') }}"
           class="border-b border-white/40 pb-1 text-sm transition hover:border-gold hover:text-gold">
            Explore Collection
        </a>
        <a href="{{ route('contact.create') }}"
           class="border-b border-white/40 pb-1 text-sm transition hover:border-gold hover:text-gold">
            Contact Us
        </a>
    </div>
</section>
