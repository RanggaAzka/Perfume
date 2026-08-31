<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Services\FonnteService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactMessageController extends Controller
{
    public function index(Request $request): View
    {
        $messages = ContactMessage::query()
            ->when($request->filled('status'), function ($q) use ($request) {
                $q->where('is_read', $request->input('status') === 'read');
            })
            ->when($request->filled('type'), function ($q) use ($request) {
                $q->where('type', $request->input('type'));
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.messages.index', compact('messages'));
    }

    public function show(ContactMessage $message): View
    {
        if (! $message->is_read) {
            $message->update(['is_read' => true]);
        }

        $message->load(['replies', 'orderItems']);

        return view('admin.messages.show', compact('message'));
    }

    /**
     * Reply to a customer straight from the admin panel. The message is
     * delivered through the site's Fonnte device and stored as history.
     */
    public function reply(Request $request, ContactMessage $message, FonnteService $fonnte): RedirectResponse
    {
        $data = $request->validate([
            'reply_message' => ['required', 'string', 'max:1000'],
        ]);

        if (! filled($message->phone)) {
            return back()->with('error', 'This customer did not leave a WhatsApp number — reply by email instead.');
        }

        $body = implode("\n", [
            'Hi ' . $message->name . ',',
            '',
            $data['reply_message'],
            '',
            '— ' . config('app.name'),
        ]);

        $result = $fonnte->sendTo($message->phone, $body);

        if (! $result['ok']) {
            return back()->with('error', $result['detail']);
        }

        $message->replies()->create(['message' => $data['reply_message']]);

        return back()->with('status', 'Reply sent to ' . $message->name . ' via WhatsApp.');
    }

    public function markUnread(ContactMessage $message): RedirectResponse
    {
        $message->update(['is_read' => false]);

        return redirect()->route('admin.messages.index')->with('status', 'Message marked as unread.');
    }

    public function destroy(ContactMessage $message): RedirectResponse
    {
        $message->delete();

        return redirect()->route('admin.messages.index')->with('status', 'Message deleted.');
    }
}
