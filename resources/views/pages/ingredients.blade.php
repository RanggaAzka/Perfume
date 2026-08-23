@extends('layouts.app')

@section('title', 'Ingredients — ' . config('app.name'))
@section('meta_description', 'Explore the notes used across the PERFU.ME fragrance collection.')

@section('content')
    <section class="mx-auto max-w-3xl px-6 pb-24 pt-40 md:px-10">
        <div class="text-center">
            <p class="section-label">The Notes</p>
            <h1 class="mt-3 font-serif text-5xl">Fragrance Journal</h1>
            <p class="mx-auto mt-6 max-w-md text-sm leading-relaxed text-ink/60">
                Every fragrance we release is composed in three movements — top, heart, and base —
                each note chosen with intent, never simply to fill a bottle.
            </p>
        </div>

        @if ($notes->isEmpty())
            <p class="mt-16 text-center text-sm text-ink/50">Notes will appear here as fragrances are added.</p>
        @else
            <div class="mt-20 space-y-16">
                @foreach (['top' => 'Top', 'heart' => 'Heart', 'base' => 'Base'] as $key => $label)
                    @if ($grouped->has($key) && $grouped[$key]->isNotEmpty())
                        <div class="border-t border-black/10 pt-10 text-center">
                            <p class="text-xs uppercase tracking-widest2 text-ink/40">{{ $label }}</p>
                            <div class="mx-auto mt-6 flex max-w-xl flex-wrap justify-center gap-x-8 gap-y-4">
                                @foreach ($grouped[$key] as $note)
                                    <span class="font-serif text-2xl">{{ $note->name }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif
    </section>
@endsection
