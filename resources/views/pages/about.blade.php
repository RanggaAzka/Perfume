@extends('layouts.app')

@section('title', 'About — ' . config('app.name'))
@section('meta_description', 'Learn about the house behind the fragrance.')

@section('content')
    <section class="mx-auto max-w-4xl px-6 pb-24 pt-40 text-center md:px-10">
        <p class="section-label">About Us</p>
        <h1 class="mt-4 font-serif text-5xl leading-tight">Fragrance, without compromise.</h1>
        <p class="mx-auto mt-8 max-w-2xl text-sm leading-relaxed text-ink/60">
            We believe premium fragrance should be judged by what's in the bottle, not the name on the box.
            Every scent we release is developed in small batches, tested for longevity and character, and
            priced honestly. No filler, no shortcuts — just fragrance worth wearing every day.
        </p>
    </section>

    <section class="grid gap-px bg-black/10 md:grid-cols-3">
        @foreach ([
            ['title' => 'Considered Composition', 'body' => 'Every note is chosen with intent — nothing added simply to fill a bottle.'],
            ['title' => 'Honest Pricing', 'body' => 'Premium character without the premium markup that comes from a famous name.'],
            ['title' => 'Built to Last', 'body' => 'Formulated for genuine longevity, not just a strong first impression.'],
        ] as $item)
            <div class="bg-white p-10">
                <h2 class="font-serif text-xl">{{ $item['title'] }}</h2>
                <p class="mt-3 text-sm leading-relaxed text-ink/60">{{ $item['body'] }}</p>
            </div>
        @endforeach
    </section>
@endsection
