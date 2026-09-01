@extends('layouts.admin')

@section('title', 'Signature Products')

@section('content')
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <form method="GET" class="flex flex-wrap items-center gap-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau aroma..."
                   class="border border-[#111111]/20 bg-white px-3.5 py-2.5 text-xs text-[#111111] focus:border-[#111111] focus:outline-none transition min-w-[200px]">
            <select name="status" class="border border-[#111111]/20 bg-white px-3.5 py-2.5 text-xs text-[#111111] focus:border-[#111111] focus:outline-none transition">
                <option value="">Semua Status</option>
                <option value="active" @selected(request('status') === 'active')>Active Only</option>
                <option value="inactive" @selected(request('status') === 'inactive')>Inactive Only</option>
            </select>
            <button type="submit" class="bg-[#111111] text-white hover:bg-[#b79a5a] px-4 py-2.5 text-xs uppercase tracking-widest transition">
                Filter
            </button>
            @if (request('search') || request('status'))
                <a href="{{ route('admin.products.index') }}" class="text-xs text-[#111111]/50 hover:text-[#111111] underline">Reset</a>
            @endif
        </form>

        <a href="{{ route('admin.products.create') }}"
           class="inline-flex items-center gap-2 bg-[#111111] text-white hover:bg-[#b79a5a] px-5 py-2.5 text-xs uppercase tracking-widest transition shadow-sm">
            <span>+ Tambah Produk</span>
        </a>
    </div>

    <div class="mt-8 overflow-x-auto border border-[#111111]/10 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-[#111111]/10 text-sm">
            <thead>
                <tr class="bg-[#f7f7f5] text-left text-[11px] uppercase tracking-widest text-[#111111]/50 font-medium">
                    <th class="px-6 py-4">Visual</th>
                    <th class="px-6 py-4">Nama Produk</th>
                    <th class="px-6 py-4">Kategori / Notes</th>
                    <th class="px-6 py-4">Harga</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#111111]/10 font-sans">
                @forelse ($products as $product)
                    <tr class="hover:bg-[#f7f7f5]/60 transition">
                        <td class="px-6 py-4">
                            <img src="{{ $product->imageUrl() }}" alt="{{ $product->name }}" class="h-12 w-12 rounded border border-[#111111]/10 bg-[#f7f7f5] object-contain p-1">
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-serif text-lg text-[#111111] font-normal leading-snug">{{ $product->name }}</p>
                            <p class="text-[11px] text-[#111111]/40 font-mono">/products/{{ $product->slug }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-xs text-[#111111] font-medium">{{ $product->fragrance_family ?: '—' }}</p>
                            <p class="text-[11px] text-[#111111]/50">{{ $product->category ?: 'Eau de Parfum' }}</p>
                        </td>
                        <td class="px-6 py-4 font-serif text-base text-[#111111]">{{ $product->priceFormatted() }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-block px-2.5 py-1 text-[10px] uppercase tracking-widest font-medium rounded-full {{ $product->is_active ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-gray-100 text-gray-500' }}">
                                {{ $product->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-3 text-xs uppercase tracking-wider">
                                <a href="{{ route('products.show', $product) }}" target="_blank" class="text-[#111111]/60 hover:text-[#111111] transition">View</a>
                                <span class="text-[#111111]/20">·</span>
                                <a href="{{ route('admin.products.edit', $product) }}" class="text-[#b79a5a] hover:text-[#111111] font-medium transition">Edit</a>
                                <span class="text-[#111111]/20">·</span>
                                <form method="POST" action="{{ route('admin.products.destroy', $product) }}"
                                      onsubmit="return confirm('Hapus produk {{ $product->name }}?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 transition">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-xs text-[#111111]/50 font-light">Tidak ada produk ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $products->links() }}
    </div>
@endsection
