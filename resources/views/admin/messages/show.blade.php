@extends('layouts.admin')

@section('title', 'Message from ' . $message->name)

@section('content')
    <a href="{{ route('admin.messages.index') }}" class="text-xs uppercase tracking-widest2 text-ink/50 hover:text-gold">&larr; Back to Messages</a>

    <div class="mt-6 max-w-2xl border border-black/10 bg-white p-8">
        <div class="flex items-start justify-between">
            <div>
                <p class="font-serif text-2xl">{{ $message->name }}</p>
                <p class="mt-1 text-sm text-ink/50">{{ $message->email }}</p>
                @if ($message->phone)
                    <p class="mt-1 text-sm text-ink/50">{{ $message->phone }}</p>
                @endif
            </div>
            <div class="text-right">
                <span class="block text-xs uppercase tracking-widest2 text-gold">{{ $message->type_label }}</span>
                <span class="mt-1 block text-xs uppercase tracking-widest2 text-ink/40">{{ $message->created_at->format('M d, Y \a\t g:i A') }}</span>
            </div>
        </div>

        <div class="mt-6 whitespace-pre-line border-t border-black/10 pt-6 text-sm leading-relaxed text-ink/70">
            {{ $message->message }}
        </div>

        @if ($message->orderItems->isNotEmpty())
            <div class="mt-6 border-t border-black/10 pt-6">
                <p class="text-xs uppercase tracking-widest2 text-ink/40">Order Items ({{ $message->orderItems->count() }})</p>
                <div class="mt-3 overflow-x-auto border border-black/10">
                    <table class="min-w-full divide-y divide-black/10 text-sm">
                        <thead>
                            <tr class="text-left text-[11px] uppercase tracking-widest2 text-ink/40">
                                <th class="px-4 py-2.5">Item</th>
                                <th class="px-4 py-2.5">Size</th>
                                <th class="px-4 py-2.5">Qty</th>
                                <th class="px-4 py-2.5">Unit Price</th>
                                <th class="px-4 py-2.5 text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-black/10">
                            @foreach ($message->orderItems as $item)
                                <tr>
                                    <td class="px-4 py-3 font-serif">{{ $item->label }}</td>
                                    <td class="px-4 py-3 text-ink/70">{{ $item->bottle_size ? $item->bottle_size . ' ml' : '30ml EDP' }}</td>
                                    <td class="px-4 py-3 text-ink/70">{{ $item->quantity }}</td>
                                    <td class="px-4 py-3 text-ink/70">Rp {{ number_format($item->unit_price, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3 text-right">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="border-t border-black/10 bg-[#fafaf8]">
                                <td colspan="4" class="px-4 py-3 text-xs uppercase tracking-widest2 text-ink/50 text-right">Total</td>
                                <td class="px-4 py-3 text-right font-medium">Rp {{ number_format($message->orderItems->sum('subtotal'), 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        @endif

        <div class="mt-8 flex flex-wrap gap-4 border-t border-black/10 pt-6 text-xs uppercase tracking-widest2">
            <a href="mailto:{{ $message->email }}" class="border border-ink px-4 py-2 hover:border-gold hover:text-gold">Reply by Email</a>

            @if ($message->phone)
                <a href="https://wa.me/{{ app(App\Services\FonnteService::class)->normalizeTarget($message->phone) }}"
                   target="_blank" rel="noopener"
                   class="border border-green-600 px-4 py-2 text-green-700 hover:bg-green-600 hover:text-white">
                    Open WhatsApp Chat
                </a>
            @endif

            @if ($message->is_read)
                <form method="POST" action="{{ route('admin.messages.unread', $message) }}">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="border border-black/20 px-4 py-2 text-ink/60 hover:border-gold hover:text-gold">Mark as Unread</button>
                </form>
            @endif

            <form method="POST" action="{{ route('admin.messages.destroy', $message) }}"
                  onsubmit="return confirm('Delete this message?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="border border-black/20 px-4 py-2 text-red-600 hover:border-red-600">Delete</button>
            </form>
        </div>
    </div>

    @if ($message->replies->isNotEmpty())
        <div class="mt-6 max-w-2xl border border-black/10 bg-white p-8">
            <p class="text-xs uppercase tracking-widest2 text-ink/40">Replies ({{ $message->replies->count() }})</p>

            <ul class="mt-4 space-y-4">
                @foreach ($message->replies as $reply)
                    <li class="border-l-2 border-gold bg-[#fafaf8] px-4 py-3">
                        <p class="whitespace-pre-line text-sm leading-relaxed text-ink/70">{{ $reply->message }}</p>
                        <p class="mt-2 text-xs text-ink/40">{{ $reply->created_at->format('M d, Y \a\t g:i A') }} — via WhatsApp</p>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="mt-6 max-w-2xl border border-black/10 bg-white p-8">
        <p class="text-xs uppercase tracking-widest2 text-ink/40">
            {{ $message->phone ? 'Reply via WhatsApp to ' . $message->phone : 'Reply unavailable' }}
        </p>

        @if ($message->phone)
            <form method="POST" action="{{ route('admin.messages.reply', $message) }}" class="mt-4 space-y-4">
                @csrf
                <textarea name="reply_message" rows="4" required placeholder="Write your reply..."
                          class="w-full border border-black/20 px-3 py-2 text-sm focus:border-gold focus:ring-0">{{ old('reply_message') }}</textarea>
                @error('reply_message') <p class="text-xs text-red-600">{{ $errors->first('reply_message') }}</p> @enderror

                <button type="submit"
                        class="border border-ink px-5 py-2 text-xs uppercase tracking-widest2 transition hover:border-gold hover:text-gold">
                    Send Reply
                </button>
            </form>
        @else
            <p class="mt-2 text-sm text-ink/50">This customer did not leave a phone number, so a WhatsApp reply is not possible.</p>
        @endif
    </div>
@endsection
