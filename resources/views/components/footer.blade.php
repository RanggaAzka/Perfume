@php $brandName = $siteSettings->site_name ?? config('app.name'); @endphp

<footer class="border-t border-black/10 bg-white">
    <div class="mx-auto grid max-w-7xl gap-12 px-6 py-16 md:grid-cols-4 md:px-10">
        <div class="md:col-span-2">
            <p class="font-serif text-2xl italic">{{ $brandName }}</p>
            <p class="mt-4 max-w-sm text-sm leading-relaxed text-ink/60">
                Signature fragrances for every expression — with a curated refill collection available in-store.
            </p>
        </div>

        <div>
            <p class="section-label">Navigate</p>
            <ul class="mt-4 space-y-3 text-sm text-ink/70">
                <li><a href="{{ route('products.index') }}" class="hover:text-gold">Collection</a></li>
                <li><a href="{{ route('refills.index') }}" class="hover:text-gold">Refill</a></li>
                <li><a href="{{ route('story') }}" class="hover:text-gold">Story</a></li>
                <li><a href="{{ route('contact.create') }}" class="hover:text-gold">Contact</a></li>
            </ul>
        </div>

        <div>
            <p class="section-label">Contact</p>
            <ul class="mt-4 space-y-3 text-sm text-ink/70">
                <li><a href="{{ route('contact.create') }}" class="hover:text-gold">Get in touch</a></li>
                @if ($siteSettings?->contact_email)
                    <li><a href="mailto:{{ $siteSettings->contact_email }}" class="hover:text-gold">{{ $siteSettings->contact_email }}</a></li>
                @endif
                @if ($siteSettings?->contact_phone)
                    <li>{{ $siteSettings->contact_phone }}</li>
                @endif
                @if ($siteSettings?->instagram_url || $siteSettings?->tiktok_url)
                    <li class="flex gap-4 pt-2">
                        @if ($siteSettings->instagram_url)
                            <a href="{{ $siteSettings->instagram_url }}" target="_blank" rel="noopener" aria-label="Instagram" class="hover:text-gold">Instagram</a>
                        @endif
                        @if ($siteSettings->tiktok_url)
                            <a href="{{ $siteSettings->tiktok_url }}" target="_blank" rel="noopener" aria-label="TikTok" class="hover:text-gold">TikTok</a>
                        @endif
                    </li>
                @endif
            </ul>
        </div>
    </div>

    <div class="border-t border-black/10 px-6 py-6 text-center text-xs text-ink/50 md:px-10">
        &copy; {{ date('Y') }} {{ $brandName }}. All rights reserved.
    </div>
</footer>
