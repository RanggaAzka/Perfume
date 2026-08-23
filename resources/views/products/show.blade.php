@extends('layouts.app')

@section('title', $product->name . ' — ' . config('app.name'))
@section('meta_description', $product->short_description)

@section('content')
    @if (session('status'))
        <div class="mx-auto max-w-3xl px-6 pt-40 md:px-10">
            <div class="border border-gold/40 bg-gold/10 px-4 py-3 text-sm">
                {{ session('status') }}
            </div>
        </div>
    @endif

    {{-- Campaign header --}}
    <section class="px-6 pb-16 {{ session('status') ? 'pt-12' : 'pt-40' }} text-center md:px-10">
        <p class="section-label">Collection</p>
        <h1 class="mt-4 font-serif text-6xl italic md:text-7xl">{{ $product->name }}</h1>
    </section>

    {{-- Large product image --}}
    <section class="mx-auto max-w-3xl px-6 md:px-10">
        <div class="bg-[#f4f4f2]">
            <img src="{{ $product->imageUrl() }}" alt="{{ $product->name }}" class="h-[480px] w-full object-contain p-12 md:h-[600px]">
        </div>
        <p class="mx-auto mt-8 max-w-lg text-center text-sm leading-relaxed text-ink/60">
            {{ $product->short_description }}
        </p>
    </section>

    {{-- Olfactive detail --}}
    <section class="mx-auto max-w-3xl px-6 py-20 md:px-10">
        <div class="border-t border-black/10 pt-12">
            @if ($product->fragrance_family)
                <div class="text-center">
                    <p class="text-xs uppercase tracking-widest2 text-ink/40">Olfactive Family</p>
                    <p class="mt-2 font-serif text-2xl">{{ $product->fragrance_family }}</p>
                </div>
            @endif

            @php
                $top = $product->topNotes();
                $heart = $product->heartNotes();
                $base = $product->baseNotes();
            @endphp

            @if ($top->isNotEmpty() || $heart->isNotEmpty() || $base->isNotEmpty())
                <div class="mt-14 grid gap-10 text-center sm:grid-cols-3">
                    <div>
                        <p class="text-xs uppercase tracking-widest2 text-ink/40">Top Notes</p>
                        <p class="mt-3 font-serif text-xl leading-snug">
                            {{ $top->isNotEmpty() ? $top->pluck('name')->join(', ') : '&mdash;' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-widest2 text-ink/40">Heart Notes</p>
                        <p class="mt-3 font-serif text-xl leading-snug">
                            {{ $heart->isNotEmpty() ? $heart->pluck('name')->join(', ') : '&mdash;' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-widest2 text-ink/40">Base Notes</p>
                        <p class="mt-3 font-serif text-xl leading-snug">
                            {{ $base->isNotEmpty() ? $base->pluck('name')->join(', ') : '&mdash;' }}
                        </p>
                    </div>
                </div>
            @endif

            @if ($product->longevity)
                <div class="mt-14 text-center">
                    <p class="text-xs uppercase tracking-widest2 text-ink/40">Longevity</p>
                    <p class="mt-2 font-serif text-2xl">{{ $product->longevity }}</p>
                </div>
            @endif
        </div>

        {{-- The Olfactive Journey --}}
        @if ($top->isNotEmpty() || $heart->isNotEmpty() || $base->isNotEmpty())
            <div class="mt-20 border-t border-black/10 pt-14 text-center">
                <p class="section-label">The Olfactive Journey</p>
                <div class="mx-auto mt-8 flex max-w-xs flex-col items-center gap-6">
                    <p class="font-serif text-lg tracking-widest2">TOP</p>
                    <span class="text-ink/30">&darr;</span>
                    <p class="font-serif text-lg tracking-widest2">HEART</p>
                    <span class="text-ink/30">&darr;</span>
                    <p class="font-serif text-lg tracking-widest2">BASE</p>
                </div>
            </div>
        @endif

        @php
            $orderMessage = old('message', 'Hello, I would like to order "' . $product->name . '". Is it available in-store?');
        @endphp

        <div id="enquire" class="mt-16 border-t border-black/10 pt-12">
            <form method="POST" action="{{ route('contact.store') }}" class="mx-auto max-w-xl space-y-6">
                @csrf
                <input type="hidden" name="type" value="product">
                <input type="hidden" name="product_name" value="{{ $product->name }}">

                <h2 class="text-center font-serif text-2xl">Order &amp; Enquiry</h2>
                <p class="mx-auto max-w-md text-center text-sm text-ink/60">
                    Interested in {{ $product->name }}? Leave your details and our team will get back to you.
                </p>

                <div>
                    <label for="name" class="text-xs uppercase tracking-widest2 text-ink/50">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                           class="mt-2 w-full border-0 border-b border-black/20 bg-transparent px-0 py-2 text-sm focus:border-gold focus:ring-0">
                    @error('name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="email" class="text-xs uppercase tracking-widest2 text-ink/50">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                           class="mt-2 w-full border-0 border-b border-black/20 bg-transparent px-0 py-2 text-sm focus:border-gold focus:ring-0">
                    @error('email') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="phone" class="text-xs uppercase tracking-widest2 text-ink/50">Phone (WhatsApp)</label>
                    <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" required
                           placeholder="+62 8xx xxxx xxxx"
                           class="mt-2 w-full border-0 border-b border-black/20 bg-transparent px-0 py-2 text-sm focus:border-gold focus:ring-0">
                    @error('phone') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="message" class="text-xs uppercase tracking-widest2 text-ink/50">Message</label>
                    <textarea name="message" id="message" rows="4" required
                              class="mt-2 w-full border-0 border-b border-black/20 bg-transparent px-0 py-2 text-sm focus:border-gold focus:ring-0">{{ $orderMessage }}</textarea>
                    @error('message') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <button type="submit"
                        class="border border-ink px-8 py-3 text-sm uppercase tracking-widest2 transition hover:border-gold hover:text-gold">
                    Send Order Request
                </button>
            </form>
        </div>
    </section>

    {{-- Discover another scent --}}
    @if ($related->isNotEmpty())
        <section class="border-t border-black/10 px-6 py-20 md:px-10">
            <p class="section-label mx-auto mb-10 max-w-3xl text-center">Discover Another Scent</p>
            <div class="mx-auto flex max-w-3xl flex-col gap-16">
                @foreach ($related as $item)
                    <a href="{{ route('products.show', $item) }}" class="group grid items-center gap-8 sm:grid-cols-[160px_1fr]">
                        <img src="{{ $item->imageUrl() }}" alt="{{ $item->name }}" loading="lazy"
                             class="h-40 w-full object-contain transition duration-700 group-hover:scale-105">
                        <div>
                            <h3 class="font-serif text-2xl italic">{{ $item->name }}</h3>
                            <p class="mt-1 text-sm text-ink/60">{{ $item->short_description }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    @endif
@endsection
