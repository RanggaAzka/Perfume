<?php

namespace Tests\Feature;

use App\Models\ContactMessage;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Refill;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;

    public function test_drawer_shows_empty_state_on_any_page(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('data-cart-drawer')
            ->assertSee('Keranjang Anda masih kosong.');
    }

    public function test_product_can_be_added_to_cart(): void
    {
        $product = Product::factory()->create();

        $this->post('/cart/add', [
            'type' => 'product',
            'product_id' => $product->id,
            'quantity' => 2,
        ])->assertRedirect()->assertSessionHas('status')->assertSessionHas('cart_open', true);

        $this->assertSame(['product:' . $product->id => [
            'type' => 'product',
            'id' => $product->id,
            'bottle_size' => null,
            'quantity' => 2,
        ]], session('cart.items'));
    }

    public function test_refill_can_be_added_to_cart_with_size(): void
    {
        $refill = Refill::factory()->create(['name' => 'Sauvage']);

        $this->post('/cart/add', [
            'type' => 'refill',
            'refill_name' => 'Sauvage',
            'bottle_size' => 30,
            'quantity' => 1,
        ])->assertRedirect();

        $this->assertSame(['refill:' . $refill->id . ':30' => [
            'type' => 'refill',
            'id' => $refill->id,
            'bottle_size' => 30,
            'quantity' => 1,
        ]], session('cart.items'));
    }

    public function test_refill_add_requires_a_bottle_size(): void
    {
        Refill::factory()->create(['name' => 'Sauvage']);

        $this->post('/cart/add', [
            'type' => 'refill',
            'refill_name' => 'Sauvage',
            'quantity' => 1,
        ])->assertSessionHasErrors('bottle_size');

        $this->assertNull(session('cart.items'));
    }

    public function test_inactive_product_cannot_be_added(): void
    {
        $product = Product::factory()->create(['is_active' => false]);

        $this->post('/cart/add', [
            'type' => 'product',
            'product_id' => $product->id,
            'quantity' => 1,
        ])->assertSessionHas('error');

        $this->assertNull(session('cart.items'));
    }

    public function test_additional_refill_added_to_same_key_increments_quantity(): void
    {
        $refill = Refill::factory()->create(['name' => 'Sauvage']);

        $this->post('/cart/add', ['type' => 'refill', 'refill_name' => 'Sauvage', 'bottle_size' => 30, 'quantity' => 1]);
        $this->post('/cart/add', ['type' => 'refill', 'refill_name' => 'Sauvage', 'bottle_size' => 30, 'quantity' => 2]);

        $this->assertSame(3, session('cart.items')['refill:' . $refill->id . ':30']['quantity']);
    }

    public function test_drawer_displays_items_and_totals(): void
    {
        $product = Product::factory()->create(['name' => 'Vanessence', 'price' => 45000]);
        $refill = Refill::factory()->create(['name' => 'Sauvage']);

        $this->post('/cart/add', ['type' => 'product', 'product_id' => $product->id, 'quantity' => 2]);
        $this->post('/cart/add', ['type' => 'refill', 'refill_name' => 'Sauvage', 'bottle_size' => 30, 'quantity' => 1]);

        $response = $this->get('/products');

        $response->assertOk()
            ->assertSee('data-cart-drawer')
            ->assertSee('Vanessence')
            ->assertSee('Sauvage')
            ->assertSee('Rp 90.000')
            ->assertSee('Rp 120.000');
    }

    public function test_cart_quantity_can_be_updated(): void
    {
        $product = Product::factory()->create();
        $this->post('/cart/add', ['type' => 'product', 'product_id' => $product->id, 'quantity' => 1]);
        $key = 'product:' . $product->id;

        $this->patch('/cart/' . $key, ['quantity' => 3])->assertRedirect()->assertSessionHas('cart_open', true);

        $this->assertSame(3, session('cart.items')[$key]['quantity']);
    }

    public function test_cart_item_can_be_removed(): void
    {
        $product = Product::factory()->create();
        $this->post('/cart/add', ['type' => 'product', 'product_id' => $product->id, 'quantity' => 1]);
        $key = 'product:' . $product->id;

        $this->delete('/cart/' . $key)->assertRedirect()->assertSessionHas('cart_open', true);

        $this->assertArrayNotHasKey($key, session('cart.items'));
    }

    public function test_cart_quantity_can_be_updated_via_json(): void
    {
        $product = Product::factory()->create(['name' => 'Vanessence', 'price' => 45000]);
        $this->post('/cart/add', ['type' => 'product', 'product_id' => $product->id, 'quantity' => 1]);
        $key = 'product:' . $product->id;

        $this->withHeaders(['Accept' => 'application/json'])
            ->patch('/cart/' . $key, ['quantity' => 2])
            ->assertOk()
            ->assertJson([
                'ok' => true,
                'key' => $key,
                'quantity' => 2,
                'unit_price' => 45000,
                'line_subtotal' => 90000,
                'subtotal' => 90000,
                'count' => 2,
            ]);

        $this->assertSame(2, session('cart.items')[$key]['quantity']);
    }

    public function test_cart_item_can_be_removed_via_json(): void
    {
        $product = Product::factory()->create(['name' => 'Vanessence', 'price' => 45000]);
        $this->post('/cart/add', ['type' => 'product', 'product_id' => $product->id, 'quantity' => 2]);
        $key = 'product:' . $product->id;

        $this->withHeaders(['Accept' => 'application/json'])
            ->delete('/cart/' . $key)
            ->assertOk()
            ->assertJson(['ok' => true, 'removed' => $key, 'count' => 0, 'empty' => true]);

        $this->assertArrayNotHasKey($key, session('cart.items'));
    }

    public function test_checkout_creates_order_message_and_items_and_clears_cart(): void
    {
        $product = Product::factory()->create(['name' => 'Vanessence', 'price' => 45000]);
        $refill = Refill::factory()->create(['name' => 'Sauvage']);

        $this->post('/cart/add', ['type' => 'product', 'product_id' => $product->id, 'quantity' => 1]);
        $this->post('/cart/add', ['type' => 'refill', 'refill_name' => 'Sauvage', 'bottle_size' => 30, 'quantity' => 1]);

        $this->post('/cart/checkout', [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'phone' => '+62 812 3456 7890',
            'message' => 'Send to Dramaga.',
        ])->assertRedirect()->assertSessionHas('status');

        $message = ContactMessage::first();
        $this->assertNotNull($message);
        $this->assertSame(ContactMessage::TYPE_ORDER, $message->type);
        $this->assertStringContainsString('Total: Rp 75.000', $message->message);
        $this->assertStringContainsString('Send to Dramaga.', $message->message);

        $this->assertDatabaseCount('order_items', 2);
        $this->assertDatabaseHas('order_items', [
            'contact_message_id' => $message->id,
            'item_type' => OrderItem::TYPE_PRODUCT,
            'item_id' => $product->id,
            'label' => 'Vanessence',
            'unit_price' => 45000,
            'quantity' => 1,
        ]);
        $this->assertDatabaseHas('order_items', [
            'contact_message_id' => $message->id,
            'item_type' => OrderItem::TYPE_REFILL,
            'item_id' => $refill->id,
            'bottle_size' => 30,
            'unit_price' => 30000,
            'quantity' => 1,
        ]);

        $this->assertNull(session('cart.items'));
    }

    public function test_checkout_requires_contact_details(): void
    {
        Product::factory()->create(['price' => 45000]);
        $product = Product::first();

        $this->post('/cart/add', ['type' => 'product', 'product_id' => $product->id, 'quantity' => 1]);

        $this->post('/cart/checkout', [])->assertSessionHasErrors(['name', 'email', 'phone']);

        $this->assertDatabaseCount('contact_messages', 0);
        $this->assertDatabaseCount('order_items', 0);
    }

    public function test_checkout_sends_whatsapp_notification_to_admin(): void
    {
        Http::fake([
            'api.fonnte.com/send' => Http::response(['status' => true, 'detail' => 'success! message in queue']),
        ]);
        \App\Models\SiteSetting::current()->update(['fonnte_token' => 'test-token', 'whatsapp_target' => '081234567890']);

        $product = Product::factory()->create(['name' => 'Vanessence', 'price' => 45000]);
        $this->post('/cart/add', ['type' => 'product', 'product_id' => $product->id, 'quantity' => 1]);

        $this->post('/cart/checkout', [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'phone' => '081234567890',
        ])->assertRedirect()->assertSessionHas('status');

        Http::assertSent(function ($request) {
            return $request['target'] === '6281234567890'
                && str_contains((string) $request['message'], 'NEW ORDER')
                && str_contains((string) $request['message'], 'Vanessence');
        });
    }

    public function test_checkout_with_empty_cart_returns_error(): void
    {
        $this->post('/cart/checkout', [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'phone' => '+62 812 3456 7890',
        ])->assertSessionHasErrors('cart');

        $this->assertDatabaseCount('contact_messages', 0);
    }

    public function test_product_price_has_a_default_and_can_be_set(): void
    {
        $product = Product::factory()->create();
        $this->assertSame(45000, (int) $product->price);

        $product->update(['price' => 55000]);
        $this->assertSame(55000, (int) $product->fresh()->price);
    }
}