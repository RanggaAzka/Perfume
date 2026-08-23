<!-- <section class="mx-auto max-w-7xl px-6 py-24 md:px-10">
    <div class="reveal mb-14 max-w-lg">
        <p class="section-label">Fragrance</p>
        <h2 class="mt-3 font-serif text-4xl">What You'll Smell</h2>
    </div>

    <div class="grid grid-cols-2 gap-x-8 gap-y-10 md:grid-cols-6">
        @foreach ($signatureNotes as $note)
            <div class="reveal border-t border-black/10 pt-4">
                <p class="font-serif text-lg">{{ $note->name }}</p>
                <p class="mt-1 text-xs uppercase tracking-widest2 text-ink/40">{{ $note->products_count }} scent{{ $note->products_count === 1 ? '' : 's' }}</p>
            </div>
        @endforeach
    </div>

    <a href="{{ route('ingredients') }}"
       class="reveal mt-12 inline-block w-fit border-b border-ink/40 pb-1 text-sm text-ink transition hover:border-gold hover:text-gold">
        View The Fragrance Journal
    </a>
</section> -->
