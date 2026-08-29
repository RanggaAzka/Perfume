<section class="mx-auto max-w-[1400px] px-8 py-24 sm:px-12 sm:py-32 lg:px-16 lg:py-36">
    <div class="grid items-center gap-12 lg:grid-cols-12">
        {{-- Sisi Kiri: Headline & Subtext --}}
        <div class="reveal lg:col-span-6 max-w-md">
            <h2 class="font-serif text-3xl sm:text-4xl lg:text-[52px] font-normal text-[#111111] leading-tight">
                Stay Connected.
            </h2>
            <p class="mt-4 text-xs sm:text-sm text-[#111111]/70 leading-relaxed font-sans font-light">
                Tetap terhubung dengan Perfu.me dan jadilah yang pertama mengetahui perilisan aroma baru, kisah kreasi, dan informasi spesial kami.
            </p>
        </div>

        {{-- Sisi Kanan: Form Minimalis --}}
        <div class="reveal lg:col-span-6 flex justify-center lg:justify-end">
            <form onsubmit="event.preventDefault(); this.querySelector('button').innerText = 'Terkirim ✓'; setTimeout(() => { this.reset(); this.querySelector('button').innerText = 'Send'; }, 2500);"
                  class="space-y-3 w-full max-w-md">
                <div>
                    <label for="newsletter_name" class="sr-only">Nama</label>
                    <input type="text"
                           id="newsletter_name"
                           name="name"
                           placeholder="Nama Anda"
                           required
                           class="w-full border border-[#888888] bg-white px-4 py-3 text-xs text-[#111111] placeholder:text-[#888888] focus:border-black focus:outline-none transition">
                </div>
                <div class="flex flex-col sm:flex-row gap-2">
                    <label for="newsletter_email" class="sr-only">Email</label>
                    <input type="email"
                           id="newsletter_email"
                           name="email"
                           placeholder="Alamat Email"
                           required
                           class="flex-1 border border-[#888888] bg-white px-4 py-3 text-xs text-[#111111] placeholder:text-[#888888] focus:border-black focus:outline-none transition">
                    <button type="submit"
                            class="bg-[#111111] hover:bg-black text-white px-8 py-3 text-xs font-medium tracking-wide transition duration-200">
                        Send
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
