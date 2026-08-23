<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_name',
        'contact_email',
        'contact_phone',
        'instagram_url',
        'tiktok_url',
        'address',
        'store_hours',
        'fonnte_token',
        'whatsapp_target',
    ];

    /**
     * Whether WhatsApp push notifications are fully configured.
     * Requires both the Fonnte device token and the admin phone number.
     */
    public function whatsappNotificationsEnabled(): bool
    {
        return filled($this->fonnte_token) && filled($this->whatsapp_target);
    }

    /**
     * Fetch the single settings row, creating an empty one on first use.
     * Every field defaults to null — the site never displays invented
     * contact info, it simply hides a field until an admin fills it in.
     */
    public static function current(): self
    {
        return static::query()->firstOrCreate([]);
    }
}
