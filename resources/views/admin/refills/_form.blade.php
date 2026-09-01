@csrf
@if (isset($refill))
    @method('PUT')
@endif

<div class="max-w-xl border border-[#111111]/10 bg-white p-6 sm:p-8 shadow-sm space-y-6">
    <div>
        <label for="name" class="block text-xs uppercase tracking-widest text-[#111111]/50 font-medium">Nama Aroma Refill *</label>
        <input type="text" name="name" id="name" value="{{ old('name', $refill->name ?? '') }}" required
               placeholder="e.g. Santal Voyage"
               class="mt-1.5 w-full border border-[#111111]/20 bg-[#f7f7f5] px-4 py-3 text-xs text-[#111111] focus:border-[#111111] focus:bg-white focus:outline-none transition">
        @error('name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <label class="flex items-center gap-2.5 text-xs text-[#111111] cursor-pointer select-none">
        <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $refill->is_active ?? true)) class="rounded border-[#111111]/30 text-[#111111] focus:ring-[#111111]">
        <span>Aktifkan aroma ini di stasiun Refill publik</span>
    </label>

    <div class="pt-2 flex items-center gap-3">
        <button type="submit" class="flex-1 bg-[#111111] text-white py-3 text-xs font-medium uppercase tracking-widest transition hover:bg-[#b79a5a] shadow-sm">
            {{ isset($refill) ? 'Simpan Perubahan &rarr;' : 'Tambah Refill &rarr;' }}
        </button>
        <a href="{{ route('admin.refills.index') }}"
           class="border border-[#111111]/20 bg-white px-5 py-3 text-xs font-medium uppercase tracking-widest text-[#111111] transition hover:border-[#111111] hover:bg-[#f7f7f5]">
            Batal
        </a>
    </div>
</div>
