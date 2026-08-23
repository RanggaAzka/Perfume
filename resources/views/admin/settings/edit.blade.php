@extends('layouts.admin')

@section('title', 'Settings')

@section('content')
    <p class="max-w-lg text-sm text-ink/60">
        These details are optional. Anything left blank simply won't be shown on the public site
        (footer contact info, social links, or the refill service section) — nothing is invented
        on your behalf.
    </p>

    <form method="POST" action="{{ route('admin.settings.update') }}" class="mt-8 max-w-xl space-y-8">
        @csrf
        @method('PUT')

        <div>
            <label for="site_name" class="text-xs uppercase tracking-widest2 text-ink/50">Site Name</label>
            <input type="text" name="site_name" id="site_name" value="{{ old('site_name', $settings->site_name) }}"
                   placeholder="{{ config('app.name') }}"
                   class="mt-2 w-full border border-black/20 px-3 py-2 text-sm focus:border-gold focus:ring-0">
            <p class="mt-1 text-xs text-ink/40">Leave blank to use the default: {{ config('app.name') }}.</p>
            @error('site_name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="grid gap-6 sm:grid-cols-2">
            <div>
                <label for="contact_email" class="text-xs uppercase tracking-widest2 text-ink/50">Contact Email</label>
                <input type="email" name="contact_email" id="contact_email" value="{{ old('contact_email', $settings->contact_email) }}"
                       class="mt-2 w-full border border-black/20 px-3 py-2 text-sm focus:border-gold focus:ring-0">
                @error('contact_email') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="contact_phone" class="text-xs uppercase tracking-widest2 text-ink/50">Contact Phone</label>
                <input type="text" name="contact_phone" id="contact_phone" value="{{ old('contact_phone', $settings->contact_phone) }}"
                       class="mt-2 w-full border border-black/20 px-3 py-2 text-sm focus:border-gold focus:ring-0">
                @error('contact_phone') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="grid gap-6 sm:grid-cols-2">
            <div>
                <label for="instagram_url" class="text-xs uppercase tracking-widest2 text-ink/50">Instagram URL</label>
                <input type="url" name="instagram_url" id="instagram_url" value="{{ old('instagram_url', $settings->instagram_url) }}"
                       placeholder="https://instagram.com/perfu.me"
                       class="mt-2 w-full border border-black/20 px-3 py-2 text-sm focus:border-gold focus:ring-0">
                @error('instagram_url') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="tiktok_url" class="text-xs uppercase tracking-widest2 text-ink/50">TikTok URL</label>
                <input type="url" name="tiktok_url" id="tiktok_url" value="{{ old('tiktok_url', $settings->tiktok_url) }}"
                       placeholder="https://tiktok.com/@perfu.me"
                       class="mt-2 w-full border border-black/20 px-3 py-2 text-sm focus:border-gold focus:ring-0">
                @error('tiktok_url') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label for="address" class="text-xs uppercase tracking-widest2 text-ink/50">Store Address</label>
            <input type="text" name="address" id="address" value="{{ old('address', $settings->address) }}"
                   class="mt-2 w-full border border-black/20 px-3 py-2 text-sm focus:border-gold focus:ring-0">
            <p class="mt-1 text-xs text-ink/40">Only shown on the site once filled in — used by the Refill Service section.</p>
            @error('address') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="store_hours" class="text-xs uppercase tracking-widest2 text-ink/50">Store Hours</label>
            <input type="text" name="store_hours" id="store_hours" value="{{ old('store_hours', $settings->store_hours) }}"
                   placeholder="Mon–Sat, 10:00–20:00"
                   class="mt-2 w-full border border-black/20 px-3 py-2 text-sm focus:border-gold focus:ring-0">
            @error('store_hours') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="border-t border-black/10 pt-8">
            <p class="text-xs uppercase tracking-widest2 text-gold">WhatsApp Notifications (Fonnte)</p>
            <p class="mt-2 text-xs leading-relaxed text-ink/40">
                Get an instant WhatsApp alert on your phone whenever a customer submits a refill request,
                product order, or contact message. Create a device at fonnte.com, then paste its token here
                along with the destination number (format 628xxxxxxxxxx). Leave blank to disable notifications.
            </p>

            <div class="mt-4 grid gap-6 sm:grid-cols-2">
                <div>
                    <label for="fonnte_token" class="text-xs uppercase tracking-widest2 text-ink/50">Fonnte Device Token</label>
                    <input type="text" name="fonnte_token" id="fonnte_token" value="{{ old('fonnte_token', $settings->fonnte_token) }}"
                           placeholder="e.g. aBcDeFgH12345"
                           autocomplete="off"
                           class="mt-2 w-full border border-black/20 px-3 py-2 text-sm focus:border-gold focus:ring-0">
                    @error('fonnte_token') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="whatsapp_target" class="text-xs uppercase tracking-widest2 text-ink/50">Admin WhatsApp Number</label>
                    <input type="text" name="whatsapp_target" id="whatsapp_target" value="{{ old('whatsapp_target', $settings->whatsapp_target) }}"
                           placeholder="6281234567890"
                           class="mt-2 w-full border border-black/20 px-3 py-2 text-sm focus:border-gold focus:ring-0">
                    @error('whatsapp_target') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            @if ($sameAsDevice)
                <p class="mt-4 border border-red-300 bg-red-50 px-4 py-3 text-xs leading-relaxed text-red-700">
                    Heads up: the Admin WhatsApp Number is the same as the connected Fonnte device.
                    Messages to your own number land in the "Message yourself" chat (often archived) and do not ring.
                    Use a different number in production so notifications arrive as normal chats.
                </p>
            @endif
        </div>

        <button type="submit" class="w-full border border-ink px-5 py-3 text-xs uppercase tracking-widest2 hover:border-gold hover:text-gold sm:w-auto">
            Save Settings
        </button>
    </form>

    <div class="mt-8 max-w-xl border-t border-black/10 pt-8">
        <div class="grid gap-6 sm:grid-cols-2">
            <div class="border border-black/10 bg-white p-4">
                <p class="text-xs uppercase tracking-widest2 text-ink/40">Fonnte Device Status</p>
                @if ($device)
                    <dl class="mt-3 space-y-1 text-sm text-ink/70">
                        <div class="flex justify-between gap-4"><dt>Number</dt><dd>{{ $device['device'] ?? '-' }}</dd></div>
                        <div class="flex justify-between gap-4">
                            <dt>Status</dt>
                            <dd class="{{ ($device['device_status'] ?? '') === 'connect' ? 'text-green-700' : 'text-red-600' }}">
                                {{ $device['device_status'] ?? 'unknown' }}
                            </dd>
                        </div>
                        <div class="flex justify-between gap-4"><dt>Quota left</dt><dd>{{ $device['quota'] ?? '-' }}</dd></div>
                        <div class="flex justify-between gap-4"><dt>Valid until</dt><dd>{{ $device['expired'] ?? '-' }}</dd></div>
                    </dl>
                @else
                    <p class="mt-2 text-sm text-ink/50">Device info unavailable — check the token or fonnte.com.</p>
                @endif
            </div>

            <form method="POST" action="{{ route('admin.settings.test-whatsapp') }}" class="self-end">
                @csrf
                <button type="submit"
                        class="border border-gold px-5 py-2 text-xs uppercase tracking-widest2 text-gold transition hover:bg-gold hover:text-white">
                    Send Test WhatsApp
                </button>
                <p class="mt-2 text-xs text-ink/40">Save settings first, then click this to verify the notification reaches your phone.</p>
            </form>
        </div>
    </div>
@endsection
