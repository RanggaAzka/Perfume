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
                        <svg class="h-3.5 w-3.5 fill-current shrink-0" viewBox="0 0 24 24">
                            <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.312.045-.694.062-2.147-.533-1.859-.762-3.057-2.651-3.15-2.775-.093-.124-.753-.999-.753-1.908s.478-1.355.648-1.54c.17-.185.372-.232.496-.232.124 0 .248.001.357.006.113.006.264-.043.413.315.155.372.53 1.293.576 1.386.046.093.078.201.016.325-.062.124-.093.201-.186.31-.093.109-.196.243-.28.326-.093.093-.19.195-.082.381.109.186.483.796 1.037 1.289.714.636 1.315.834 1.501.927.186.093.294.078.403-.047.109-.124.465-.542.589-.728.124-.186.248-.155.418-.093.17.062 1.084.511 1.27.604.186.093.31.14.356.217.046.077.046.449-.098.854z"/>
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
                    <span class="text-[11px] font-sans font-medium uppercase tracking-widest text-[#111111]/40">Social Channels</span>
                    <div class="mt-2 flex flex-wrap gap-4 text-xs font-sans">
                        <a href="https://instagram.com/perfu.mefragrance" target="_blank" rel="noopener" class="underline hover:opacity-60 transition">
                            Instagram @perfu.mefragrance
                        </a>
                        <span class="text-[#111111]/30">·</span>
                        <a href="https://tiktok.com/@perfu.mefragrance" target="_blank" rel="noopener" class="underline hover:opacity-60 transition">
                            TikTok @perfu.mefragrance
                        </a>
                    </div>
                </div>
            </div>

        </div>

        {{-- Right: Contact / Inquiry Form --}}
        <div class="reveal lg:col-span-7">
            <div class="border border-[#111111]/10 bg-white p-6 sm:p-10 lg:p-12">

                @if (session('status'))
                    <div class="mb-8 border border-[#b79a5a]/40 bg-[#b79a5a]/10 p-4 text-xs sm:text-sm text-[#111111] flex items-center justify-between">
                        <span>{{ session('status') }}</span>
                        <span class="font-medium">✓</span>
                    </div>
                @endif

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
