@extends('layouts.admin')

@section('title', 'Fragrance Notes')

@section('content')
    <div class="flex justify-end">
        <a href="{{ route('admin.fragrance-notes.create') }}"
           class="w-fit border border-ink px-5 py-2 text-xs uppercase tracking-widest2 hover:border-gold hover:text-gold">
            + New Note
        </a>
    </div>

    <div class="mt-6 overflow-x-auto border border-black/10 bg-white">
        <table class="min-w-full divide-y divide-black/10 text-sm">
            <thead>
                <tr class="text-left text-xs uppercase tracking-widest2 text-ink/40">
                    <th class="px-6 py-4">Name</th>
                    <th class="px-6 py-4">Used In</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-black/10">
                @forelse ($notes as $note)
                    <tr>
                        <td class="px-6 py-4 font-serif text-base">{{ $note->name }}</td>
                        <td class="px-6 py-4 text-ink/60">{{ $note->products_count }} product{{ $note->products_count === 1 ? '' : 's' }}</td>
                        <td class="px-6 py-4">
                            <div class="flex justify-end gap-4 text-xs uppercase tracking-widest2">
                                <a href="{{ route('admin.fragrance-notes.edit', $note) }}" class="hover:text-gold">Edit</a>
                                <form method="POST" action="{{ route('admin.fragrance-notes.destroy', $note) }}"
                                      onsubmit="return confirm('Delete {{ $note->name }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-10 text-center text-ink/50">No fragrance notes yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $notes->links() }}</div>
@endsection
