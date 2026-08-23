<section class="border-y border-black/10 bg-[#f7f7f5]">
    <div class="mx-auto grid max-w-7xl gap-12 px-6 py-24 md:grid-cols-2 md:px-10">
        <div class="reveal">
            <img src="{{ asset('images/brand-story.svg') }}" alt="Perfume crafting"
                 loading="lazy" class="h-full w-full object-cover">
        </div>
        <div class="reveal flex flex-col justify-center">
            <p class="section-label">Philosophy</p>
            <h2 class="mt-3 font-serif text-4xl leading-tight">Made for the moments that matter.</h2>
            <p class="mt-6 max-w-md text-sm leading-relaxed text-ink/60">
                We started this house on a simple belief: exceptional fragrance shouldn't require an exceptional
                budget. Every bottle is composed with the same care as the world's most storied perfumers —
                just without the markup that comes from a famous name on the label.
            </p>
            <a href="{{ route('story') }}" class="mt-8 inline-block w-fit border-b border-ink pb-1 text-sm uppercase tracking-widest2 transition hover:text-gold hover:border-gold">
                Read Our Story
            </a>
        </div>
    </div>
</section>
