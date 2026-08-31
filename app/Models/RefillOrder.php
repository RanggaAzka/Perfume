<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RefillOrder extends Model
{
    protected $fillable = [
        'contact_message_id',
        'refill_id',
        'bottle_size',
        'quantity',
    ];

    public function contactMessage(): BelongsTo
    {
        return $this->belongsTo(ContactMessage::class);
    }

    public function refill(): BelongsTo
    {
        return $this->belongsTo(Refill::class);
    }
}
