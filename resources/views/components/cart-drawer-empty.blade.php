<div class="flex h-full flex-col items-center justify-center px-8 text-center">
    <p class="font-serif text-xl text-[#111111]">Keranjang Anda masih kosong.</p>
    <p class="mt-2 text-xs text-[#111111]/60 font-sans font-light">
        Tambahkan signature fragrance atau aroma refill favorit Anda.
    </p>
    <div class="mt-6 flex flex-col gap-3">
        <a href="{{ route('products.index') }}"
           class="bg-[#111111] text-white px-8 py-3 text-xs font-medium uppercase tracking-widest transition hover:bg-black">
            Explore Products
        </a>
        <a href="{{ route('refills.index') }}"
           class="border border-[#111111]/20 bg-white px-8 py-3 text-xs font-medium text-[#111111] uppercase tracking-widest transition hover:border-[#111111]">
            Explore Refills
        </a>
    </div>
</div>