@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    @if ($unreadMessages > 0)
        <div class="mb-8 flex flex-wrap items-center justify-between gap-4 border border-gold/40 bg-gold/10 px-6 py-4">
            <p class="text-sm text-ink">
                You have <strong>{{ $unreadMessages }}</strong> new {{ $unreadMessages === 1 ? 'message' : 'messages' }} waiting — refill requests, product inquiries and contact messages land here.
            </p>
            <a href="{{ route('admin.messages.index', ['status' => 'unread']) }}"
               class="border border-ink px-4 py-2 text-xs uppercase tracking-widest2 transition hover:border-gold hover:text-gold">
                Open Messages
            </a>
        </div>
    @endif

    <div class="grid gap-6 md:grid-cols-4">
        @foreach ([
            ['label' => 'Signature Products', 'value' => $totalProducts],
            ['label' => 'Active Products', 'value' => $activeProducts],
            ['label' => 'Refill Scents', 'value' => $refillCount],
            ['label' => 'Unread Messages', 'value' => $unreadMessages],
        ] as $stat)
            <div class="border border-black/10 bg-white p-6">
                <p class="text-xs uppercase tracking-widest2 text-ink/40">{{ $stat['label'] }}</p>
                <p class="mt-3 font-serif text-4xl">{{ $stat['value'] }}</p>
            </div>
        @endforeach
    </div>

    <div class="mt-10 grid gap-8 lg:grid-cols-2">
        <div class="border border-black/10 bg-white">
            <div class="flex items-center justify-between border-b border-black/10 px-6 py-4">
                <h2 class="text-sm uppercase tracking-widest2 text-ink/50">Recent Products</h2>
                <a href="{{ route('admin.products.index') }}" class="text-xs uppercase tracking-widest2 text-gold hover:underline">View All</a>
            </div>

            @if ($recentProducts->isEmpty())
                <p class="px-6 py-8 text-sm text-ink/50">No products yet — create your first one.</p>
            @else
                <ul class="divide-y divide-black/10">
                    @foreach ($recentProducts as $product)
                        <li class="flex items-center justify-between px-6 py-4">
                            <div class="flex items-center gap-4">
                                <img src="{{ $product->imageUrl() }}" alt="{{ $product->name }}" class="h-12 w-12 rounded bg-[#f4f4f2] object-contain p-1">
                                <div>
                                    <p class="font-serif text-lg">{{ $product->name }}</p>
                                    <p class="text-xs text-ink/40">{{ $product->created_at->format('M d, Y') }}</p>
                                </div>
                            </div>
                            <span class="text-xs uppercase tracking-widest2 {{ $product->is_active ? 'text-green-700' : 'text-ink/40' }}">
                                {{ $product->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div class="border border-black/10 bg-white">
            <div class="flex items-center justify-between border-b border-black/10 px-6 py-4">
                <h2 class="text-sm uppercase tracking-widest2 text-ink/50">Recent Messages</h2>
                <a href="{{ route('admin.messages.index') }}" class="text-xs uppercase tracking-widest2 text-gold hover:underline">View All</a>
            </div>

            @if ($recentMessages->isEmpty())
                <p class="px-6 py-8 text-sm text-ink/50">No messages yet.</p>
            @else
                <ul class="divide-y divide-black/10">
                    @foreach ($recentMessages as $message)
                        <li>
                            <a href="{{ route('admin.messages.show', $message) }}" class="flex items-center justify-between px-6 py-4 hover:bg-black/5">
                                <div>
                                    <p class="font-serif text-lg">{{ $message->name }}</p>
                                    <p class="text-xs text-ink/40">{{ $message->created_at->format('M d, Y') }}</p>
                                </div>
                                <span class="text-xs uppercase tracking-widest2 {{ $message->is_read ? 'text-ink/40' : 'text-gold' }}">
                                    {{ $message->is_read ? 'Read' : 'Unread' }}
                                </span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@endsection
