@extends('layouts.app')

@section('title', 'Our Story — ' . config('app.name'))
@section('meta_description', 'Perjalanan Perfu.me — bagaimana studio wewangian lokal di Dramaga meracik aroma signature dengan keahlian formulasi, karakter khas, dan harga yang jujur.')

@section('content')

{{-- ============================================================
     STORY HERO / OPENING
     ============================================================ --}}
<section class="mx-auto max-w-[1400px] px-6 sm:px-10 lg:px-16 pt-12 sm:pt-20 pb-12 sm:pb-16 text-center">
    <div class="reveal max-w-3xl mx-auto">
        <p class="section-label">Our Story</p>
        <h1 class="mt-4 font-serif text-3xl sm:text-4xl md:text-5xl lg:text-[62px] font-normal text-[#111111] leading-[1.08] tracking-tight">
            A brand built around the idea that fragrance is personal.
        </h1>
        <p class="mt-6 text-xs sm:text-sm text-[#111111]/70 leading-relaxed font-sans font-light max-w-xl mx-auto">
            Dari formulasi batch kecil di Dramaga hingga racikan aroma khas yang dikenakan setiap hari — temukan bagaimana Perfu.me mendefinisikan kembali kemewahan aroma yang dapat dijangkau.
        </p>
    </div>
</section>

{{-- ============================================================
     CHAPTER 01: THE GENESIS / CRAFT
     Grid: Text Left, Generated Studio Craft Image Right
     ============================================================ --}}
<section class="mx-auto max-w-[1400px] px-6 sm:px-10 lg:px-16 py-12 sm:py-20 lg:py-24 border-t border-[#111111]/10">
    <div class="grid items-center gap-10 lg:grid-cols-12 lg:gap-16">

        {{-- Left: Text --}}
        <div class="reveal lg:col-span-6 max-w-xl">
            <span class="text-xs font-sans font-medium text-[#111111]/40 uppercase tracking-widest">Chapter 01</span>
            <h2 class="mt-3 font-serif text-3xl sm:text-4xl lg:text-[44px] font-normal text-[#111111] leading-tight">
                The Question That Started It All
            </h2>
            <div class="mt-6 space-y-4 text-xs sm:text-sm text-[#111111]/70 leading-relaxed font-sans font-light">
                <p>
                    Perjalanan kami berawal di tahun 2023 dengan sebuah pertanyaan sederhana: <em class="text-[#111111]">mengapa wewangian berkualitas tinggi sering kali harus disertai harga yang sangat mahal?</em>
                </p>
                <p>
                    Seringkali, industri parfum konvensional menghabiskan lebih banyak biaya untuk promosi dan kemasan mewah dibandingkan kualitas formula di dalam botolnya. Para pendiri kami bertekad membuktikan bahwa karakter, keahlian racikan, dan ketahanan wangi yang nyata tidak memerlukan markup yang berlebihan.
                </p>
                <p>
                    Dari studio kami di Dramaga, Bogor, kami mendedikasikan fokus penuh pada formulasi: memilih <em>fragrance oil</em> grade premium, memanfaatkan alkohol <em>food-grade</em> yang aman di kulit, serta menyempurnakan <em>fixative</em> agar aromanya bertahan konsisten sepanjang hari.
                </p>
            </div>
        </div>

        {{-- Right: Studio Craft Image --}}
        <div class="reveal lg:col-span-6 flex justify-center lg:justify-end">
            <div class="relative w-full max-w-[480px]">
                <div class="overflow-hidden bg-[#f7f7f5] p-3 sm:p-4 border border-[#111111]/10">
                    <img src="{{ asset('images/story-craft.jpg') }}"
                         alt="Perfu.me Crafting Atelier and Formulation Lab"
                         loading="lazy"
                         class="w-full h-auto object-cover transition-transform duration-700 hover:scale-[1.02]">
                </div>
                <p class="mt-3 text-[11px] text-[#111111]/40 font-sans tracking-wide">
                    Atelier Perfu.me — tempat di mana setiap note ditimbang, diuji, dan diracik dengan presisi.
                </p>
            </div>
        </div>

    </div>
</section>

{{-- ============================================================
     PULL QUOTE / INTERLUDE
     ============================================================ --}}
