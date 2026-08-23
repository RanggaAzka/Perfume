@extends('layouts.admin')

@section('title', 'Products')

@section('content')
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <form method="GET" class="flex flex-wrap gap-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products..."
                   class="border border-black/20 px-3 py-2 text-sm focus:border-gold focus:ring-0">
            <select name="status" class="border border-black/20 px-3 py-2 text-sm focus:border-gold focus:ring-0">
                <option value="">All statuses</option>
                <option value="active" @selected(request('status') === 'active')>Active</option>
                <option value="inactive" @selected(request('status') === 'inactive')>Inactive</option>
            </select>
            <button type="submit" class="border border-ink px-4 py-2 text-xs uppercase tracking-widest2 hover:border-gold hover:text-gold">Filter</button>
        </form>

        <a href="{{ route('admin.products.create') }}"
           class="w-fit border border-ink px-5 py-2 text-xs uppercase tracking-widest2 hover:border-gold hover:text-gold">
            + New Product
        </a>
    </div>

    <div class="mt-8 overflow-x-auto border border-black/10 bg-white">
        <table class="min-w-full divide-y divide-black/10 text-sm">
            <thead>
                <tr class="text-left text-xs uppercase tracking-widest2 text-ink/40">
                    <th class="px-6 py-4">Image</th>
                    <th class="px-6 py-4">Name</th>
                    <th class="px-6 py-4">Category</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Created</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-black/10">
                @forelse ($products as $product)
                    <tr>
                        <td class="px-6 py-4">
                            <img src="{{ $product->imageUrl() }}" alt="{{ $product->name }}" class="h-10 w-10 rounded bg-[#f4f4f2] object-contain p-1">
                        </td>
                        <td class="px-6 py-4 font-serif text-base">{{ $product->name }}</td>
                        <td class="px-6 py-4 text-ink/60">{{ $product->category ?: '—' }}</td>
                        <td class="px-6 py-4">
                            <span class="text-xs uppercase tracking-widest2 {{ $product->is_active ? 'text-green-700' : 'text-ink/40' }}">
                                {{ $product->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-ink/60">{{ $product->created_at->format('M d, Y') }}</td>
                        <td class="px-6 py-4">
                            <div class="flex justify-end gap-4 text-xs uppercase tracking-widest2">
                                <a href="{{ route('products.show', $product) }}" target="_blank" class="hover:text-gold">View</a>
                                <a href="{{ route('admin.products.edit', $product) }}" class="hover:text-gold">Edit</a>
                                <form method="POST" action="{{ route('admin.products.destroy', $product) }}"
                                      onsubmit="return confirm('Delete {{ $product->name }}? This cannot be undone.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-ink/50">No products found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $products->links() }}
    </div>
@endsection
