<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\ContactMessage;
use App\Services\FonnteService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function __construct(private FonnteService $fonnte)
    {
    }

    public function create(): View
    {
        return view('pages.contact');
    }

    public function store(ContactRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['type'] ??= ContactMessage::TYPE_CONTACT;

        $message = ContactMessage::create($data);

        $this->notifyAdmin($message);

        return back()->with('status', 'Thank you — your message has been sent. We will be in touch soon.');
    }

    /**
     * Push a WhatsApp alert to the admin's phone for every new submission.
     * A failed notification must never break the customer's request.
     */
    private function notifyAdmin(ContactMessage $message): void
    {
        try {
            $this->fonnte->send(
                implode("\n", [
                    strtoupper(config('app.name')) . ' — NEW MESSAGE',
                    '',
                    'Type: ' . $message->type_label,
                    'From: ' . $message->name,
                    'Email: ' . $message->email,
                    'Phone: ' . ($message->phone ?: '-'),
                    'Time: ' . $message->created_at->format('d M Y H:i'),
                    '',
                    '"' . str($message->message)->limit(500) . '"',
                ])
            );
        } catch (\Throwable $e) {
            Log::warning('WhatsApp admin notification failed: ' . $e->getMessage());
        }
    }
}
