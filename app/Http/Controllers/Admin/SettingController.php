<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSiteSettingRequest;
use App\Models\SiteSetting;
use App\Services\FonnteService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function edit(): View
    {
        $settings = SiteSetting::current();

        $fonnte = app(FonnteService::class);

        $device = $fonnte->deviceInfo();

        $targetDigits = preg_replace('/[^0-9]/', '', (string) $settings->whatsapp_target);
        $deviceNumber = preg_replace('/[^0-9]/', '', (string) ($device['device'] ?? ''));

        $sameAsDevice = $targetDigits !== ''
            && $deviceNumber !== ''
            && $targetDigits === $deviceNumber;

        return view('admin.settings.edit', compact('settings', 'device', 'sameAsDevice'));
    }

    public function update(UpdateSiteSettingRequest $request): RedirectResponse
    {
        SiteSetting::current()->update($request->validated());

        return redirect()->route('admin.settings.edit')->with('status', 'Settings updated.');
    }

    /**
     * Fire a one-off WhatsApp test message so the admin can verify the
     * Fonnte configuration without submitting a public form.
     */
    public function testWhatsApp(FonnteService $fonnte): RedirectResponse
    {
        $result = $fonnte->sendWithResult(implode("\n", [
            strtoupper(config('app.name')) . ' — TEST MESSAGE',
            '',
            'If you received this, WhatsApp notifications are working.',
        ]));

        if ($result['ok']) {
            return redirect()->route('admin.settings.edit')
                ->with('status', $result['detail']);
        }

        return redirect()->route('admin.settings.edit')
            ->with('error', $result['detail']);
    }
}
