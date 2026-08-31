<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Refill extends Model
{
    use HasFactory;

    public const PRICE_PER_ML = 1000;

    /**
     * Available refill bottle sizes (in ml) mapped to their fixed price,
     * derived from PRICE_PER_ML.
     */
    public const BOTTLE_SIZES = [
        15 => 'Rp 15.000',
        30 => 'Rp 30.000',
        45 => 'Rp 45.000',
        100 => 'Rp 100.000',
    ];

    protected $fillable = [
        'name',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function orders(): HasMany
    {
        return $this->hasMany(RefillOrder::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    public static function priceFor(int $ml): ?int
    {
        return isset(self::BOTTLE_SIZES[$ml]) ? $ml * self::PRICE_PER_ML : null;
    }

    public static function priceFormattedFor(int $ml): ?string
    {
        $price = self::priceFor($ml);

        return $price === null ? null : 'Rp ' . number_format($price, 0, ',', '.');
    }
}
