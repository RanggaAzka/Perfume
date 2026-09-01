@extends('layouts.admin')

@section('title', 'Fragrance Notes')

@section('content')
    <div class="flex items-center justify-between">
        <p class="text-xs text-[#111111]/60 font-sans">Koleksi piramida aroma (top, heart, base notes) yang digunakan pada produk signature.</p>
        <a href="{{ route('admin.fragrance-notes.create') }}"
           class="inline-flex items-center gap-2 bg-[#111111] text-white hover:bg-[#b79a5a] px-5 py-2.5 text-xs uppercase tracking-widest transition shadow-sm">
            <span>+ Tambah Note Baru</span>
        </a>
    </div>

    <div class="mt-6 overflow-x-auto border border-[#111111]/10 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-[#111111]/10 text-sm">
            <thead>
                <tr class="bg-[#f7f7f5] text-left text-[11px] uppercase tracking-widest text-[#111111]/50 font-medium">
                    <th class="px-6 py-4">Nama Fragrance Note</th>
                    <th class="px-6 py-4">Digunakan Pada</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#111111]/10 font-sans">
                @forelse ($notes as $note)
                    <tr class="hover:bg-[#f7f7f5]/60 transition">
                        <td class="px-6 py-4 font-serif text-lg text-[#111111] font-normal">{{ $note->name }}</td>
                        <td class="px-6 py-4 text-xs text-[#111111]/70 font-medium">
                            <span class="inline-block rounded bg-[#f7f7f5] px-2.5 py-1 text-xs text-[#111111]">
                                {{ $note->products_count }} produk
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-3 text-xs uppercase tracking-wider">
                                <a href="{{ route('admin.fragrance-notes.edit', $note) }}" class="text-[#b79a5a] hover:text-[#111111] font-medium transition">Edit</a>
                                <span class="text-[#111111]/20">·</span>
                                <form method="POST" action="{{ route('admin.fragrance-notes.destroy', $note) }}"
                                      onsubmit="return confirm('Hapus note {{ $note->name }}?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 transition">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-12 text-center text-xs text-[#111111]/50 font-light">Belum ada fragrance note yang ditambahkan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $notes->links() }}</div>
@endsection
