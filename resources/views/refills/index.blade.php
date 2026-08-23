@extends('layouts.app')

@section('title', 'Refill Collection — ' . config('app.name'))
@section('meta_description', 'A curated selection of fragrances available for refill in-store.')

@section('content')
    <section class="mx-auto max-w-4xl px-6 pb-24 pt-40 md:px-10">
        <p class="section-label">Refill</p>
        <h1 class="mt-3 font-serif text-5xl">Refill Collection</h1>
        <p class="mt-6 max-w-lg text-sm leading-relaxed text-ink/60">
            A curated selection of fragrances available for refill in-store. Bring a bottle back to life,
            or discover a new scent to carry forward.
        </p>

        <div class="mt-12 max-w-xl border border-black/10">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="border-b border-black/10">
                        <th scope="col" class="px-6 py-4 text-xs font-normal uppercase tracking-widest2 text-ink/50">Bottle Size</th>
                        <th scope="col" class="px-6 py-4 text-right text-xs font-normal uppercase tracking-widest2 text-ink/50">Refill Price</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-black/5">
                    @foreach ($bottleSizes as $ml => $price)
                        <tr>
                            <td class="px-6 py-4 font-serif text-base">{{ $ml }} ml</td>
                            <td class="px-6 py-4 text-right font-serif text-base">{{ $price }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <p class="border-t border-black/10 px-6 py-3 text-xs uppercase tracking-widest2 text-ink/40">
                Refill price: Rp {{ number_format($pricePerMl, 0, ',', '.') }} / ml
            </p>
        </div>

        @if (session('status'))
            <div class="mt-8 border border-gold/40 bg-gold/10 px-4 py-3 text-sm">
                {{ session('status') }}
            </div>
        @endif

        @if ($grouped->isEmpty())
            <p class="mt-16 text-sm text-ink/50">New fragrances are being added to the refill counter — please check back soon.</p>
        @else
            <div class="mt-16 divide-y divide-black/10">
                @foreach ($grouped as $letter => $refills)
                    <div class="grid gap-6 py-10 md:grid-cols-[80px_1fr]">
                        <p class="font-serif text-4xl italic text-ink/30">{{ $letter }}</p>
                        <ul class="grid gap-x-8 gap-y-3 sm:grid-cols-2">
                            @foreach ($refills as $refill)
                                <li>
                                    <button type="button" data-refill="{{ $refill->name }}"
                                            class="refill-option w-full text-left font-serif text-lg transition hover:text-gold focus:outline-none focus-visible:text-gold">
                                        {{ $refill->name }}
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>

            <div id="refill-request" class="mt-16 border-t border-black/10 pt-10">
                <form method="POST" action="{{ route('contact.store') }}" class="space-y-6">
                    @csrf
                    <input type="hidden" name="type" value="refill">

                    <div class="flex flex-wrap items-baseline justify-between gap-4">
                        <h2 class="font-serif text-2xl">Request a Refill</h2>
                        <span id="selected-refill"
                              class="{{ old('message') ? '' : 'hidden' }} text-xs uppercase tracking-widest2 text-gold">
                            {{ old('selected_refill') }}
                        </span>
                    </div>

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
                        <label for="bottle_size" class="text-xs uppercase tracking-widest2 text-ink/50">Bottle Size</label>
                        <select name="bottle_size" id="bottle_size"
                                class="mt-2 w-full border-0 border-b border-black/20 bg-transparent px-0 py-2 text-sm focus:border-gold focus:ring-0">
                            <option value="">Select a bottle size</option>
                            @foreach ($bottleSizes as $ml => $price)
                                <option value="{{ $ml }}" @selected(old('bottle_size') == $ml)>{{ $ml }} ml — {{ $price }}</option>
                            @endforeach
                        </select>
                        @error('bottle_size') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <input type="hidden" name="selected_refill" value="{{ old('selected_refill') }}">

                    <div>
                        <label for="message" class="text-xs uppercase tracking-widest2 text-ink/50">Message</label>
                        <textarea name="message" id="message" rows="4" required
                                  class="mt-2 w-full border-0 border-b border-black/20 bg-transparent px-0 py-2 text-sm focus:border-gold focus:ring-0">{{ old('message') }}</textarea>
                        @error('message') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <button type="submit"
                            class="border border-ink px-8 py-3 text-sm uppercase tracking-widest2 transition hover:border-gold hover:text-gold">
                        Send Refill Request
                    </button>
                </form>
            </div>
        @endif

        <div class="mt-16 border-t border-black/10 pt-10 text-sm text-ink/60">
            <p>Refill availability is subject to change. Visit us in-store or get in touch to check on a specific scent.</p>
            <a href="{{ route('contact.create') }}" class="mt-4 inline-block w-fit border-b border-ink/40 pb-1 text-sm text-ink transition hover:border-gold hover:text-gold">
                Contact Us
            </a>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var options = document.querySelectorAll('.refill-option');
            if (!options.length) return;

            var messageField = document.getElementById('message');
            var indicator = document.getElementById('selected-refill');
            var hiddenRefill = document.querySelector('input[name="selected_refill"]');
            var sizeField = document.getElementById('bottle_size');
            var form = indicator ? indicator.closest('form') : null;
            var current = '';

            function selectedSize() {
                return sizeField && sizeField.value ? sizeField.value : '';
            }

            function composeMessage(name) {
                var size = selectedSize();
                return size
                    ? 'Hello, I would like to request a refill for "' + name + '" — ' + size + ' ml.'
                    : 'Hello, I would like to request a refill for "' + name + '".';
            }

            function updateIndicator(name) {
                if (!indicator) return;
                var size = selectedSize();
                indicator.textContent = 'Selected: ' + name + (size ? ' \u00B7 ' + size + ' ml' : '');
                indicator.classList.remove('hidden');
            }

            function selectRefill(name) {
                current = name;
                options.forEach(function (option) {
                    option.classList.toggle('text-gold', option.dataset.refill === name);
                });

                messageField.value = composeMessage(name);
                updateIndicator(name);

                if (hiddenRefill) {
                    hiddenRefill.value = name;
                }

                if (form) {
                    form.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
                messageField.focus();
            }

            options.forEach(function (option) {
                option.addEventListener('click', function () {
                    selectRefill(this.dataset.refill);
                });
            });

            if (sizeField) {
                sizeField.addEventListener('change', function () {
                    if (!current) return;
                    messageField.value = composeMessage(current);
                    updateIndicator(current);
                });
            }
        });
    </script>
@endsection
