@extends('layouts.admin')

@section('title', 'Contact Messages')

@section('content')
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <form method="GET" class="flex flex-wrap gap-3">
            <select name="type" onchange="this.form.submit()" class="border border-black/20 px-3 py-2 text-sm focus:border-gold focus:ring-0">
                <option value="">All types</option>
                @foreach ([
                    \App\Models\ContactMessage::TYPE_CONTACT => 'Contact',
                    \App\Models\ContactMessage::TYPE_REFILL => 'Refill Request',
                    \App\Models\ContactMessage::TYPE_PRODUCT => 'Product Inquiry',
                    \App\Models\ContactMessage::TYPE_ORDER => 'Order',
                ] as $type => $label)
                    <option value="{{ $type }}" @selected(request('type') === $type)>{{ $label }}</option>
                @endforeach
            </select>
            <select name="status" onchange="this.form.submit()" class="border border-black/20 px-3 py-2 text-sm focus:border-gold focus:ring-0">
                <option value="">All messages</option>
                <option value="unread" @selected(request('status') === 'unread')>Unread</option>
                <option value="read" @selected(request('status') === 'read')>Read</option>
            </select>
        </form>
    </div>

    <div class="mt-6 overflow-x-auto border border-black/10 bg-white">
        <table class="min-w-full divide-y divide-black/10 text-sm">
            <thead>
                <tr class="text-left text-xs uppercase tracking-widest2 text-ink/40">
                    <th class="px-6 py-4">From</th>
                    <th class="px-6 py-4">Message</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Received</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-black/10">
                @forelse ($messages as $message)
                    <tr class="{{ $message->is_read ? '' : 'bg-gold/5' }}">
                        <td class="px-6 py-4">
                            <p class="font-serif text-base">{{ $message->name }}</p>
                            <p class="text-xs text-ink/40">{{ $message->email }}</p>
                            @if ($message->phone)
                                <p class="text-xs text-ink/40">{{ $message->phone }}</p>
                            @endif
                            <span class="mt-1 inline-block text-[11px] uppercase tracking-widest2 text-gold/80">{{ $message->type_label }}</span>
                        </td>
                        <td class="max-w-xs px-6 py-4 text-ink/60">{{ \Illuminate\Support\Str::limit($message->message, 60) }}</td>
                        <td class="px-6 py-4">
                            <span class="text-xs uppercase tracking-widest2 {{ $message->is_read ? 'text-ink/40' : 'text-gold' }}">
                                {{ $message->is_read ? 'Read' : 'Unread' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-ink/60">{{ $message->created_at->format('M d, Y') }}</td>
                        <td class="px-6 py-4">
                            <div class="flex justify-end gap-4 text-xs uppercase tracking-widest2">
                                <a href="{{ route('admin.messages.show', $message) }}" class="hover:text-gold">View</a>
                                <form method="POST" action="{{ route('admin.messages.destroy', $message) }}"
                                      onsubmit="return confirm('Delete this message?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-ink/50">No messages yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $messages->links() }}</div>
@endsection
