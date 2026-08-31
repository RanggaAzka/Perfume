@extends('layouts.admin')

@section('title', 'Refill Collection')

@section('content')
    <p class="text-sm text-ink/60">Manage the fragrances available for refill in-store.</p>

    <div class="mt-6 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <form method="GET" class="flex flex-wrap gap-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search refills..."
                   class="border border-black/20 px-3 py-2 text-sm focus:border-gold focus:ring-0">
            <select name="status" class="border border-black/20 px-3 py-2 text-sm focus:border-gold focus:ring-0">
                <option value="">All statuses</option>
                <option value="active" @selected(request('status') === 'active')>Active</option>
                <option value="inactive" @selected(request('status') === 'inactive')>Inactive</option>
            </select>
            <button type="submit" class="border border-ink px-4 py-2 text-xs uppercase tracking-widest2 hover:border-gold hover:text-gold">Filter</button>
        </form>

        <a href="{{ route('admin.refills.create') }}"
           class="w-fit border border-ink px-5 py-2 text-xs uppercase tracking-widest2 hover:border-gold hover:text-gold">
            + Add Refill
        </a>
    </div>

    <div class="mt-8 overflow-x-auto border border-black/10 bg-white">
        <table class="min-w-full divide-y divide-black/10 text-sm">
            <thead>
                <tr class="text-left text-xs uppercase tracking-widest2 text-ink/40">
                    <th class="px-6 py-4">Name</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Order</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-black/10">
                @forelse ($refills as $refill)
                    <tr>
                        <td class="px-6 py-4 font-serif text-base">{{ $refill->name }}</td>
                        <td class="px-6 py-4">
                            <span class="text-xs uppercase tracking-widest2 {{ $refill->is_active ? 'text-green-700' : 'text-ink/40' }}">
                                {{ $refill->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-ink/60">{{ $refill->orders_count }}</td>
                        <td class="px-6 py-4">
                            <div class="flex justify-end gap-4 text-xs uppercase tracking-widest2">
                                <a href="{{ route('admin.refills.edit', $refill) }}" class="hover:text-gold">Edit</a>
                                <form method="POST" action="{{ route('admin.refills.destroy', $refill) }}"
                                      onsubmit="return confirm('Delete {{ $refill->name }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-ink/50">No refill fragrances yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $refills->links() }}</div>
@endsection
