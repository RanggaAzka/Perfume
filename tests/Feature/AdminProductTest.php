<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_non_admin_cannot_access_admin_dashboard(): void
    {
        $user = User::factory()->create(['role' => 'customer']);

        $response = $this->actingAs($user)->get('/admin/dashboard');

        $response->assertForbidden();
    }

    public function test_admin_can_create_a_product(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->post('/admin/products', [
            'name' => 'Testessence',
            'short_description' => 'A short description for testing.',
            'description' => 'A longer description used purely for automated testing purposes.',
            'is_active' => '1',
            'sort_order' => 1,
        ]);

        $response->assertRedirect('/admin/products');
        $this->assertDatabaseHas('products', ['name' => 'Testessence', 'slug' => 'testessence']);
    }

    public function test_active_product_is_visible_on_the_public_site(): void
    {
        $product = Product::factory()->create(['is_active' => true]);

        $response = $this->get('/products/'.$product->slug);

        $response->assertOk();
        $response->assertSee($product->name);
    }
}
