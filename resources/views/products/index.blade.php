@extends('layouts.app')

@section('title', 'Our Collection — ' . config('app.name'))
@section('meta_description', 'Browse the full collection of fragrances, each crafted with premium character.')

@section('content')
    <section class="mx-auto max-w-7xl px-6 pb-24 pt-40 md:px-10">
        <div class="mb-16 max-w-lg">
            <p class="section-label">Collection</p>
            <h1 class="mt-3 font-serif text-5xl">Our Collection</h1>
        </div>

        @if ($products->isEmpty())
            <p class="text-sm text-ink/60">New scents are on their way — please check back soon.</p>
        @else
            <div class="grid gap-16 md:grid-cols-2">
                @foreach ($products as $product)
                    <a href="{{ route('products.show', $product) }}" class="group block">
                        <div class="relative overflow-hidden bg-[#f4f4f2]">
                            <img src="{{ $product->imageUrl() }}" alt="{{ $product->name }}" loading="lazy"
                                 class="h-96 w-full object-contain p-10 transition duration-700 group-hover:scale-105">
                        </div>
                        <div class="mt-6 flex items-start justify-between gap-4">
                            <div>
                                <h2 class="font-serif text-2xl">{{ $product->name }}</h2>
                                <p class="mt-2 max-w-xs text-sm text-ink/60">{{ $product->short_description }}</p>
                                @if ($product->fragranceNotes->isNotEmpty())
                                    <p class="mt-3 text-xs uppercase tracking-widest2 text-ink/40">
                                        {{ $product->fragranceNotes->pluck('name')->join(' · ') }}
                                    </p>
                                @endif
                            </div>
                            <span class="whitespace-nowrap text-xs uppercase tracking-widest2 text-gold">Discover</span>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </section>
@endsection
