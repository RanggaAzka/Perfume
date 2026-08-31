<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\ContactMessage;
use App\Models\Refill;
use App\Models\RefillOrder;
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

        // Keep the requested bottle size (and its price) attached to the message so the
        // admin notification is complete even when JavaScript could not run.
        $bottleSize = null;
        $bottleMl = null;
        if ($data['type'] === ContactMessage::TYPE_REFILL && ! empty($data['bottle_size'])) {
            $ml = (int) $data['bottle_size'];
            $bottleMl = $ml;
            $price = Refill::BOTTLE_SIZES[$ml] ?? null;
            $bottleSize = $price ? "{$ml} ml ({$price})" : "{$ml} ml";
        }
        unset($data['bottle_size']);

        if ($bottleSize) {
            $data['message'] .= "\n\nBottle size: {$bottleSize}";
        }

        $message = ContactMessage::create($data);

        if ($data['type'] === ContactMessage::TYPE_REFILL && ! empty($data['selected_refill'])) {
            $this->recordRefillOrder($message, $data['selected_refill'], $bottleMl);
        }

        $this->notifyAdmin($message);

        return back()->with('status', 'Pesan Anda telah terkirim — tim kami akan segera menghubungi Anda via WhatsApp atau email. Terima kasih!');
    }

    /**
     * Persist a structured refill order so the admin can see how many times each
     * fragrance has been requested. A missing/mismatched fragrance name is ignored
     * rather than failing the customer's submission.
     */
    private function recordRefillOrder(ContactMessage $message, string $refillName, ?int $bottleMl): void
    {
        $refill = Refill::where('name', $refillName)->first();

        if (! $refill) {
            return;
        }

        RefillOrder::create([
            'contact_message_id' => $message->id,
            'refill_id' => $refill->id,
            'bottle_size' => $bottleMl,
        ]);
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
