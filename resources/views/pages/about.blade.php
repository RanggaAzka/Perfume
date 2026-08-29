@extends('layouts.app')

@section('title', 'About Us — ' . config('app.name'))
@section('meta_description', 'Kenali kisah di balik Perfu.me — studio wewangian lokal asal Dramaga yang didirikan atas komitmen kualitas, karakter aroma khas, dan harga yang jujur.')

@section('content')

{{-- ============================================================
     HERO / ABOUT MAIN SECTION
     Layout directly inspired by user wireframe & home design system
     ============================================================ --}}
<section class="mx-auto max-w-[1400px] px-6 sm:px-10 lg:px-16 py-12 sm:py-20 lg:py-28">
    <div class="grid items-center gap-10 lg:grid-cols-12 lg:gap-16">

        {{-- Left: Bottle Image (from user sketch: images/about-us.png) --}}
        <div class="reveal lg:col-span-6 flex justify-center lg:justify-start">
            <div class="relative w-full max-w-[360px] sm:max-w-[440px] lg:max-w-[480px]">
                {{-- Clean subtle backdrop / frame --}}
                <div class="overflow-hidden bg-[#f7f7f5] p-3 sm:p-5 border border-[#111111]/10">
                    <img src="{{ asset('images/about-us.png') }}"
                         alt="Perfu.me Signature Fragrance"
                         class="w-full h-auto object-cover transition-transform duration-700 hover:scale-[1.02]">
                </div>
            </div>
        </div>

        {{-- Right: About Us Headline & Story Content --}}
        <div class="reveal lg:col-span-6 lg:pl-4 max-w-xl">
            <p class="section-label">About Us</p>

            <h1 class="mt-4 font-serif text-3xl sm:text-4xl md:text-5xl lg:text-[56px] font-normal text-[#111111] leading-[1.08] tracking-tight">
                Fragrance, without compromise.
            </h1>

            <div class="mt-6 space-y-4 text-xs sm:text-sm text-[#111111]/70 leading-relaxed font-sans font-light">
                <p>
                    Didirikan pada tahun 2023 di Dramaga, <strong class="text-[#111111] font-medium">Perfu.me</strong> lahir dari sebuah keyakinan sederhana: wewangian istimewa harus dinilai dari kemurnian racikan di dalam botol, bukan dari tingginya harga pada label.
                </p>
                <p>
                    Kami percaya bahwa setiap orang berhak tampil harum dan membawa rasa percaya diri yang nyata di setiap aktivitas. Dengan memadukan <em>fragrance oil</em> berkualitas tinggi dan alkohol <em>food-grade</em> melalui proses formulasi teliti dalam <em>small batches</em>, kami menciptakan aroma yang tahan lama, berkarakter, dan bernilai jujur.
                </p>
            </div>

            <div class="mt-8 pt-2">
                <a href="{{ route('products.index') }}"
                   class="inline-block text-xs font-medium tracking-wider text-[#111111] border-b border-[#111111] pb-1 transition hover:opacity-60 uppercase">
                    Discover Scents
                </a>
            </div>
        </div>

    </div>
</section>

{{-- ============================================================
     THE THREE PILLARS (CORE VALUES)
     Refined 3-column layout consistent with the home design tokens
     ============================================================ --}}
