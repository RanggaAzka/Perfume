@extends('layouts.app')

@section('title', 'Contact Us — ' . config('app.name'))
@section('meta_description', 'Hubungi Perfu.me — konsultasi aroma signature, layanan refill counter, atau kunjungan langsung ke studio kami di Dramaga, Bogor.')

@section('content')

{{-- ============================================================
     HERO / HEADER
     ============================================================ --}}
<section class="mx-auto max-w-[1400px] px-6 sm:px-10 lg:px-16 pt-12 sm:pt-20 pb-10 sm:pb-12">
    <div class="reveal max-w-2xl">
        <p class="section-label">Contact</p>
        <h1 class="mt-4 font-serif text-3xl sm:text-4xl md:text-5xl lg:text-[62px] font-normal text-[#111111] leading-[1.08] tracking-tight">
            Connect with the House.
        </h1>
        <p class="mt-4 sm:mt-5 text-xs sm:text-sm text-[#111111]/70 leading-relaxed font-sans font-light">
            Jika Anda memiliki pertanyaan seputar parfum signature kami, memerlukan panduan pemilihan aroma refill, atau ingin mendiskusikan pesanan khusus — kami siap membantu Anda.
        </p>
    </div>
</section>

{{-- ============================================================
     MAIN CONTACT SECTION (SPLIT 2-COLUMN)
     ============================================================ --}}
