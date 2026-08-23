<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    public const TYPE_CONTACT = 'contact';
    public const TYPE_REFILL = 'refill';
    public const TYPE_PRODUCT = 'product';

    protected $fillable = ['name', 'email', 'phone', 'type', 'message', 'is_read'];

    protected function casts(): array
    {
        return [
            'is_read' => 'boolean',
        ];
    }

    public function replies()
    {
        return $this->hasMany(ContactMessageReply::class)->oldest();
    }

    public function getTypeLabelAttribute(): string
    {
        return match ($this->type) {
            self::TYPE_REFILL => 'Refill Request',
            self::TYPE_PRODUCT => 'Product Inquiry',
            default => 'Contact',
        };
    }

    public static function types(): array
    {
        return [self::TYPE_CONTACT, self::TYPE_REFILL, self::TYPE_PRODUCT];
    }
}