<section class="border-t border-[#111111]/10 bg-[#f7f7f5]">
    <div class="mx-auto max-w-[1400px] px-6 sm:px-10 lg:px-16 py-16 sm:py-24 lg:py-28">

        <div class="mb-12 sm:mb-14 reveal max-w-lg">
            <p class="section-label">Our Philosophy</p>
            <h2 class="mt-3 font-serif text-3xl sm:text-4xl text-[#111111] font-normal leading-tight">
                Built on honesty, craft, and character.
            </h2>
        </div>

        <div class="grid gap-px bg-[#111111]/10 md:grid-cols-3">
            @foreach ([
                [
                    'number' => '01',
                    'title' => 'Considered Composition',
                    'body' => 'Setiap note dipilih dengan niat dan keselarasan yang jelas — menggunakan fragrance oil konsentrasi tinggi dan alkohol food-grade yang aman. Tidak ada bahan yang ditambahkan sekadar untuk mengisi botol.'
                ],
                [
                    'number' => '02',
                    'title' => 'Honest Pricing',
                    'body' => 'Karakter aroma yang berkelas tanpa markup berlebihan selayaknya parfum desainer ternama. Kami menghadirkan nilai kemurnian racikan yang terjangkau untuk penggunaan sehari-hari.'
                ],
                [
                    'number' => '03',
                    'title' => 'Built for Confidence',
                    'body' => 'Diformulasikan untuk ketahanan aroma yang nyata dan proyeksi yang seimbang. Dirancang khusus untuk menemani gaya hidup aktif dan dinamis dari pagi hingga malam.'
                ],
            ] as $pillar)
                <div class="reveal bg-white p-6 sm:p-8 lg:p-10 flex flex-col justify-between transition-colors duration-300 hover:bg-[#fafafa]">
                    <div>
                        <span class="text-xs font-sans font-medium text-[#111111]/40 uppercase tracking-widest">{{ $pillar['number'] }}</span>
                        <h3 class="mt-4 font-serif text-xl sm:text-2xl text-[#111111] font-normal">{{ $pillar['title'] }}</h3>
                        <p class="mt-3 text-xs sm:text-sm leading-relaxed text-[#111111]/70 font-sans font-light">{{ $pillar['body'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>

{{-- ============================================================
     VISION & MISSION (BRAND IDENTITY)
     Editorial summary of the UMKM identity & purpose
     ============================================================ --}}
<section class="border-t border-[#111111]/10 bg-white">
    <div class="mx-auto max-w-[1400px] px-6 sm:px-10 lg:px-16 py-16 sm:py-24 lg:py-28">
        <div class="grid lg:grid-cols-12 gap-10 lg:gap-16 items-start">

            {{-- Left: Origin & Context --}}
            <div class="reveal lg:col-span-5">
                <p class="section-label">Brand Identity</p>
                <h2 class="mt-3 font-serif text-3xl sm:text-4xl text-[#111111] font-normal leading-tight">
                    Crafted in Dramaga,<br>worn everywhere.
                </h2>
                <p class="mt-4 text-xs sm:text-sm text-[#111111]/70 leading-relaxed font-sans font-light">
                    Perfu.me adalah studio wewangian lokal Indonesia yang berkomitmen mengangkat ekspresi diri harian melalui aroma yang berkarakter.
                </p>

                <div class="mt-6 sm:mt-8 border-t border-[#111111]/10 pt-6 space-y-3 text-xs text-[#111111]/60 font-sans">
                    <p><span class="text-[#111111] font-medium">Tahun Berdiri:</span> 2023</p>
                    <p><span class="text-[#111111] font-medium">Asal Studio:</span> Dramaga, Bogor, Indonesia</p>
                    <p><span class="text-[#111111] font-medium">Fokus Produk:</span> Eau de Parfum & Refill Perfumery</p>
                </div>
            </div>

            {{-- Right: Vision & Mission Blocks --}}
            <div class="reveal lg:col-span-7 space-y-6 sm:space-y-8">
                {{-- Vision --}}
                <div class="border border-[#111111]/10 p-6 sm:p-8 lg:p-10 bg-[#f7f7f5]">
                    <p class="section-label">Vision</p>
                    <h3 class="mt-2 font-serif text-xl sm:text-2xl text-[#111111] font-normal leading-snug">
                        Menjadi brand parfum lokal terkemuka yang dikenal luas atas karakter khas, kualitas yang tahan lama, dan kemewahan yang dapat dijangkau oleh semua kalangan.
                    </h3>
                </div>

                {{-- Mission --}}
                <div class="border border-[#111111]/10 p-6 sm:p-8 lg:p-10 bg-white">
                    <p class="section-label">Mission</p>
                    <ul class="mt-4 space-y-3 text-xs sm:text-sm text-[#111111]/70 font-sans font-light leading-relaxed">
                        <li class="flex items-start gap-3">
                            <span class="text-[#111111] font-medium">—</span>
                            <span>Menghadirkan parfum berkualitas tinggi dengan ketahanan optimal pada harga yang jujur dan transparan.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="text-[#111111] font-medium">—</span>
                            <span>Memberikan pengalaman aroma yang berkesan melalui perpaduan wangi yang personal dan mudah dikenali.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="text-[#111111] font-medium">—</span>
                            <span>Mendukung generasi muda untuk selalu melangkah maju dengan rasa percaya diri penuh di setiap momen kehidupan.</span>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection
