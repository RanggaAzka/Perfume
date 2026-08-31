@if (session('status'))
<div id="success-modal" data-success-modal data-success-open-on-load
     class="fixed inset-0 z-[60] hidden items-center justify-center p-4" aria-hidden="true">

    <div data-success-backdrop class="absolute inset-0 bg-black/30 backdrop-blur-sm"></div>

    <div role="dialog" aria-modal="true" aria-labelledby="success-modal-title" data-success-panel
         class="relative w-full max-w-md border border-[#111111]/10 bg-white p-8 sm:p-10 text-center shadow-2xl">

        <span class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-[#b79a5a]/15">
            <svg class="h-7 w-7 text-[#b79a5a]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M20 6 9 17l-5-5"/>
            </svg>
        </span>

        <h2 id="success-modal-title" class="mt-5 font-serif text-2xl text-[#111111] font-normal">Terima Kasih</h2>

        <p class="mt-3 text-xs sm:text-sm text-[#111111]/70 font-sans font-light leading-relaxed">
            {{ session('status') }}
        </p>

        <button type="button" data-success-close aria-label="Tutup"
                class="mt-7 w-full bg-[#111111] text-white py-3.5 text-xs font-medium uppercase tracking-widest transition hover:bg-black">
            OK
        </button>
    </div>
</div>
@endif
