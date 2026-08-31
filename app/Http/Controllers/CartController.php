<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartCheckoutRequest;
use App\Models\ContactMessage;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Refill;
use App\Services\CartService;
use App\Services\FonnteService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function __construct(
        private CartService $cart,
        private FonnteService $fonnte,
    ) {
    }

    public function add(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'type' => ['required', 'in:product,refill'],
            'product_id' => ['required_if:type,product', 'integer'],
            'refill_name' => ['required_if:type,refill', 'string', 'max:255'],
            'bottle_size' => ['required_if:type,refill', 'in:15,30,45,100'],
            'quantity' => ['required', 'integer', 'min:1', 'max:99'],
        ], [
            'bottle_size.required_if' => 'Pilih ukuran botol terlebih dahulu sebelum menambahkan refill ke keranjang.',
            'refill_name.required_if' => 'Pilih aroma refill terlebih dahulu sebelum menambahkan refill ke keranjang.',
        ]);

        if ($data['type'] === OrderItem::TYPE_PRODUCT) {
            $id = (int) $data['product_id'];

            if (! Product::active()->whereKey($id)->exists()) {
                return back()->with('error', 'Produk tidak tersedia saat ini.');
            }
        } else {
            $refill = Refill::active()->where('name', $data['refill_name'])->first();

            if (! $refill) {
                return back()->with('error', 'Aroma refill tidak ditemukan.');
            }

            $id = $refill->id;
        }

        $ok = $this->cart->add(
            $data['type'],
            $id,
            $data['type'] === OrderItem::TYPE_REFILL ? (int) $data['bottle_size'] : null,
            (int) $data['quantity'],
        );

        if (! $ok) {
            return back()->with('error', 'Item tidak tersedia saat ini.');
        }

        return back()->with('status', 'Item berhasil ditambahkan ke keranjang.')
            ->with('cart_open', true);
    }

    public function update(Request $request, string $key): RedirectResponse|JsonResponse
    {
        $data = $request->validate([
            'quantity' => ['required', 'integer', 'min:0', 'max:99'],
        ]);

        $this->cart->update($key, (int) $data['quantity']);

        if ($request->wantsJson()) {
            return $this->jsonUpdate($key);
        }

        return back()->with('status', 'Keranjang diperbarui.')
            ->with('cart_open', true);
    }

    public function remove(Request $request, string $key): RedirectResponse|JsonResponse
    {
        $this->cart->remove($key);

        if ($request->wantsJson()) {
            $items = $this->cart->items();
            $count = $this->cart->count();

            return response()->json([
                'ok' => true,
                'removed' => $key,
                'subtotal' => $this->cart->subtotal(),
                'count' => $count,
                'empty' => $items->isEmpty(),
                'html' => $items->isEmpty()
                    ? view('components.cart-drawer-empty')->render()
                    : null,
            ]);
        }

        return back()->with('status', 'Item dihapus dari keranjang.')
            ->with('cart_open', true);
    }

    private function jsonUpdate(string $key): JsonResponse
    {
        $line = $this->cart->items()->firstWhere('key', $key);

        return response()->json([
            'ok' => true,
            'key' => $key,
            'quantity' => $line['quantity'] ?? null,
            'unit_price' => $line['unit_price'] ?? 0,
            'line_subtotal' => $line['subtotal'] ?? 0,
            'subtotal' => $this->cart->subtotal(),
            'count' => $this->cart->count(),
        ]);
    }

    public function checkout(CartCheckoutRequest $request): RedirectResponse
    {
        $items = $this->cart->items()->where('available', true);

        if ($items->isEmpty()) {
            return back()->withErrors(['cart' => 'Keranjang Anda kosong atau tidak ada item yang bisa dipesan.'])->withInput();
        }

        $summary = $this->buildSummary($items, $request->input('message'));

        $message = ContactMessage::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'type' => ContactMessage::TYPE_ORDER,
            'message' => $summary,
        ]);

        foreach ($items as $line) {
            OrderItem::create([
                'contact_message_id' => $message->id,
                'item_type' => $line['type'],
                'item_id' => $line['available'] ? $line['id'] : null,
                'label' => $line['label'],
                'unit_price' => $line['unit_price'],
                'quantity' => $line['quantity'],
                'bottle_size' => $line['bottle_size'],
            ]);
        }

        $this->notifyAdmin($message, $items);

        $this->cart->clear();

        return back()->with('status', 'Pesanan Anda telah diterima — tim kami akan segera menghubungi Anda via WhatsApp atau email untuk konfirmasi. Terima kasih!');
    }

    private function buildSummary($items, ?string $note): string
    {
        $lines = $items->map(fn (array $line) => $this->formatLine($line));
        $total = $items->sum('subtotal');

        $summary = "Halo Perfu.me, saya ingin memesan:\n\n"
            . $lines->map(fn (string $line, int $i) => ($i + 1) . '. ' . $line)->implode("\n")
            . "\n\nTotal: " . $this->formatRupiah($total);

        if (filled($note)) {
            $summary .= "\n\nCatatan: " . $note;
        }

        return str($summary)->limit(2000)->toString();
    }

    private function formatLine(array $line): string
    {
        $size = $line['size_label'] ? ' · ' . $line['size_label'] : '';

        return $line['label'] . $size
            . ' — ' . $line['quantity'] . 'x ' . $this->formatRupiah($line['unit_price'])
            . ' = ' . $this->formatRupiah($line['subtotal']);
    }

    private function formatRupiah(int $amount): string
    {
        return 'Rp ' . number_format($amount, 0, ',', '.');
    }

    private function notifyAdmin(ContactMessage $message, $items): void
    {
        try {
            $lines = $items->map(fn (array $line) => $this->formatLine($line))->implode("\n");
            $total = $items->sum('subtotal');

            $this->fonnte->send(implode("\n", [
                strtoupper(config('app.name')) . ' — NEW ORDER',
                '',
                'From: ' . $message->name,
                'Email: ' . $message->email,
                'Phone: ' . ($message->phone ?: '-'),
                'Time: ' . $message->created_at->format('d M Y H:i'),
                '',
                'Items:',
                $lines,
                '',
                'Total: ' . $this->formatRupiah($total),
                '',
                '"' . str($message->message)->limit(300) . '"',
            ]));
        } catch (\Throwable $e) {
            Log::warning('WhatsApp order notification failed: ' . $e->getMessage());
        }
    }
}