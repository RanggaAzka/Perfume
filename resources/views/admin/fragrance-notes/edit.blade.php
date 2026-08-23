@extends('layouts.admin')

@section('title', 'Edit ' . $fragranceNote->name)

@section('content')
    <form method="POST" action="{{ route('admin.fragrance-notes.update', $fragranceNote) }}" class="max-w-md space-y-6">
        @csrf
        @method('PUT')
        <div>
            <label for="name" class="text-xs uppercase tracking-widest2 text-ink/50">Note Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $fragranceNote->name) }}" required
                   class="mt-2 w-full border border-black/20 px-3 py-2 text-sm focus:border-gold focus:ring-0">
            @error('name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>
        <button type="submit" class="w-full border border-ink px-5 py-3 text-xs uppercase tracking-widest2 hover:border-gold hover:text-gold">
            Save Changes
        </button>
    </form>
@endsection
