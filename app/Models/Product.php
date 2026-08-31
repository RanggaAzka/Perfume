<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    /**
     * Curated list of dominant scent profiles ("main accords"), stored per
     * product as [{ accord, percent }] so customers can see the dominant
     * character at a glance (highest percentage first).
     *
     * @var list<string>
     */
    public const ACCORDS = [
        'Woody',
        'Floral',
        'Fresh',
        'Citrus',
        'Sweet',
        'Spicy',
        'Green',
        'Aquatic',
        'Amber',
        'Gourmand',
        'Leather',
        'Powdery',
    ];

    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'description',
        'image',
        'price',
        'main_accords',
        'fragrance_family',
        'category',
        'longevity',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'main_accords' => 'array',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Product $product) {
            if (empty($product->slug)) {
                $product->slug = static::uniqueSlug($product->name);
            }
        });
    }

    public static function uniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $base = Str::slug($name);
        $slug = $base;
        $i = 1;

        while (
            static::where('slug', $slug)
                ->when($ignoreId, fn (Builder $q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = "{$base}-" . ++$i;
        }

        return $slug;
    }

    public function fragranceNotes(): BelongsToMany
    {
        return $this->belongsToMany(FragranceNote::class)->withPivot('position')->withTimestamps();
    }

    /**
     * Notes grouped by their olfactive position for this product.
     * Falls back gracefully if fragranceNotes() hasn't been eager-loaded.
     */
    public function notesByPosition(string $position): \Illuminate\Support\Collection
    {
        return $this->fragranceNotes
            ->filter(fn (FragranceNote $note) => $note->pivot->position === $position)
            ->values();
    }

    public function topNotes(): \Illuminate\Support\Collection
    {
        return $this->notesByPosition('top');
    }

    public function heartNotes(): \Illuminate\Support\Collection
    {
        return $this->notesByPosition('heart');
    }

    public function baseNotes(): \Illuminate\Support\Collection
    {
        return $this->notesByPosition('base');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function priceFormatted(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    /**
     * Main accords sorted from the most dominant (highest percentage) to the
     * least, e.g. [{ accord: 'Woody', percent: 60 }, ...]. Falls back to an
     * empty collection when the product has no accord data.
     */
    public function mainAccordsSorted(): \Illuminate\Support\Collection
    {
        return collect($this->main_accords ?? [])
            ->filter(fn (array $row) => ($row['accord'] ?? '') !== '' && ($row['percent'] ?? 0) > 0)
            ->sortByDesc('percent')
            ->values();
    }

    public function imageUrl(): string
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }

        if (file_exists(public_path('images/' . $this->slug . '.png'))) {
            return asset('images/' . $this->slug . '.png');
        }

        return asset('images/placeholder-bottle.svg');
    }
}
