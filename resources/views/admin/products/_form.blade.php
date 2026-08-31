@csrf
@if (isset($product))
    @method('PUT')
@endif

<div class="grid gap-8 md:grid-cols-3">
    <div class="space-y-6 md:col-span-2">
        <div>
            <label for="name" class="text-xs uppercase tracking-widest2 text-ink/50">Product Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $product->name ?? '') }}" required
                   class="mt-2 w-full border border-black/20 px-3 py-2 text-sm focus:border-gold focus:ring-0">
            @error('name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="slug" class="text-xs uppercase tracking-widest2 text-ink/50">Slug (optional — auto-generated if blank)</label>
            <input type="text" name="slug" id="slug" value="{{ old('slug', $product->slug ?? '') }}"
                   class="mt-2 w-full border border-black/20 px-3 py-2 text-sm focus:border-gold focus:ring-0">
            @error('slug') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="short_description" class="text-xs uppercase tracking-widest2 text-ink/50">Short Description</label>
            <input type="text" name="short_description" id="short_description" value="{{ old('short_description', $product->short_description ?? '') }}" required
                   class="mt-2 w-full border border-black/20 px-3 py-2 text-sm focus:border-gold focus:ring-0">
            @error('short_description') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="description" class="text-xs uppercase tracking-widest2 text-ink/50">Full Description</label>
            <textarea name="description" id="description" rows="6" required
                      class="mt-2 w-full border border-black/20 px-3 py-2 text-sm focus:border-gold focus:ring-0">{{ old('description', $product->description ?? '') }}</textarea>
            @error('description') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="grid gap-6 md:grid-cols-3">
            <div>
                <label for="fragrance_family" class="text-xs uppercase tracking-widest2 text-ink/50">Fragrance Family</label>
                <input type="text" name="fragrance_family" id="fragrance_family" value="{{ old('fragrance_family', $product->fragrance_family ?? '') }}"
                       class="mt-2 w-full border border-black/20 px-3 py-2 text-sm focus:border-gold focus:ring-0">
            </div>
            <div>
                <label for="category" class="text-xs uppercase tracking-widest2 text-ink/50">Category</label>
                <input type="text" name="category" id="category" value="{{ old('category', $product->category ?? '') }}"
                       class="mt-2 w-full border border-black/20 px-3 py-2 text-sm focus:border-gold focus:ring-0">
            </div>
            <div>
                <label for="longevity" class="text-xs uppercase tracking-widest2 text-ink/50">Longevity</label>
                <input type="text" name="longevity" id="longevity" value="{{ old('longevity', $product->longevity ?? '') }}"
                       class="mt-2 w-full border border-black/20 px-3 py-2 text-sm focus:border-gold focus:ring-0">
            </div>
        </div>

        <div>
            <label for="price" class="text-xs uppercase tracking-widest2 text-ink/50">Price (Rp)</label>
            <input type="number" name="price" id="price" min="0" step="1000" value="{{ old('price', $product->price ?? 45000) }}"
                   class="mt-2 w-full border border-black/20 px-3 py-2 text-sm focus:border-gold focus:ring-0">
            @error('price') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <span class="text-xs uppercase tracking-widest2 text-ink/50">Fragrance Notes</span>
            <p class="mt-1 text-xs text-ink/40">Tick a note to include it, then choose its olfactive position.</p>
            @php
                $selectedNotes = old('fragrance_notes', isset($product) ? $product->fragranceNotes->pluck('id')->all() : []);
                $notePositions = old('fragrance_note_positions', isset($product)
                    ? $product->fragranceNotes->mapWithKeys(fn ($note) => [$note->id => $note->pivot->position])->all()
                    : []);
            @endphp
            <div class="mt-3 space-y-2">
                @foreach ($fragranceNotes as $note)
                    <div class="flex flex-wrap items-center gap-3 border border-black/20 px-3 py-2 text-sm">
                        <label class="flex flex-1 items-center gap-2">
                            <input type="checkbox" name="fragrance_notes[]" value="{{ $note->id }}"
                                   @checked(in_array($note->id, $selectedNotes)) class="rounded border-black/20 text-gold focus:ring-gold">
                            {{ $note->name }}
                        </label>
                        <select name="fragrance_note_positions[{{ $note->id }}]" class="border border-black/20 px-2 py-1 text-xs focus:border-gold focus:ring-0">
                            @foreach (['top' => 'Top', 'heart' => 'Heart', 'base' => 'Base'] as $value => $label)
                                <option value="{{ $value }}" @selected(($notePositions[$note->id] ?? 'heart') === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                @endforeach
            </div>
        </div>

        <div data-accord-picker>
            <span class="text-xs uppercase tracking-widest2 text-ink/50">Main Accords</span>
            <p class="mt-1 text-xs text-ink/40">Pilih fragrance yang dominan (maks 4), lalu atur persentasenya. Accord tertinggi tampil paling atas di halaman produk.</p>

            <div data-accord-rows class="mt-3 space-y-2">
                @foreach (old('main_accords', $product->main_accords ?? []) as $index => $row)
                    <div class="accord-row flex items-center gap-2">
                        <select name="main_accords[{{ $index }}][accord]"
                                class="flex-1 border border-black/20 px-2 py-1.5 text-sm focus:border-gold focus:ring-0">
                            <option value="">&mdash; Pilih Fragrance &mdash;</option>
                            @foreach (App\Models\Product::ACCORDS as $accord)
                                <option value="{{ $accord }}" @selected(($row['accord'] ?? '') === $accord)>{{ $accord }}</option>
                            @endforeach
                        </select>
                        <input type="number" name="main_accords[{{ $index }}][percent]" min="1" max="100"
                               value="{{ $row['percent'] ?? '' }}" placeholder="%"
                               class="w-20 border border-black/20 px-2 py-1.5 text-sm focus:border-gold focus:ring-0">
                        <button type="button" data-accord-remove aria-label="Hapus accord"
                                class="px-2 text-xl leading-none text-ink/50 hover:text-red-600 transition">&times;</button>
                    </div>
                @endforeach
            </div>

            <button type="button" data-accord-add
                    class="mt-3 border border-black/20 px-3 py-1.5 text-xs uppercase tracking-widest2 text-ink/70 transition hover:border-gold hover:text-gold">
                + Tambah Fragrance
            </button>
        </div>

        <template id="accord-row-template">
            <div class="accord-row flex items-center gap-2">
                <select name="main_accords[0][accord]"
                        class="flex-1 border border-black/20 px-2 py-1.5 text-sm focus:border-gold focus:ring-0">
                    <option value="">&mdash; Pilih Fragrance &mdash;</option>
                    @foreach (App\Models\Product::ACCORDS as $accord)
                        <option value="{{ $accord }}">{{ $accord }}</option>
                    @endforeach
                </select>
                <input type="number" name="main_accords[0][percent]" min="1" max="100" placeholder="%"
                       class="w-20 border border-black/20 px-2 py-1.5 text-sm focus:border-gold focus:ring-0">
                <button type="button" data-accord-remove aria-label="Hapus accord"
                        class="px-2 text-xl leading-none text-ink/50 hover:text-red-600 transition">&times;</button>
            </div>
        </template>
    </div>

    <div class="space-y-6">
        <div>
            <span class="text-xs uppercase tracking-widest2 text-ink/50">Product Image</span>
            @if (isset($product) && $product->image)
                <img src="{{ $product->imageUrl() }}" alt="{{ $product->name }}" class="mt-3 h-40 w-full rounded bg-[#f4f4f2] object-contain p-4">
            @endif
            <input type="file" name="image" accept="image/png,image/jpeg,image/webp"
                   class="mt-3 w-full border border-black/20 px-3 py-2 text-sm file:mr-3 file:border-0 file:bg-ink file:px-3 file:py-1.5 file:text-white">
            <p class="mt-1 text-xs text-ink/40">JPEG, PNG or WEBP, up to 4MB.@if (isset($product)) Leave empty to keep the current image.@endif</p>
            @error('image') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="sort_order" class="text-xs uppercase tracking-widest2 text-ink/50">Sort Order</label>
            <input type="number" name="sort_order" id="sort_order" min="0" value="{{ old('sort_order', $product->sort_order ?? 0) }}"
                   class="mt-2 w-full border border-black/20 px-3 py-2 text-sm focus:border-gold focus:ring-0">
        </div>

        <label class="flex items-center gap-2 text-sm">
            <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $product->is_active ?? true)) class="rounded border-black/20 text-gold focus:ring-gold">
            Active (visible on the public site)
        </label>

        <button type="submit" class="w-full border border-ink px-5 py-3 text-xs uppercase tracking-widest2 hover:border-gold hover:text-gold">
            {{ isset($product) ? 'Save Changes' : 'Create Product' }}
        </button>
    </div>
</div>
