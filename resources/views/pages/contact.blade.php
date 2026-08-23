@extends('layouts.app')

@section('title', 'Contact — ' . config('app.name'))
@section('meta_description', 'Get in touch with the house.')

@section('content')
    <section class="mx-auto max-w-xl px-6 pb-24 pt-40 md:px-10">
        <p class="section-label">Contact</p>
        <h1 class="mt-3 font-serif text-4xl leading-tight md:text-5xl">Have a question about our fragrances?</h1>
        <p class="mt-6 text-sm leading-relaxed text-ink/60">
            Whether it's about a signature scent or checking on a refill in-store, we'd love to hear from you.
        </p>

        @if (session('status'))
            <div class="mt-8 border border-gold/40 bg-gold/10 px-4 py-3 text-sm">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('contact.store') }}" class="mt-10 space-y-6">
            @csrf
            <input type="hidden" name="type" value="contact">

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
                <textarea name="message" id="message" rows="5" required
                          class="mt-2 w-full border-0 border-b border-black/20 bg-transparent px-0 py-2 text-sm focus:border-gold focus:ring-0">{{ old('message') }}</textarea>
                @error('message') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <button type="submit"
                    class="border border-ink px-8 py-3 text-sm uppercase tracking-widest2 transition hover:border-gold hover:text-gold">
                Send Message
            </button>
        </form>

        @if ($siteSettings && ($siteSettings->contact_email || $siteSettings->contact_phone || $siteSettings->address || $siteSettings->store_hours))
            <div class="mt-16 border-t border-black/10 pt-10 text-sm text-ink/60">
                <p class="text-xs uppercase tracking-widest2 text-ink/40">Direct</p>
                <ul class="mt-4 space-y-2">
                    @if ($siteSettings->contact_email)
                        <li><a href="mailto:{{ $siteSettings->contact_email }}" class="hover:text-gold">{{ $siteSettings->contact_email }}</a></li>
                    @endif
                    @if ($siteSettings->contact_phone)
                        <li>{{ $siteSettings->contact_phone }}</li>
                    @endif
                    @if ($siteSettings->address)
                        <li>{{ $siteSettings->address }}</li>
                    @endif
                    @if ($siteSettings->store_hours)
                        <li>{{ $siteSettings->store_hours }}</li>
                    @endif
                </ul>
            </div>
        @endif
    </section>
@endsection
