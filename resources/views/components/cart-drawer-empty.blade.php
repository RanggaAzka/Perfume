<div class="flex h-full flex-col items-center justify-center px-8 py-16 text-center">
    <div class="mb-5 flex h-16 w-16 items-center justify-center rounded-full bg-[#f7f7f5] border border-[#111111]/10 text-[#b79a5a]">
        <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
            <line x1="3" y1="6" x2="21" y2="6"/>
            <path d="M16 10a4 4 0 0 1-8 0"/>
        </svg>
    </div>

    <h3 class="font-serif text-2xl text-[#111111] font-normal">Keranjang Anda masih kosong.</h3>
    <p class="mt-2 text-xs sm:text-sm text-[#111111]/60 font-sans font-light max-w-xs leading-relaxed">
        Belum ada item dalam pilihan Anda. Jelajahi signature fragrance atau aroma refill favorit kami.
    </p>

    <div class="mt-8 flex w-full max-w-xs flex-col gap-3">
        <a href="{{ route('products.index') }}"
           class="w-full bg-[#111111] text-white px-6 py-3.5 text-xs font-medium uppercase tracking-widest transition hover:bg-[#b79a5a] text-center">
            Explore Collection &rarr;
        </a>
        <a href="{{ route('refills.index') }}"
           class="w-full border border-[#111111]/20 bg-white px-6 py-3 text-xs font-medium text-[#111111] uppercase tracking-widest transition hover:border-[#111111] hover:bg-[#f7f7f5] text-center">
            Explore Refill Station
        </a>
    </div>
</div>