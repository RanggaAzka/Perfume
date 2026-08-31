<?php

namespace App\Services;

use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Refill;
use Illuminate\Support\Collection;

class CartService
{
    public const SESSION_KEY = 'cart.items';

    public function raw(): array
    {
        return session(self::SESSION_KEY, []);
    }

    /**
     * Resolved cart lines with current names and prices loaded from the
     * database. Lines whose product/refill has since been deactivated or
     * removed are kept visible (so the customer can remove them) but flagged
     * as unavailable and excluded from totals.
     */
    public function items(): Collection
    {
        return collect($this->raw())
            ->map(fn (array $line, string $key) => $this->resolve($key, $line))
            ->filter()
            ->values();
    }

    public function count(): int
    {
        return array_sum(array_column($this->raw(), 'quantity'));
    }

    public function subtotal(): int
    {
        return $this->items()->where('available', true)->sum('subtotal');
    }

    public function quantityTotal(): int
    {
        return $this->items()->where('available', true)->sum('quantity');
    }

    public function add(string $type, int $id, ?int $bottleSize = null, int $quantity = 1): bool
    {
        if (! in_array($type, [OrderItem::TYPE_PRODUCT, OrderItem::TYPE_REFILL], true)) {
            return false;
        }

        if (! $this->available($type, $id, $bottleSize)) {
            return false;
        }

        $key = $this->key($type, $id, $bottleSize);
        $items = $this->raw();

        if (isset($items[$key])) {
            $items[$key]['quantity'] = min(99, $items[$key]['quantity'] + max(1, $quantity));
        } else {
            $items[$key] = [
                'type' => $type,
                'id' => $id,
                'bottle_size' => $bottleSize,
                'quantity' => max(1, $quantity),
            ];
        }

        session([self::SESSION_KEY => $items]);

        return true;
    }

    public function update(string $key, int $quantity): void
    {
        $items = $this->raw();

        if (! isset($items[$key])) {
            return;
        }

        if ($quantity <= 0) {
            unset($items[$key]);
        } else {
            $items[$key]['quantity'] = min(99, $quantity);
        }

        session([self::SESSION_KEY => $items]);
    }

    public function remove(string $key): void
    {
        $items = $this->raw();

        if (isset($items[$key])) {
            unset($items[$key]);
            session([self::SESSION_KEY => $items]);
        }
    }

    public function clear(): void
    {
        session()->forget(self::SESSION_KEY);
    }

    public static function key(string $type, int $id, ?int $bottleSize = null): string
    {
        return $type === OrderItem::TYPE_REFILL
            ? "refill:{$id}:{$bottleSize}"
            : "product:{$id}";
    }

    private function available(string $type, int $id, ?int $bottleSize = null): bool
    {
        if ($type === OrderItem::TYPE_PRODUCT) {
            return Product::active()->whereKey($id)->exists();
        }

        return Refill::active()->whereKey($id)->exists()
            && Refill::priceFor((int) $bottleSize) !== null;
    }

    private function resolve(string $key, array $line): ?array
    {
        $type = $line['type'];
        $id = (int) $line['id'];
        $size = $line['bottle_size'] ?? null;
        $quantity = max(1, (int) ($line['quantity'] ?? 1));

        if ($type === OrderItem::TYPE_PRODUCT) {
            $product = Product::active()->whereKey($id)->first();
            $available = $product !== null;

            return [
                'key' => $key,
                'type' => $type,
                'id' => $id,
                'bottle_size' => null,
                'quantity' => $quantity,
                'label' => $product->name ?? 'Produk tidak tersedia',
                'unit_price' => $product->price ?? 0,
                'subtotal' => $available ? $product->price * $quantity : 0,
                'available' => $available,
                'url' => $product ? route('products.show', $product) : null,
                'size_label' => '30ml Eau de Parfum',
            ];
        }

        $refill = Refill::active()->whereKey($id)->first();
        $unitPrice = Refill::priceFor((int) $size);
        $available = $refill !== null && $unitPrice !== null;

        return [
            'key' => $key,
            'type' => $type,
            'id' => $id,
            'bottle_size' => $size,
            'quantity' => $quantity,
            'label' => $refill->name ?? 'Refill tidak tersedia',
            'unit_price' => $unitPrice ?? 0,
            'subtotal' => $available ? $unitPrice * $quantity : 0,
            'available' => $available,
            'url' => null,
            'size_label' => $size ? "{$size} ml" : null,
        ];
    }
}