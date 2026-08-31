@csrf
@if (isset($refill))
    @method('PUT')
@endif

<div class="max-w-md space-y-6">
    <div>
        <label for="name" class="text-xs uppercase tracking-widest2 text-ink/50">Fragrance Name</label>
        <input type="text" name="name" id="name" value="{{ old('name', $refill->name ?? '') }}" required
               class="mt-2 w-full border border-black/20 px-3 py-2 text-sm focus:border-gold focus:ring-0">
        @error('name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <label class="flex items-center gap-2 text-sm">
        <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $refill->is_active ?? true)) class="rounded border-black/20 text-gold focus:ring-gold">
        Active (visible on the public refill page)
    </label>

    <button type="submit" class="w-full border border-ink px-5 py-3 text-xs uppercase tracking-widest2 hover:border-gold hover:text-gold">
        {{ isset($refill) ? 'Save Changes' : 'Add Refill' }}
    </button>
</div>
