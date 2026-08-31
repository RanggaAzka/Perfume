<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    public const TYPE_PRODUCT = 'product';
    public const TYPE_REFILL = 'refill';

    protected $fillable = [
        'contact_message_id',
        'item_type',
        'item_id',
        'label',
        'unit_price',
        'quantity',
        'bottle_size',
    ];

    protected function casts(): array
    {
        return [
            'unit_price' => 'integer',
            'quantity' => 'integer',
            'bottle_size' => 'integer',
        ];
    }

    public function contactMessage(): BelongsTo
    {
        return $this->belongsTo(ContactMessage::class);
    }

    public function getSubtotalAttribute(): int
    {
        return $this->unit_price * $this->quantity;
    }
}