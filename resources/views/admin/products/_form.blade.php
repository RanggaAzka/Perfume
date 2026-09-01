@csrf
@if (isset($product))
    @method('PUT')
@endif

<div class="grid gap-8 lg:grid-cols-12">
    {{-- Left 8 cols: Main Product Data --}}
    <div class="space-y-6 lg:col-span-8 border border-[#111111]/10 bg-white p-6 sm:p-8 shadow-sm">
        <div>
            <label for="name" class="block text-xs uppercase tracking-widest text-[#111111]/50 font-medium">Nama Produk *</label>
            <input type="text" name="name" id="name" value="{{ old('name', $product->name ?? '') }}" required
                   placeholder="e.g. Vanessence"
                   class="mt-1.5 w-full border border-[#111111]/20 bg-[#f7f7f5] px-4 py-3 text-xs text-[#111111] focus:border-[#111111] focus:bg-white focus:outline-none transition">
            @error('name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="slug" class="block text-xs uppercase tracking-widest text-[#111111]/50 font-medium">Slug URL (opsional — otomatis jika kosong)</label>
            <input type="text" name="slug" id="slug" value="{{ old('slug', $product->slug ?? '') }}"
                   placeholder="e.g. vanessence"
                   class="mt-1.5 w-full border border-[#111111]/20 bg-[#f7f7f5] px-4 py-3 text-xs text-[#111111] focus:border-[#111111] focus:bg-white focus:outline-none transition">
            @error('slug') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="short_description" class="block text-xs uppercase tracking-widest text-[#111111]/50 font-medium">Deskripsi Singkat *</label>
            <input type="text" name="short_description" id="short_description" value="{{ old('short_description', $product->short_description ?? '') }}" required
                   placeholder="Ringkasan aroma untuk kartu katalog..."
                   class="mt-1.5 w-full border border-[#111111]/20 bg-[#f7f7f5] px-4 py-3 text-xs text-[#111111] focus:border-[#111111] focus:bg-white focus:outline-none transition">
            @error('short_description') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="description" class="block text-xs uppercase tracking-widest text-[#111111]/50 font-medium">Deskripsi Lengkap *</label>
            <textarea name="description" id="description" rows="5" required
                      placeholder="Cerita dan detail karakter aroma secara komprehensif..."
                      class="mt-1.5 w-full border border-[#111111]/20 bg-[#f7f7f5] px-4 py-3 text-xs text-[#111111] focus:border-[#111111] focus:bg-white focus:outline-none transition leading-relaxed">{{ old('description', $product->description ?? '') }}</textarea>
            @error('description') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="grid gap-4 sm:grid-cols-3">
            <div>
                <label for="fragrance_family" class="block text-xs uppercase tracking-widest text-[#111111]/50 font-medium">Fragrance Family</label>
                <input type="text" name="fragrance_family" id="fragrance_family" value="{{ old('fragrance_family', $product->fragrance_family ?? '') }}"
                       placeholder="e.g. Amber Gourmand"
                       class="mt-1.5 w-full border border-[#111111]/20 bg-[#f7f7f5] px-3.5 py-2.5 text-xs text-[#111111] focus:border-[#111111] focus:bg-white focus:outline-none transition">
            </div>
            <div>
                <label for="category" class="block text-xs uppercase tracking-widest text-[#111111]/50 font-medium">Kategori</label>
                <input type="text" name="category" id="category" value="{{ old('category', $product->category ?? 'Signature Eau de Parfum') }}"
                       placeholder="e.g. Eau de Parfum"
                       class="mt-1.5 w-full border border-[#111111]/20 bg-[#f7f7f5] px-3.5 py-2.5 text-xs text-[#111111] focus:border-[#111111] focus:bg-white focus:outline-none transition">
            </div>
            <div>
                <label for="longevity" class="block text-xs uppercase tracking-widest text-[#111111]/50 font-medium">Ketahanan</label>
                <input type="text" name="longevity" id="longevity" value="{{ old('longevity', $product->longevity ?? '6–8 Jam') }}"
                       placeholder="e.g. 6–8 Jam"
                       class="mt-1.5 w-full border border-[#111111]/20 bg-[#f7f7f5] px-3.5 py-2.5 text-xs text-[#111111] focus:border-[#111111] focus:bg-white focus:outline-none transition">
            </div>
        </div>

        <div>
            <label for="price" class="block text-xs uppercase tracking-widest text-[#111111]/50 font-medium">Harga Produk (IDR) *</label>
            <input type="number" name="price" id="price" min="0" step="1000" value="{{ old('price', $product->price ?? 45000) }}" required
                   class="mt-1.5 w-full border border-[#111111]/20 bg-[#f7f7f5] px-4 py-3 text-xs text-[#111111] focus:border-[#111111] focus:bg-white focus:outline-none transition font-medium">
            @error('price') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        {{-- Fragrance Notes --}}
        <div class="border-t border-[#111111]/10 pt-6">
            <span class="block text-xs uppercase tracking-widest text-[#111111]/50 font-medium">Fragrance Notes Architecture</span>
            <p class="mt-1 text-xs text-[#111111]/50 font-sans font-light">Centang note yang terkandung di dalam produk ini dan tentukan fase pergerakannya.</p>
            @php
                $selectedNotes = old('fragrance_notes', isset($product) ? $product->fragranceNotes->pluck('id')->all() : []);
                $notePositions = old('fragrance_note_positions', isset($product)
                    ? $product->fragranceNotes->mapWithKeys(fn ($note) => [$note->id => $note->pivot->position])->all()
                    : []);
            @endphp
            <div class="mt-4 grid gap-2.5 sm:grid-cols-2">
                @foreach ($fragranceNotes as $note)
                    <div class="flex items-center justify-between border border-[#111111]/15 bg-[#f7f7f5] p-3 text-xs">
                        <label class="flex items-center gap-2.5 cursor-pointer select-none">
                            <input type="checkbox" name="fragrance_notes[]" value="{{ $note->id }}"
                                   @checked(in_array($note->id, $selectedNotes)) class="rounded border-[#111111]/30 text-[#111111] focus:ring-[#111111]">
                            <span class="font-medium text-[#111111]">{{ $note->name }}</span>
                        </label>
                        <select name="fragrance_note_positions[{{ $note->id }}]" class="border border-[#111111]/20 bg-white px-2 py-1 text-[11px] text-[#111111] focus:border-[#111111] focus:outline-none">
                            @foreach (['top' => 'Top Note', 'heart' => 'Heart Note', 'base' => 'Base Note'] as $value => $label)
                                <option value="{{ $value }}" @selected(($notePositions[$note->id] ?? 'heart') === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Main Accords --}}
        <div data-accord-picker class="border-t border-[#111111]/10 pt-6">
            <span class="block text-xs uppercase tracking-widest text-[#111111]/50 font-medium">Main Accords (Persentase Olfactive)</span>
            <p class="mt-1 text-xs text-[#111111]/50 font-sans font-light">Pilih hingga maksimal 4 karakter aroma dominan beserta persentasenya.</p>

            <div data-accord-rows class="mt-4 space-y-3">
                @foreach (old('main_accords', $product->main_accords ?? []) as $index => $row)
                    <div class="accord-row flex items-center gap-2">
                        <select name="main_accords[{{ $index }}][accord]"
                                class="flex-1 border border-[#111111]/20 bg-white px-3 py-2 text-xs text-[#111111] focus:border-[#111111] focus:outline-none">
                            <option value="">&mdash; Pilih Fragrance Accord &mdash;</option>
                            @foreach (App\Models\Product::ACCORDS as $accord)
                                <option value="{{ $accord }}" @selected(($row['accord'] ?? '') === $accord)>{{ $accord }}</option>
                            @endforeach
                        </select>
                        <div class="relative w-24">
                            <input type="number" name="main_accords[{{ $index }}][percent]" min="1" max="100"
                                   value="{{ $row['percent'] ?? '' }}" placeholder="%"
                                   class="w-full border border-[#111111]/20 bg-white px-3 py-2 text-xs text-[#111111] focus:border-[#111111] focus:outline-none">
                        </div>
                        <button type="button" data-accord-remove aria-label="Hapus accord"
                                class="flex h-8 w-8 items-center justify-center border border-[#111111]/20 text-[#111111]/50 hover:bg-red-600 hover:text-white hover:border-red-600 transition">&times;</button>
                    </div>
                @endforeach
            </div>

            <button type="button" data-accord-add
                    class="mt-3 border border-[#111111]/20 bg-[#f7f7f5] px-4 py-2 text-[11px] uppercase tracking-widest text-[#111111] transition hover:border-[#111111] hover:bg-white">
                + Tambah Bar Accord
            </button>
        </div>

        <template id="accord-row-template">
            <div class="accord-row flex items-center gap-2">
                <select name="main_accords[0][accord]"
                        class="flex-1 border border-[#111111]/20 bg-white px-3 py-2 text-xs text-[#111111] focus:border-[#111111] focus:outline-none">
                    <option value="">&mdash; Pilih Fragrance Accord &mdash;</option>
                    @foreach (App\Models\Product::ACCORDS as $accord)
                        <option value="{{ $accord }}">{{ $accord }}</option>
                    @endforeach
                </select>
                <div class="relative w-24">
                    <input type="number" name="main_accords[0][percent]" min="1" max="100" placeholder="%"
                           class="w-full border border-[#111111]/20 bg-white px-3 py-2 text-xs text-[#111111] focus:border-[#111111] focus:outline-none">
                </div>
                <button type="button" data-accord-remove aria-label="Hapus accord"
                        class="flex h-8 w-8 items-center justify-center border border-[#111111]/20 text-[#111111]/50 hover:bg-red-600 hover:text-white hover:border-red-600 transition">&times;</button>
            </div>
        </template>
    </div>

    {{-- Right 4 cols: Image & Publishing Controls --}}
    <div class="space-y-6 lg:col-span-4">
        <div class="border border-[#111111]/10 bg-white p-6 shadow-sm space-y-5">
            <h3 class="text-xs uppercase tracking-widest text-[#111111]/50 font-medium border-b border-[#111111]/10 pb-3">Foto Botol Produk</h3>
            @if (isset($product) && $product->image)
                <div class="flex justify-center border border-[#111111]/10 bg-[#f7f7f5] p-4">
                    <img src="{{ $product->imageUrl() }}" alt="{{ $product->name }}" class="h-44 w-auto object-contain drop-shadow">
                </div>
            @endif
            <div>
                <input type="file" name="image" accept="image/png,image/jpeg,image/webp"
                       class="w-full text-xs text-[#111111] file:mr-3 file:border-0 file:bg-[#111111] file:px-3.5 file:py-2 file:text-xs file:text-white file:uppercase file:tracking-wider file:transition hover:file:bg-[#b79a5a]">
                <p class="mt-2 text-[11px] text-[#111111]/50">Format PNG, JPG atau WEBP (Maks 4MB).@if (isset($product)) Kosongkan jika tidak ingin mengubah foto.@endif</p>
                @error('image') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="border border-[#111111]/10 bg-white p-6 shadow-sm space-y-5">
            <h3 class="text-xs uppercase tracking-widest text-[#111111]/50 font-medium border-b border-[#111111]/10 pb-3">Pengaturan Status</h3>
            <div>
                <label for="sort_order" class="block text-xs uppercase tracking-widest text-[#111111]/50 font-medium">Urutan Tampil (Sort Order)</label>
                <input type="number" name="sort_order" id="sort_order" min="0" value="{{ old('sort_order', $product->sort_order ?? 0) }}"
                       class="mt-1.5 w-full border border-[#111111]/20 bg-[#f7f7f5] px-3.5 py-2.5 text-xs text-[#111111] focus:border-[#111111] focus:bg-white focus:outline-none transition">
            </div>

            <label class="flex items-center gap-2.5 text-xs text-[#111111] cursor-pointer select-none">
                <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $product->is_active ?? true)) class="rounded border-[#111111]/30 text-[#111111] focus:ring-[#111111]">
                <span>Publikasikan produk (Active di web)</span>
            </label>

            <button type="submit"
                    class="w-full bg-[#111111] text-white py-3.5 text-xs font-medium uppercase tracking-widest transition hover:bg-[#b79a5a] shadow-sm">
                {{ isset($product) ? 'Simpan Perubahan &rarr;' : 'Buat Produk Baru &rarr;' }}
            </button>

            <a href="{{ route('admin.products.index') }}"
               class="block w-full text-center border border-[#111111]/20 bg-white py-3 text-xs font-medium uppercase tracking-widest text-[#111111] transition hover:border-[#111111] hover:bg-[#f7f7f5]">
                Batal
            </a>
        </div>
    </div>
</div>
