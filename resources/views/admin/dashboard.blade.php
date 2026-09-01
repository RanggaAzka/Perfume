@extends('layouts.admin')

@section('title', 'Overview')

@section('content')
    @if ($unreadMessages > 0)
        <div class="mb-8 flex flex-wrap items-center justify-between gap-4 border border-[#b79a5a]/40 bg-[#b79a5a]/10 px-6 py-4 transition hover:border-[#b79a5a]">
            <div class="flex items-center gap-3">
                <span class="flex h-8 w-8 items-center justify-center rounded-full bg-[#b79a5a] text-white text-xs font-bold">
                    {{ $unreadMessages }}
                </span>
                <p class="text-xs sm:text-sm text-[#111111] font-sans">
                    Ada <strong>{{ $unreadMessages }}</strong> pesan / pesanan baru menunggu konfirmasi Anda.
                </p>
            </div>
            <a href="{{ route('admin.messages.index', ['status' => 'unread']) }}"
               class="bg-[#111111] text-white hover:bg-[#b79a5a] px-4 py-2 text-xs uppercase tracking-widest transition">
                Buka Pesan &rarr;
            </a>
        </div>
    @endif

    {{-- Stats Grid --}}
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
        @foreach ([
            ['label' => 'Signature Products', 'value' => $totalProducts, 'icon' => 'bottle'],
            ['label' => 'Active in Store', 'value' => $activeProducts, 'icon' => 'check'],
            ['label' => 'Refill Aromas', 'value' => $refillCount, 'icon' => 'droplet'],
            ['label' => 'Unread Messages', 'value' => $unreadMessages, 'icon' => 'mail'],
        ] as $stat)
            <div class="group border border-[#111111]/10 bg-white p-6 transition-all duration-300 hover:border-[#111111]/30 hover:shadow-md">
                <p class="text-[11px] font-sans font-medium uppercase tracking-widest text-[#111111]/50">{{ $stat['label'] }}</p>
                <p class="mt-3 font-serif text-3xl sm:text-4xl text-[#111111] font-normal group-hover:text-[#b79a5a] transition-colors">{{ $stat['value'] }}</p>
            </div>
        @endforeach
    </div>

    {{-- Recent Feeds Split Grid --}}
    <div class="mt-10 grid gap-8 lg:grid-cols-2">
        {{-- Recent Products --}}
        <div class="border border-[#111111]/10 bg-white shadow-sm">
            <div class="flex items-center justify-between border-b border-[#111111]/10 px-6 py-4 bg-[#f7f7f5]">
                <h2 class="text-xs uppercase tracking-widest text-[#111111]/60 font-medium">Recent Products</h2>
                <a href="{{ route('admin.products.index') }}" class="text-xs uppercase tracking-widest text-[#b79a5a] hover:text-[#111111] font-medium transition">View All &rarr;</a>
            </div>

            @if ($recentProducts->isEmpty())
                <p class="px-6 py-10 text-center text-xs text-[#111111]/50 font-light">Belum ada produk signature yang ditambahkan.</p>
            @else
                <ul class="divide-y divide-[#111111]/10">
                    @foreach ($recentProducts as $product)
                        <li class="flex items-center justify-between px-6 py-4 hover:bg-[#f7f7f5] transition">
                            <div class="flex items-center gap-4 min-w-0">
                                <img src="{{ $product->imageUrl() }}" alt="{{ $product->name }}" class="h-12 w-12 rounded border border-[#111111]/10 bg-[#f7f7f5] object-contain p-1 shrink-0">
                                <div class="min-w-0">
                                    <p class="font-serif text-base text-[#111111] truncate">{{ $product->name }}</p>
                                    <p class="text-[11px] text-[#111111]/50 font-sans">{{ $product->priceFormatted() }} · {{ $product->created_at->format('d M Y') }}</p>
                                </div>
                            </div>
                            <span class="shrink-0 px-2.5 py-1 text-[10px] uppercase tracking-widest font-medium rounded-full {{ $product->is_active ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-gray-100 text-gray-500' }}">
                                {{ $product->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        {{-- Recent Messages --}}
        <div class="border border-[#111111]/10 bg-white shadow-sm">
            <div class="flex items-center justify-between border-b border-[#111111]/10 px-6 py-4 bg-[#f7f7f5]">
                <h2 class="text-xs uppercase tracking-widest text-[#111111]/60 font-medium">Recent Customer Messages</h2>
                <a href="{{ route('admin.messages.index') }}" class="text-xs uppercase tracking-widest text-[#b79a5a] hover:text-[#111111] font-medium transition">View All &rarr;</a>
            </div>

            @if ($recentMessages->isEmpty())
                <p class="px-6 py-10 text-center text-xs text-[#111111]/50 font-light">Belum ada pesan pelanggan yang masuk.</p>
            @else
                <ul class="divide-y divide-[#111111]/10">
                    @foreach ($recentMessages as $message)
                        <li>
                            <a href="{{ route('admin.messages.show', $message) }}" class="flex items-center justify-between px-6 py-4 hover:bg-[#f7f7f5] transition">
                                <div class="min-w-0 flex-1 pr-4">
                                    <div class="flex items-center gap-2">
                                        <p class="font-serif text-base text-[#111111] truncate">{{ $message->name }}</p>
                                        <span class="text-[10px] uppercase tracking-widest text-[#b79a5a] font-medium">· {{ $message->type_label }}</span>
                                    </div>
                                    <p class="text-[11px] text-[#111111]/50 font-sans truncate">{{ $message->created_at->diffForHumans() }}</p>
                                </div>
                                <span class="shrink-0 px-2.5 py-1 text-[10px] uppercase tracking-widest font-medium rounded-full {{ $message->is_read ? 'bg-gray-100 text-gray-500' : 'bg-[#b79a5a]/15 text-[#b79a5a] border border-[#b79a5a]/30' }}">
                                    {{ $message->is_read ? 'Read' : 'New' }}
                                </span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@endsection
