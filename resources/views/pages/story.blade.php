@extends('layouts.app')

@section('title', 'Our Story — ' . config('app.name'))
@section('meta_description', 'The story behind PERFU.ME and its first two signature fragrances.')

@section('content')
    {{-- Opening statement --}}
    <section class="px-6 pb-16 pt-40 text-center md:px-10">
        <p class="section-label">Our Story</p>
        <h1 class="mx-auto mt-6 max-w-2xl font-serif text-4xl leading-tight md:text-5xl">
            A brand built around the idea that fragrance is personal.
        </h1>
    </section>

    {{-- Image / text composition --}}
    <section class="mx-auto grid max-w-6xl gap-12 px-6 pb-20 md:grid-cols-2 md:items-center md:px-10">
        <div class="reveal order-2 md:order-1">
            <p class="text-sm leading-relaxed text-ink/70">
                The house began with a question: why does exceptional fragrance so often come with an
                exceptional price tag? Our founders — perfumers by training, skeptics by nature — set out to
                prove that character, craft, and longevity don't require a designer markup.
            </p>
            <p class="mt-6 text-sm leading-relaxed text-ink/70">
                Vanessence was the first scent to leave the lab, built around a simple idea: warmth doesn't
                need to be loud. Dynamyst followed soon after, composed for the version of you that's always
                moving forward. Both were refined over dozens of iterations before either ever reached a bottle.
            </p>
        </div>
        <div class="reveal order-1 md:order-2">
            <img src="{{ asset('images/brand-story.svg') }}" alt="PERFU.ME fragrance crafting"
                 loading="lazy" class="h-full w-full object-cover">
        </div>
    </section>

    {{-- Closing statement --}}
    <section class="border-t border-black/10 px-6 py-20 text-center md:px-10">
        <p class="mx-auto max-w-lg text-sm leading-relaxed text-ink/70">
            Today the house continues on the same principle it started with — considered composition,
            honest pricing, and fragrance built to be worn, not just admired on a shelf. Alongside our
            signature scents, our refill counter carries a curated directory of familiar names for
            everyday rediscovery.
        </p>
        <a href="{{ route('products.index') }}"
           class="mt-8 inline-block w-fit border-b border-ink/40 pb-1 text-sm text-ink transition hover:border-gold hover:text-gold">
            Explore The Collection
        </a>
    </section>
@endsection
