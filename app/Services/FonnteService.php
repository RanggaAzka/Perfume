<?php

namespace App\Services;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FonnteService
{
    /**
     * Send a WhatsApp message through the Fonnte gateway.
     * Returns true when Fonnte confirms acceptance of the message.
     */
    public function send(string $message): bool
    {
        return $this->sendWithResult($message)['ok'];
    }

    /**
     * Send an admin alert to the number configured in site settings.
     *
     * @return array{ok: bool, detail: string}
     */
    public function sendWithResult(string $message): array
    {
        $settings = SiteSetting::current();

        if (! $settings->whatsappNotificationsEnabled()) {
            Log::info('Fonnte notification skipped: device token or target number is not configured.');

            return [
                'ok' => false,
                'detail' => 'Notifications are not configured yet — fill in both the Fonnte Device Token and Admin WhatsApp Number, then save settings.',
            ];
        }

        return $this->deliver($this->normalizeTarget((string) $settings->whatsapp_target), $message);
    }

    /**
     * Send a WhatsApp message to an arbitrary number (e.g. a customer
     * replying from the admin panel).
     *
     * @return array{ok: bool, detail: string}
     */
    public function sendTo(string $target, string $message): array
    {
        return $this->deliver($this->normalizeTarget($target), $message);
    }

    /**
     * Fetch connected device info from Fonnte (number, status, quota).
     */
    public function deviceInfo(): ?array
    {
        $settings = SiteSetting::current();

        if (! filled($settings->fonnte_token)) {
            return null;
        }

        try {
            $response = Http::asForm()
                ->timeout(10)
                ->withHeaders(['Authorization' => trim($settings->fonnte_token)])
                ->post('https://api.fonnte.com/device');

            if ($response->ok()) {
                return $response->json();
            }
        } catch (\Throwable $e) {
            Log::warning('Fonnte device check failed: ' . $e->getMessage());
        }

        return null;
    }

    private function deliver(string $target, string $message): array
    {
        $settings = SiteSetting::current();

        if (! filled($settings->fonnte_token)) {
            Log::info('Fonnte notification skipped: device token is not configured.');

            return [
                'ok' => false,
                'detail' => 'Fonnte Device Token is not configured yet — set it in Admin > Settings first.',
            ];
        }

        try {
            $response = Http::asForm()
                ->timeout(10)
                ->withHeaders(['Authorization' => trim($settings->fonnte_token)])
                ->post('https://api.fonnte.com/send', [
                    'target' => $target,
                    'message' => $message,
                ]);

            $body = $response->json() ?? [];

            if ($response->ok() && ($body['status'] ?? false) === true) {
                Log::info('Fonnte notification sent.', ['response' => $body]);

                return [
                    'ok' => true,
                    'detail' => 'Message accepted by Fonnte and queued for delivery to ' . $target . '.',
                ];
            }

            Log::warning('Fonnte notification failed', [
                'http_status' => $response->status(),
                'response' => $body,
                'target' => $target,
            ]);

            $reason = $body['reason']
                ?? $body['detail']
                ?? ('HTTP ' . $response->status());

            return [
                'ok' => false,
                'detail' => 'Fonnte rejected the message: ' . $reason . '. If the reason is "device disconnected", rescan the QR code on fonnte.com.',
            ];
        } catch (\Throwable $e) {
            Log::warning('Fonnte notification error: ' . $e->getMessage());

            return [
                'ok' => false,
                'detail' => 'Connection to Fonnte failed: ' . $e->getMessage(),
            ];
        }
    }

    /**
     * Fonnte expects international format without a leading zero
     * (628xxxxxxxxxx) — convert local 0-prefixes automatically.
     */
    public function normalizeTarget(string $target): string
    {
        $digits = preg_replace('/[^0-9]/', '', $target);

        if (str_starts_with($digits, '0')) {
            $digits = '62' . substr($digits, 1);
        }

        return $digits;
    }
}