<section class="border-y border-[#111111]/10 bg-[#f7f7f5] py-16 sm:py-24">
    <div class="reveal mx-auto max-w-[900px] px-6 sm:px-10 text-center">
        <span class="font-serif text-3xl sm:text-4xl text-[#111111]/30">“</span>
        <blockquote class="mt-2 font-serif text-xl sm:text-2xl md:text-3xl lg:text-4xl text-[#111111] font-normal leading-snug">
            Fragrance should never be kept on a shelf as an untouchable luxury. It is made to be lived in, leaving a quiet trace of your presence wherever you go.
        </blockquote>
        <div class="mt-6 flex items-center justify-center gap-3">
            <div class="h-px w-6 sm:w-8 bg-[#111111]/20"></div>
            <p class="text-xs uppercase tracking-widest text-[#111111]/60 font-sans font-medium">Abdul Fikri, Founder</p>
            <div class="h-px w-6 sm:w-8 bg-[#111111]/20"></div>
        </div>
    </div>
</section>

{{-- ============================================================
     CHAPTER 02: THE TWO SIGNATURES
     Grid: Generated Botanical Notes Image Left, Text Right (Zigzag)
     ============================================================ --}}
<section class="mx-auto max-w-[1400px] px-6 sm:px-10 lg:px-16 py-12 sm:py-20 lg:py-24">
    <div class="grid items-center gap-10 lg:grid-cols-12 lg:gap-16">

        {{-- Left: Botanical Notes Image --}}
        <div class="reveal lg:col-span-6 order-2 lg:order-1 flex justify-center lg:justify-start">
            <div class="relative w-full max-w-[480px]">
                <div class="overflow-hidden bg-[#f7f7f5] p-3 sm:p-4 border border-[#111111]/10">
                    <img src="{{ asset('images/story-botanicals.jpg') }}"
                         alt="Raw Botanical Fragrance Ingredients"
                         loading="lazy"
                         class="w-full h-auto object-cover transition-transform duration-700 hover:scale-[1.02]">
                </div>
                <p class="mt-3 text-[11px] text-[#111111]/40 font-sans tracking-wide">
                    Bahan baku botani alami: Bourbon vanilla, daun teh hijau, kesegaran bergamot citrus, dan serutan kayu cedarwood.
                </p>
            </div>
        </div>

        {{-- Right: Text --}}
        <div class="reveal lg:col-span-6 order-1 lg:order-2 lg:pl-4 max-w-xl">
            <span class="text-xs font-sans font-medium text-[#111111]/40 uppercase tracking-widest">Chapter 02</span>
            <h2 class="mt-3 font-serif text-3xl sm:text-4xl lg:text-[44px] font-normal text-[#111111] leading-tight">
                Two Scents. Endless Moods.
            </h2>
            <div class="mt-6 space-y-4 text-xs sm:text-sm text-[#111111]/70 leading-relaxed font-sans font-light">
                <p>
                    Perjalanan kami dimulai dengan dua kreasi signature yang saling melengkapi, masing-masing disempurnakan melalui puluhan tahap uji racikan sebelum siap hadir di dalam botol:
                </p>
                <div class="space-y-3 pt-2">
                    <div class="border-l-2 border-[#111111] pl-4">
                        <h3 class="font-serif text-base text-[#111111] font-normal">Vanessence</h3>
                        <p class="mt-1 text-xs text-[#111111]/70 font-sans leading-relaxed">
                            Lahir dari filosofi bahwa kehangatan tidak perlu bersuara keras. Perpaduan menenangkan antara creamy vanilla, teh hijau yang menyegarkan, dan kelembutan floral musk.
                        </p>
                    </div>
                    <div class="border-l-2 border-[#111111]/30 pl-4">
                        <h3 class="font-serif text-base text-[#111111] font-normal">Dynamyst</h3>
                        <p class="mt-1 text-xs text-[#111111]/70 font-sans leading-relaxed">
                            Diciptakan untuk jiwa dinamis yang selalu bergerak maju. Kesegaran citrus yang berenergi dan aroma aquatic yang bersih, bertumpu pada dasar woody musk yang maskulin.
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

{{-- ============================================================
     CHAPTER 03: THE REFILL COUNTER & SUSTAINABILITY
     3-Card Minimalist Strip
     ============================================================ --}}