<section class="mx-auto max-w-[1400px] px-6 sm:px-10 lg:px-16 pb-16 sm:pb-28">
    <div class="grid gap-10 lg:grid-cols-12 lg:gap-16 items-start">

        {{-- Left: Direct Channels & Studio Information --}}
        <div class="reveal lg:col-span-5 space-y-6 sm:space-y-8">

            {{-- WhatsApp Direct Quick Card --}}
            <div class="border border-[#111111]/10 bg-[#f7f7f5] p-6 sm:p-8 transition-all duration-300 hover:border-[#111111]/30">
                <span class="text-[11px] font-sans font-medium uppercase tracking-widest text-[#111111]/40">Instant Concierge</span>
                <h2 class="mt-2 font-serif text-2xl text-[#111111] font-normal">WhatsApp Direct</h2>
                <p class="mt-2 text-xs sm:text-sm text-[#111111]/70 font-sans font-light leading-relaxed">
                    Hubungi tim kami secara langsung untuk konsultasi aroma cepat, pengecekan stok, atau pemesanan langsung tanpa menunggu lama.
                </p>
                <div class="mt-6">
                    <a href="https://wa.me/6281383415432?text={{ urlencode('Halo Perfu.me, saya ingin berkonsultasi mengenai koleksi parfum Anda.') }}"
                       target="_blank"
                       rel="noopener"
                       class="inline-flex items-center gap-2 bg-[#111111] text-white px-6 py-3.5 text-xs font-medium uppercase tracking-widest transition hover:bg-black w-full sm:w-auto justify-center">
                        <svg class="h-3.5 w-3.5 fill-current shrink-0" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.816 9.816 0 0 0 12.04 2zm0 18.15c-1.49 0-2.95-.4-4.22-1.15l-.3-.18-3.12.82.83-3.04-.2-.32a8.196 8.196 0 0 1-1.26-4.38c0-4.54 3.7-8.24 8.24-8.24 2.2 0 4.27.86 5.82 2.42a8.18 8.18 0 0 1 2.41 5.83c.02 4.54-3.68 8.24-8.22 8.24zm4.52-6.16c-.25-.12-1.47-.72-1.69-.81-.23-.08-.39-.12-.56.12-.17.25-.64.81-.79.97-.14.17-.29.19-.54.06-.25-.12-1.05-.39-1.99-1.23-.74-.66-1.23-1.47-1.38-1.72-.14-.25-.02-.38.11-.51.11-.11.25-.29.37-.43.12-.14.17-.25.25-.41.08-.17.04-.31-.02-.43s-.56-1.34-.76-1.84c-.2-.48-.41-.42-.56-.43h-.48c-.17 0-.43.06-.66.31-.22.25-.86.84-.86 2.05s.88 2.38 1 2.55c.13.17 1.73 2.65 4.2 3.71.59.25 1.05.41 1.41.52.59.19 1.13.16 1.56.1.48-.07 1.47-.6 1.68-1.18.21-.58.21-1.07.15-1.18-.07-.12-.23-.19-.48-.31z"/>
                        </svg>
                        Chat +62 813-8341-5432
                    </a>
                </div>
            </div>

            {{-- Studio Details Grid --}}
            <div class="border border-[#111111]/10 bg-white p-6 sm:p-8 space-y-6">
                <div>
                    <span class="text-[11px] font-sans font-medium uppercase tracking-widest text-[#111111]/40">Studio Location</span>
                    <p class="mt-2 text-xs sm:text-sm text-[#111111] font-sans leading-relaxed">
                        {{ $siteSettings?->address ?: 'Jl. Lingkar Desa Dramaga RT 03 / 04, Desa Dramaga, Kec. Dramaga, Kab. Bogor, Jawa Barat 16680' }}
                    </p>
                </div>

                <div class="border-t border-[#111111]/10 pt-5">
                    <span class="text-[11px] font-sans font-medium uppercase tracking-widest text-[#111111]/40">Email Correspondence</span>
                    <p class="mt-2 text-xs sm:text-sm text-[#111111] font-sans">
                        <a href="mailto:{{ $siteSettings?->contact_email ?: 'perfumeofficial30@gmail.com' }}" class="underline hover:opacity-60 transition">
                            {{ $siteSettings?->contact_email ?: 'perfumeofficial30@gmail.com' }}
                        </a>
                    </p>
                </div>

                <div class="border-t border-[#111111]/10 pt-5">
                    <span class="text-[11px] font-sans font-medium uppercase tracking-widest text-[#111111]/40">Studio Hours</span>
                    <p class="mt-2 text-xs sm:text-sm text-[#111111] font-sans leading-relaxed">
                        {{ $siteSettings?->store_hours ?: 'Senin – Sabtu: 09:00 – 21:00 WIB' }}
                        <br>
                        <span class="text-[#111111]/50">Minggu: Tutup / Berdasarkan Janji Temu</span>
                    </p>
                </div>

                <div class="border-t border-[#111111]/10 pt-5">
                    @php
                        $instagramUrl = $siteSettings?->instagram_url ?: 'https://instagram.com/perfu.mefragrance';
                        $tiktokUrl    = $siteSettings?->tiktok_url    ?: 'https://tiktok.com/@perfu.mefragrance';
                        $instagramHandle = '@' . ltrim(basename(parse_url($instagramUrl, PHP_URL_PATH) ?: ''), '/@');
                        $tiktokHandle    = '@' . ltrim(basename(parse_url($tiktokUrl, PHP_URL_PATH) ?: ''), '/@');
                    @endphp
                    <span class="text-[11px] font-sans font-medium uppercase tracking-widest text-[#111111]/40">Social Channels</span>
                    <div class="mt-2 flex flex-wrap gap-4 text-xs font-sans">
                        <a href="{{ $instagramUrl }}" target="_blank" rel="noopener" class="underline hover:opacity-60 transition">
                            Instagram {{ $instagramHandle }}
                        </a>
                        <span class="text-[#111111]/30">·</span>
                        <a href="{{ $tiktokUrl }}" target="_blank" rel="noopener" class="underline hover:opacity-60 transition">
                            TikTok {{ $tiktokHandle }}
                        </a>
                    </div>
                </div>
            </div>

        </div>

        {{-- Right: Contact / Inquiry Form --}}
        <div class="reveal lg:col-span-7">
            <div class="border border-[#111111]/10 bg-white p-6 sm:p-10 lg:p-12">

                <div class="mb-8">
                    <span class="text-[11px] font-sans font-medium uppercase tracking-widest text-[#111111]/40">Send a Message</span>
                    <h2 class="mt-2 font-serif text-2xl sm:text-3xl text-[#111111] font-normal">
                        How can we help you?
                    </h2>
                    <p class="mt-2 text-xs sm:text-sm text-[#111111]/70 font-sans font-light">
                        Silakan tinggalkan pesan dan informasi kontak Anda di bawah ini. Kami akan membalas pesan Anda dalam waktu 1x24 jam.
                    </p>
                </div>

                <form method="POST" action="{{ route('contact.store') }}" class="space-y-6">
                    @csrf
                    <input type="hidden" name="type" value="contact">

                    {{-- Name --}}
                    <div>
                        <label for="name" class="block text-xs uppercase tracking-widest text-[#111111]/50 font-medium">Nama Lengkap *</label>
                        <input type="text"
                               name="name"
                               id="name"
                               value="{{ old('name') }}"
                               required
                               placeholder="e.g. Alex Pratama"
                               class="mt-2 w-full border border-[#111111]/20 bg-[#f7f7f5] px-4 py-3 text-xs text-[#111111] focus:border-[#111111] focus:bg-white focus:outline-none transition">
                        @error('name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>

                    {{-- Email & Phone Grid --}}
                    <div class="grid sm:grid-cols-2 gap-6">
                        <div>
                            <label for="email" class="block text-xs uppercase tracking-widest text-[#111111]/50 font-medium">Alamat Email *</label>
                            <input type="email"
                                   name="email"
                                   id="email"
                                   value="{{ old('email') }}"
                                   required
                                   placeholder="alex@example.com"
                                   class="mt-2 w-full border border-[#111111]/20 bg-[#f7f7f5] px-4 py-3 text-xs text-[#111111] focus:border-[#111111] focus:bg-white focus:outline-none transition">
                            @error('email') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-xs uppercase tracking-widest text-[#111111]/50 font-medium">Nomor WhatsApp *</label>
                            <input type="tel"
                                   name="phone"
                                   id="phone"
                                   value="{{ old('phone') }}"
                                   required
                                   placeholder="+62 8xx xxxx xxxx"
                                   class="mt-2 w-full border border-[#111111]/20 bg-[#f7f7f5] px-4 py-3 text-xs text-[#111111] focus:border-[#111111] focus:bg-white focus:outline-none transition">
                            @error('phone') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    {{-- Message --}}
                    <div>
                        <label for="message" class="block text-xs uppercase tracking-widest text-[#111111]/50 font-medium">Pesan Anda *</label>
                        <textarea name="message"
                                  id="message"
                                  rows="5"
                                  required
                                  placeholder="Tuliskan pertanyaan, konsultasi aroma, atau kebutuhan pesanan khusus Anda di sini..."
                                  class="mt-2 w-full border border-[#111111]/20 bg-[#f7f7f5] px-4 py-3 text-xs text-[#111111] focus:border-[#111111] focus:bg-white focus:outline-none transition">{{ old('message') }}</textarea>
                        @error('message') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit"
                            class="w-full bg-[#111111] text-white py-4 text-xs font-medium uppercase tracking-widest transition hover:bg-black">
                        Send Message &rarr;
                    </button>
                </form>

            </div>
        </div>

    </div>
</section>

{{-- ============================================================
     FREQUENTLY ASKED QUESTIONS / VISITING INFO
     ============================================================ --}}
<section class="border-t border-[#111111]/10 bg-[#f7f7f5] py-16 sm:py-24">
    <div class="mx-auto max-w-[1400px] px-6 sm:px-10 lg:px-16">

        <div class="reveal max-w-lg mb-12 sm:mb-14">
            <p class="section-label">Visiting &amp; Ordering</p>
            <h2 class="mt-3 font-serif text-3xl sm:text-4xl text-[#111111] font-normal leading-tight">
                Frequently Asked
            </h2>
        </div>

        <div class="grid gap-px bg-[#111111]/10 md:grid-cols-3">
            <div class="reveal bg-white p-6 sm:p-8 lg:p-10 flex flex-col justify-between">
                <div>
                    <span class="text-xs font-sans font-medium text-[#111111]/40 uppercase tracking-widest">01</span>
                    <h3 class="mt-4 font-serif text-lg sm:text-xl text-[#111111] font-normal">Can I sample scents at the studio?</h3>
                    <p class="mt-3 text-xs sm:text-sm leading-relaxed text-[#111111]/70 font-sans font-light">
                        Tentu saja. Pengunjung counter kami di Dramaga dipersilakan untuk mencoba seluruh varian signature Eau de Parfum dan mencium lebih dari 20+ aroma refill menggunakan test strip atau pada kulit.
                    </p>
                </div>
            </div>

            <div class="reveal bg-white p-6 sm:p-8 lg:p-10 flex flex-col justify-between">
                <div>
                    <span class="text-xs font-sans font-medium text-[#111111]/40 uppercase tracking-widest">02</span>
                    <h3 class="mt-4 font-serif text-lg sm:text-xl text-[#111111] font-normal">How do refills work?</h3>
                    <p class="mt-3 text-xs sm:text-sm leading-relaxed text-[#111111]/70 font-sans font-light">
                        Anda dapat membawa botol parfum kosong milik Anda sendiri atau memilih dari botol kaca eksklusif kami. Parfum akan ditakar dan diisikan langsung di tempat dengan harga mulai dari Rp 20.000.
                    </p>
                </div>
            </div>

            <div class="reveal bg-white p-6 sm:p-8 lg:p-10 flex flex-col justify-between">
                <div>
                    <span class="text-xs font-sans font-medium text-[#111111]/40 uppercase tracking-widest">03</span>
                    <h3 class="mt-4 font-serif text-lg sm:text-xl text-[#111111] font-normal">Do you offer custom or bulk orders?</h3>
                    <p class="mt-3 text-xs sm:text-sm leading-relaxed text-[#111111]/70 font-sans font-light">
                        Kami melayani suvenir pernikahan, kado perusahaan, hingga hampers acara spesial. Hubungi kami melalui form ini atau WhatsApp untuk pilihan ukuran dan kustomisasi label botol.
                    </p>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection
