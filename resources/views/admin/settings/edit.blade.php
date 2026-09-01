@extends('layouts.admin')

@section('title', 'Global Settings & Integration')

@section('content')
    <div class="max-w-4xl space-y-8">
        <form method="POST" action="{{ route('admin.settings.update') }}" class="space-y-8">
            @csrf
            @method('PUT')

            {{-- General Site Configuration --}}
            <div class="border border-[#111111]/10 bg-white p-6 sm:p-8 shadow-sm space-y-6">
                <div class="border-b border-[#111111]/10 pb-4">
                    <p class="section-label">General Storefront</p>
                    <h2 class="mt-1 font-serif text-xl text-[#111111] font-normal">Identitas & Kontak Brand</h2>
                    <p class="mt-1 text-xs text-[#111111]/50 font-sans font-light">
                        Data kontak dan alamat yang diisi di sini akan otomatis tampil di footer web publik dan kontak WhatsApp concierge.
                    </p>
                </div>

                <div class="grid gap-6 sm:grid-cols-2">
                    <div>
                        <label for="site_name" class="block text-xs uppercase tracking-widest text-[#111111]/50 font-medium">Nama Brand / Website</label>
                        <input type="text" name="site_name" id="site_name" value="{{ old('site_name', $settings->site_name) }}"
                               placeholder="{{ config('app.name') }}"
                               class="mt-1.5 w-full border border-[#111111]/20 bg-[#f7f7f5] px-4 py-3 text-xs text-[#111111] focus:border-[#111111] focus:bg-white focus:outline-none transition">
                        @error('site_name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="contact_email" class="block text-xs uppercase tracking-widest text-[#111111]/50 font-medium">Email Resmi Customer Service</label>
                        <input type="email" name="contact_email" id="contact_email" value="{{ old('contact_email', $settings->contact_email) }}"
                               placeholder="concierge@perfu.me"
                               class="mt-1.5 w-full border border-[#111111]/20 bg-[#f7f7f5] px-4 py-3 text-xs text-[#111111] focus:border-[#111111] focus:bg-white focus:outline-none transition">
                        @error('contact_email') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid gap-6 sm:grid-cols-2">
                    <div>
                        <label for="contact_phone" class="block text-xs uppercase tracking-widest text-[#111111]/50 font-medium">Nomor Telepon / Hotline</label>
                        <input type="text" name="contact_phone" id="contact_phone" value="{{ old('contact_phone', $settings->contact_phone) }}"
                               placeholder="+62 813-8341-5432"
                               class="mt-1.5 w-full border border-[#111111]/20 bg-[#f7f7f5] px-4 py-3 text-xs text-[#111111] focus:border-[#111111] focus:bg-white focus:outline-none transition">
                        @error('contact_phone') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="store_hours" class="block text-xs uppercase tracking-widest text-[#111111]/50 font-medium">Jam Operasional Toko</label>
                        <input type="text" name="store_hours" id="store_hours" value="{{ old('store_hours', $settings->store_hours) }}"
                               placeholder="Senin–Minggu, 10:00–21:00 WIB"
                               class="mt-1.5 w-full border border-[#111111]/20 bg-[#f7f7f5] px-4 py-3 text-xs text-[#111111] focus:border-[#111111] focus:bg-white focus:outline-none transition">
                        @error('store_hours') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label for="address" class="block text-xs uppercase tracking-widest text-[#111111]/50 font-medium">Alamat Butik / Offline Store</label>
                    <input type="text" name="address" id="address" value="{{ old('address', $settings->address) }}"
                           placeholder="Jl. Senopati No. 45, Kebayoran Baru, Jakarta Selatan"
                           class="mt-1.5 w-full border border-[#111111]/20 bg-[#f7f7f5] px-4 py-3 text-xs text-[#111111] focus:border-[#111111] focus:bg-white focus:outline-none transition">
                    @error('address') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div class="grid gap-6 sm:grid-cols-2">
                    <div>
                        <label for="instagram_url" class="block text-xs uppercase tracking-widest text-[#111111]/50 font-medium">Tautan Akun Instagram</label>
                        <input type="url" name="instagram_url" id="instagram_url" value="{{ old('instagram_url', $settings->instagram_url) }}"
                               placeholder="https://instagram.com/perfu.me"
                               class="mt-1.5 w-full border border-[#111111]/20 bg-[#f7f7f5] px-4 py-3 text-xs text-[#111111] focus:border-[#111111] focus:bg-white focus:outline-none transition">
                        @error('instagram_url') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="tiktok_url" class="block text-xs uppercase tracking-widest text-[#111111]/50 font-medium">Tautan Akun TikTok</label>
                        <input type="url" name="tiktok_url" id="tiktok_url" value="{{ old('tiktok_url', $settings->tiktok_url) }}"
                               placeholder="https://tiktok.com/@perfu.me"
                               class="mt-1.5 w-full border border-[#111111]/20 bg-[#f7f7f5] px-4 py-3 text-xs text-[#111111] focus:border-[#111111] focus:bg-white focus:outline-none transition">
                        @error('tiktok_url') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            {{-- WhatsApp Gateway Configuration (Fonnte) --}}
            <div class="border border-[#111111]/10 bg-white p-6 sm:p-8 shadow-sm space-y-6">
                <div class="border-b border-[#111111]/10 pb-4">
                    <div class="flex items-center gap-2">
                        <span class="rounded bg-emerald-500/10 px-2 py-0.5 text-[9px] font-semibold uppercase tracking-widest text-emerald-700">
                            WhatsApp API Gateway
                        </span>
                    </div>
                    <h2 class="mt-1 font-serif text-xl text-[#111111] font-normal">Integrasi Notifikasi Fonnte</h2>
                    <p class="mt-1 text-xs text-[#111111]/50 font-sans font-light">
                        Notifikasi instan otomatis ke HP admin setiap kali ada pesanan keranjang checkout, request refill baru, atau pesan customer.
                    </p>
                </div>

                <div class="grid gap-6 sm:grid-cols-2">
                    <div>
                        <label for="fonnte_token" class="block text-xs uppercase tracking-widest text-[#111111]/50 font-medium">Fonnte Device API Token</label>
                        <input type="text" name="fonnte_token" id="fonnte_token" value="{{ old('fonnte_token', $settings->fonnte_token) }}"
                               placeholder="Token perangkat fonnte..."
                               autocomplete="off"
                               class="mt-1.5 w-full border border-[#111111]/20 bg-[#f7f7f5] px-4 py-3 text-xs text-[#111111] focus:border-[#111111] focus:bg-white focus:outline-none transition font-mono">
                        @error('fonnte_token') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="whatsapp_target" class="block text-xs uppercase tracking-widest text-[#111111]/50 font-medium">Nomor WhatsApp Admin Penerima</label>
                        <input type="text" name="whatsapp_target" id="whatsapp_target" value="{{ old('whatsapp_target', $settings->whatsapp_target) }}"
                               placeholder="6281234567890"
                               class="mt-1.5 w-full border border-[#111111]/20 bg-[#f7f7f5] px-4 py-3 text-xs text-[#111111] focus:border-[#111111] focus:bg-white focus:outline-none transition font-mono">
                        @error('whatsapp_target') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                @if ($sameAsDevice)
                    <div class="border border-amber-500/30 bg-amber-500/10 p-4 text-xs text-amber-900 flex items-start gap-3">
                        <svg class="h-4 w-4 text-amber-600 shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                            <line x1="12" y1="9" x2="12" y2="13"></line>
                            <line x1="12" y1="17" x2="12.01" y2="17"></line>
                        </svg>
                        <div>
                            <strong>Catatan Nomor:</strong> Nomor tujuan admin sama dengan nomor perangkat Fonnte. Pesan WhatsApp akan masuk ke chat "Message Yourself". Disarankan menggunakan nomor terpisah untuk nomor admin penerima.
                        </div>
                    </div>
                @endif
            </div>

            <button type="submit"
                    class="bg-[#111111] text-white hover:bg-[#b79a5a] px-8 py-3.5 text-xs font-medium uppercase tracking-widest transition shadow-sm">
                Simpan Semua Pengaturan &rarr;
            </button>
        </form>

        {{-- Fonnte Live Status & Test Ping --}}
        <div class="border border-[#111111]/10 bg-white p-6 sm:p-8 shadow-sm">
            <h3 class="text-xs uppercase tracking-widest text-[#111111]/50 font-medium border-b border-[#111111]/10 pb-3">Fonnte Device Status</h3>
            <div class="mt-5 grid gap-6 sm:grid-cols-2 items-center">
                <div class="rounded border border-[#111111]/10 bg-[#f7f7f5] p-5">
                    @if ($device)
                        <dl class="space-y-2 text-xs font-sans">
                            <div class="flex justify-between"><dt class="text-[#111111]/50">Nomor Terhubung:</dt><dd class="font-mono font-medium text-[#111111]">{{ $device['device'] ?? '-' }}</dd></div>
                            <div class="flex justify-between items-center">
                                <dt class="text-[#111111]/50">Status Gateway:</dt>
                                <dd class="font-medium px-2 py-0.5 rounded text-[10px] uppercase tracking-wider {{ ($device['device_status'] ?? '') === 'connect' ? 'bg-emerald-100 text-emerald-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $device['device_status'] ?? 'unknown' }}
                                </dd>
                            </div>
                            <div class="flex justify-between"><dt class="text-[#111111]/50">Sisa Kuota:</dt><dd class="font-medium text-[#111111]">{{ $device['quota'] ?? '-' }} pesan</dd></div>
                            <div class="flex justify-between"><dt class="text-[#111111]/50">Masa Aktif:</dt><dd class="text-[#111111]/70">{{ $device['expired'] ?? '-' }}</dd></div>
                        </dl>
                    @else
                        <p class="text-xs text-[#111111]/50 font-light">Status perangkat belum terhubung atau token belum diisi.</p>
                    @endif
                </div>

                <form method="POST" action="{{ route('admin.settings.test-whatsapp') }}" class="space-y-3">
                    @csrf
                    <button type="submit"
                            class="w-full inline-flex items-center justify-center gap-2 border border-[#b79a5a] bg-white text-[#b79a5a] hover:bg-[#b79a5a] hover:text-white px-5 py-3 text-xs uppercase tracking-widest transition shadow-sm font-medium">
                        <span>Send Test WhatsApp</span>
                    </button>
                    <p class="text-[11px] text-[#111111]/40 text-center">Pastikan pengaturan sudah disimpan sebelum menekan tombol tes.</p>
                </form>
            </div>
        </div>
    </div>
@endsection
