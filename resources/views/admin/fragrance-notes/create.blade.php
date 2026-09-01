@extends('layouts.admin')

@section('title', 'New Fragrance Note')

@section('content')
    <div class="max-w-xl border border-[#111111]/10 bg-white p-6 sm:p-8 shadow-sm">
        <form method="POST" action="{{ route('admin.fragrance-notes.store') }}" class="space-y-6">
            @csrf
            <div>
                <label for="name" class="block text-xs uppercase tracking-widest text-[#111111]/50 font-medium">Nama Fragrance Note *</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                       placeholder="e.g. Madagascan Vanilla, Pink Pepper, Cedarwood..."
                       class="mt-1.5 w-full border border-[#111111]/20 bg-[#f7f7f5] px-4 py-3 text-xs text-[#111111] focus:border-[#111111] focus:bg-white focus:outline-none transition">
                @error('name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="pt-2 flex items-center gap-3">
                <button type="submit" class="flex-1 bg-[#111111] text-white py-3 text-xs font-medium uppercase tracking-widest transition hover:bg-[#b79a5a] shadow-sm">
                    Buat Note Baru &rarr;
                </button>
                <a href="{{ route('admin.fragrance-notes.index') }}"
                   class="border border-[#111111]/20 bg-white px-5 py-3 text-xs font-medium uppercase tracking-widest text-[#111111] transition hover:border-[#111111] hover:bg-[#f7f7f5]">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection
