@extends('layouts.admin')

@section('title', 'Detail Pesan & Order')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.messages.index') }}" class="inline-flex items-center gap-1.5 text-xs text-[#111111]/50 hover:text-[#111111] transition font-medium">
            <span>&larr;</span>
            <span>Kembali ke Daftar Pesan</span>
        </a>
    </div>

    <div class="max-w-4xl space-y-6">
        {{-- Main Message Card --}}
        <div class="border border-[#111111]/10 bg-white p-6 sm:p-8 shadow-sm">
            <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4 border-b border-[#111111]/10 pb-6">
                <div>
                    <span class="inline-block px-2.5 py-1 text-[10px] uppercase tracking-widest font-semibold text-[#b79a5a] bg-[#b79a5a]/10 rounded-full mb-2">
                        {{ $message->type_label }}
                    </span>
                    <h2 class="font-serif text-2xl sm:text-3xl text-[#111111] font-normal leading-snug">{{ $message->name }}</h2>
                    <div class="mt-2 flex flex-wrap items-center gap-x-4 gap-y-1 text-xs text-[#111111]/60 font-sans">
                        <span class="flex items-center gap-1">
                            <span class="text-[#111111]/40 font-medium">Email:</span>
                            <a href="mailto:{{ $message->email }}" class="text-[#111111] hover:underline">{{ $message->email }}</a>
                        </span>
                        @if ($message->phone)
                            <span class="text-[#111111]/20">·</span>
                            <span class="flex items-center gap-1">
                                <span class="text-[#111111]/40 font-medium">WhatsApp:</span>
                                <a href="https://wa.me/{{ app(App\Services\FonnteService::class)->normalizeTarget($message->phone) }}" target="_blank" rel="noopener" class="text-emerald-700 font-mono hover:underline">{{ $message->phone }}</a>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="text-left sm:text-right">
                    <span class="text-xs text-[#111111]/40 font-sans block">{{ $message->created_at->format('d M Y') }}</span>
                    <span class="text-xs text-[#111111]/60 font-medium font-sans block">{{ $message->created_at->format('H:i') }} WIB</span>
                </div>
            </div>

            {{-- Message Body --}}
            <div class="pt-6">
                <p class="text-xs uppercase tracking-widest text-[#111111]/40 font-medium mb-2">Isi Pesan / Catatan:</p>
                <div class="rounded bg-[#f7f7f5] p-5 text-xs sm:text-sm leading-relaxed text-[#111111] whitespace-pre-line border border-[#111111]/10 font-sans">
                    {{ $message->message }}
                </div>
            </div>

            {{-- Order Items if type order --}}
            @if ($message->orderItems->isNotEmpty())
                <div class="mt-6 border-t border-[#111111]/10 pt-6">
                    <div class="flex items-center justify-between mb-3">
                        <p class="text-xs uppercase tracking-widest text-[#111111]/50 font-medium">Daftar Item Pesanan ({{ $message->orderItems->count() }})</p>
                    </div>
                    <div class="overflow-x-auto border border-[#111111]/10">
                        <table class="min-w-full divide-y divide-[#111111]/10 text-xs">
                            <thead class="bg-[#f7f7f5]">
                                <tr class="text-left uppercase tracking-widest text-[#111111]/50 font-medium text-[10px]">
                                    <th class="px-4 py-3">Nama Produk / Scent</th>
                                    <th class="px-4 py-3">Ukuran</th>
                                    <th class="px-4 py-3 text-center">Jumlah</th>
                                    <th class="px-4 py-3">Harga Satuan</th>
                                    <th class="px-4 py-3 text-right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#111111]/10 font-sans">
                                @foreach ($message->orderItems as $item)
                                    <tr>
                                        <td class="px-4 py-3 font-serif text-sm text-[#111111]">{{ $item->label }}</td>
                                        <td class="px-4 py-3 text-[#111111]/70">{{ $item->bottle_size ? $item->bottle_size . ' ml Refill' : '30ml EDP' }}</td>
                                        <td class="px-4 py-3 text-center font-medium">{{ $item->quantity }}</td>
                                        <td class="px-4 py-3 text-[#111111]/70">Rp {{ number_format($item->unit_price, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 text-right font-serif text-sm font-medium">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="border-t border-[#111111]/15 bg-[#f7f7f5]">
                                <tr>
                                    <td colspan="4" class="px-4 py-3.5 text-xs uppercase tracking-widest text-[#111111]/60 text-right font-medium">Total Nilai Pesanan</td>
                                    <td class="px-4 py-3.5 text-right font-serif text-base font-semibold text-[#111111]">Rp {{ number_format($message->orderItems->sum('subtotal'), 0, ',', '.') }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            @endif

            {{-- Action Controls --}}
            <div class="mt-8 flex flex-wrap items-center gap-3 border-t border-[#111111]/10 pt-6 text-xs uppercase tracking-wider">
                <a href="mailto:{{ $message->email }}" class="inline-flex items-center gap-2 border border-[#111111]/20 bg-white px-4 py-2.5 text-[#111111] hover:border-[#111111] hover:bg-[#f7f7f5] transition">
                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                    <span>Balas Email</span>
                </a>

                @if ($message->phone)
                    <a href="https://wa.me/{{ app(App\Services\FonnteService::class)->normalizeTarget($message->phone) }}"
                       target="_blank" rel="noopener"
                       class="inline-flex items-center gap-2 bg-[#25D366] text-white px-4 py-2.5 hover:bg-[#1EBE5D] transition shadow-sm font-medium">
                        <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.669-.7c.974.551 1.766.815 2.791.815 3.179 0 5.767-2.587 5.768-5.766 0-3.18-2.587-5.766-5.768-5.766zm9.969 5.766c0 5.518-4.482 10-10 10-1.761 0-3.411-.46-4.851-1.267l-5.149 1.331 1.353-4.992c-.899-1.488-1.353-3.167-1.353-5.072 0-5.518 4.482-10 10-10 5.518 0 10 4.482 10 10z"/>
                        </svg>
                        <span>Chat di WhatsApp</span>
                    </a>
                @endif

                @if ($message->is_read)
                    <form method="POST" action="{{ route('admin.messages.unread', $message) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="border border-[#111111]/20 px-4 py-2.5 text-[#111111]/60 hover:text-[#111111] hover:border-[#111111] transition">Tandai Belum Dibaca</button>
                    </form>
                @endif

                <form method="POST" action="{{ route('admin.messages.destroy', $message) }}"
                      onsubmit="return confirm('Hapus riwayat pesan ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="border border-red-200 px-4 py-2.5 text-red-600 hover:bg-red-50 hover:border-red-600 transition">Hapus Pesan</button>
                </form>
            </div>
        </div>

        {{-- Past Replies History --}}
        @if ($message->replies->isNotEmpty())
            <div class="border border-[#111111]/10 bg-white p-6 sm:p-8 shadow-sm">
                <p class="text-xs uppercase tracking-widest text-[#111111]/50 font-medium mb-4">Riwayat Balasan Terkirim ({{ $message->replies->count() }})</p>
                <ul class="space-y-3">
                    @foreach ($message->replies as $reply)
                        <li class="border-l-2 border-[#b79a5a] bg-[#f7f7f5] p-4 text-xs">
                            <p class="whitespace-pre-line leading-relaxed text-[#111111]">{{ $reply->message }}</p>
                            <p class="mt-2 text-[11px] text-[#111111]/50">{{ $reply->created_at->format('d M Y, H:i') }} WIB &middot; Melalui WhatsApp Fonnte</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Reply directly via WhatsApp Form --}}
        <div class="border border-[#111111]/10 bg-white p-6 sm:p-8 shadow-sm">
            <h3 class="text-xs uppercase tracking-widest text-[#111111]/50 font-medium border-b border-[#111111]/10 pb-3">
                {{ $message->phone ? 'Kirim Balasan WhatsApp Resmi ke ' . $message->phone : 'Balasan WhatsApp Tidak Tersedia' }}
            </h3>

            @if ($message->phone)
                <form method="POST" action="{{ route('admin.messages.reply', $message) }}" class="mt-4 space-y-4">
                    @csrf
                    <textarea name="reply_message" rows="4" required
                              placeholder="Tulis pesan balasan untuk dikirim langsung ke WhatsApp pelanggan..."
                              class="w-full border border-[#111111]/20 bg-[#f7f7f5] px-4 py-3 text-xs text-[#111111] focus:border-[#111111] focus:bg-white focus:outline-none transition leading-relaxed">{{ old('reply_message') }}</textarea>
                    @error('reply_message') <p class="text-xs text-red-600">{{ $errors->first('reply_message') }}</p> @enderror

                    <button type="submit"
                            class="bg-[#111111] text-white hover:bg-[#b79a5a] px-6 py-3 text-xs uppercase tracking-widest transition shadow-sm font-medium">
                        Kirim Balasan Sekarang &rarr;
                    </button>
                </form>
            @else
                <p class="mt-3 text-xs text-[#111111]/50">Pelanggan ini tidak mencantumkan nomor WhatsApp. Anda dapat membalasnya via email.</p>
            @endif
        </div>
    </div>
@endsection