<section class="border-t border-[#111111]/10 bg-[#f7f7f5] py-16 sm:py-24 lg:py-28">
    <div class="mx-auto max-w-[1400px] px-6 sm:px-10 lg:px-16">

        <div class="mb-12 sm:mb-14 reveal max-w-lg">
            <p class="section-label">Chapter 03</p>
            <h2 class="mt-3 font-serif text-3xl sm:text-4xl text-[#111111] font-normal leading-tight">
                Everyday Rediscovery & Refill
            </h2>
            <p class="mt-3 text-xs sm:text-sm text-[#111111]/70 font-sans font-light leading-relaxed">
                Selain koleksi signature, Perfu.me menghadirkan layanan refill counter khusus yang dirancang untuk fleksibilitas aroma harian dan gaya hidup yang lebih berkelanjutan.
            </p>
        </div>

        <div class="grid gap-px bg-[#111111]/10 md:grid-cols-3">
            <div class="reveal bg-white p-6 sm:p-8 lg:p-10 flex flex-col justify-between">
                <div>
                    <span class="text-xs font-sans font-medium text-[#111111]/40 uppercase tracking-widest">01</span>
                    <h3 class="mt-4 font-serif text-xl text-[#111111] font-normal">Curated Directory</h3>
                    <p class="mt-3 text-xs sm:text-sm leading-relaxed text-[#111111]/70 font-sans font-light">
                        Lebih dari 20+ varian aroma terinspirasi dari keluarga wangi fresh, floral, oriental, dan woody — disesuaikan untuk setiap suasana hati dan momen pentingmu.
                    </p>
                </div>
            </div>

            <div class="reveal bg-white p-6 sm:p-8 lg:p-10 flex flex-col justify-between">
                <div>
                    <span class="text-xs font-sans font-medium text-[#111111]/40 uppercase tracking-widest">02</span>
                    <h3 class="mt-4 font-serif text-xl text-[#111111] font-normal">Conscious Refilling</h3>
                    <p class="mt-3 text-xs sm:text-sm leading-relaxed text-[#111111]/70 font-sans font-light">
                        Gunakan kembali botol spray favoritmu untuk mengurangi limbah kemasan sekali pakai, mendukung kebiasaan berkelanjutan tanpa mengurangi kualitas wangi.
                    </p>
                </div>
            </div>

            <div class="reveal bg-white p-6 sm:p-8 lg:p-10 flex flex-col justify-between">
                <div>
                    <span class="text-xs font-sans font-medium text-[#111111]/40 uppercase tracking-widest">03</span>
                    <h3 class="mt-4 font-serif text-xl text-[#111111] font-normal">Accessible Daily Wear</h3>
                    <p class="mt-3 text-xs sm:text-sm leading-relaxed text-[#111111]/70 font-sans font-light">
                        Harga refill mulai dari Rp 20.000 memudahkan siapa saja untuk bereksplorasi dan memiliki rotasi wangi harian yang variatif.
                    </p>
                </div>
            </div>
        </div>

    </div>
</section>

{{-- ============================================================
     CLOSING CTA
     ============================================================ --}}
<section class="border-t border-[#111111]/10 bg-white py-16 sm:py-24 text-center">
    <div class="reveal mx-auto max-w-xl px-6 sm:px-10">
        <p class="section-label">Explore</p>
        <h2 class="mt-3 font-serif text-3xl sm:text-4xl text-[#111111] font-normal leading-tight">
            Find the scent that speaks for you.
        </h2>
        <p class="mt-4 text-xs sm:text-sm text-[#111111]/70 leading-relaxed font-sans font-light">
            Jelajahi koleksi Eau de Parfum signature kami dan temukan aroma yang menyempurnakan rasa percaya dirimu setiap hari.
        </p>
        <div class="mt-8 flex flex-wrap items-center justify-center gap-4 sm:gap-6">
            <a href="{{ route('products.index') }}"
               class="inline-block text-xs font-medium tracking-wider text-[#111111] border-b border-[#111111] pb-1 transition hover:opacity-60 uppercase">
                Explore The Collection
            </a>
            <a href="{{ route('about') }}"
               class="inline-block text-xs font-medium tracking-wider text-[#111111]/50 border-b border-[#111111]/30 pb-1 transition hover:text-[#111111] hover:border-[#111111] uppercase">
                About The House
            </a>
        </div>
    </div>
</section>

@endsection
