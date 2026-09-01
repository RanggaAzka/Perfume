@extends('layouts.admin')

@section('title', 'Messages & Orders')

@section('content')
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <form method="GET" class="flex flex-wrap items-center gap-3">
            <select name="type" onchange="this.form.submit()" class="border border-[#111111]/20 bg-white px-3.5 py-2.5 text-xs text-[#111111] focus:border-[#111111] focus:outline-none transition">
                <option value="">Semua Kategori Pesan</option>
                @foreach ([
                    \App\Models\ContactMessage::TYPE_CONTACT => 'Direct Contact',
                    \App\Models\ContactMessage::TYPE_REFILL => 'Refill Requests',
                    \App\Models\ContactMessage::TYPE_PRODUCT => 'Product Inquiries',
                    \App\Models\ContactMessage::TYPE_ORDER => 'Cart Checkouts',
                ] as $type => $label)
                    <option value="{{ $type }}" @selected(request('type') === $type)>{{ $label }}</option>
                @endforeach
            </select>
            <select name="status" onchange="this.form.submit()" class="border border-[#111111]/20 bg-white px-3.5 py-2.5 text-xs text-[#111111] focus:border-[#111111] focus:outline-none transition">
                <option value="">Semua Status</option>
                <option value="unread" @selected(request('status') === 'unread')>Unread (Belum Dibaca)</option>
                <option value="read" @selected(request('status') === 'read')>Read (Sudah Dibaca)</option>
            </select>
            @if (request('type') || request('status'))
                <a href="{{ route('admin.messages.index') }}" class="text-xs text-[#111111]/50 hover:text-[#111111] underline">Reset Filter</a>
            @endif
        </form>
    </div>

    <div class="mt-6 overflow-x-auto border border-[#111111]/10 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-[#111111]/10 text-sm">
            <thead>
                <tr class="bg-[#f7f7f5] text-left text-[11px] uppercase tracking-widest text-[#111111]/50 font-medium">
                    <th class="px-6 py-4">Pelanggan</th>
                    <th class="px-6 py-4">Ringkasan Pesan</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Waktu Masuk</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#111111]/10 font-sans">
                @forelse ($messages as $message)
                    <tr class="transition {{ $message->is_read ? 'hover:bg-[#f7f7f5]/50' : 'bg-[#b79a5a]/5 hover:bg-[#b79a5a]/10' }}">
                        <td class="px-6 py-4">
                            <p class="font-serif text-base text-[#111111] font-normal leading-snug">{{ $message->name }}</p>
                            <p class="text-xs text-[#111111]/60 font-sans">{{ $message->email }}</p>
                            @if ($message->phone)
                                <p class="text-xs text-[#111111]/50 font-mono">{{ $message->phone }}</p>
                            @endif
                            <span class="mt-1 inline-block text-[10px] uppercase tracking-widest text-[#b79a5a] font-medium">{{ $message->type_label }}</span>
                        </td>
                        <td class="max-w-xs px-6 py-4 text-xs text-[#111111]/70 leading-relaxed">
                            {{ \Illuminate\Support\Str::limit($message->message, 80) }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-block px-2.5 py-1 text-[10px] uppercase tracking-widest font-medium rounded-full {{ $message->is_read ? 'bg-gray-100 text-gray-500' : 'bg-[#b79a5a]/15 text-[#b79a5a] border border-[#b79a5a]/30' }}">
                                {{ $message->is_read ? 'Read' : 'New' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-xs text-[#111111]/60">
                            {{ $message->created_at->format('d M Y, H:i') }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-3 text-xs uppercase tracking-wider">
                                <a href="{{ route('admin.messages.show', $message) }}" class="text-[#b79a5a] hover:text-[#111111] font-medium transition">Detail &rarr;</a>
                                <span class="text-[#111111]/20">·</span>
                                <form method="POST" action="{{ route('admin.messages.destroy', $message) }}"
                                      onsubmit="return confirm('Hapus pesan ini?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 transition">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-xs text-[#111111]/50 font-light">Tidak ada pesan pelanggan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $messages->links() }}</div>
@endsection
