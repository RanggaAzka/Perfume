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

    public function test_admin_can_create_a_product_with_main_accords(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin)->post('/admin/products', [
            'name' => 'Accordessence',
            'short_description' => 'With main accords.',
            'description' => 'A longer description used purely for automated testing purposes.',
            'is_active' => '1',
            'main_accords' => [
                ['accord' => 'Woody', 'percent' => 60],
                ['accord' => 'Sweet', 'percent' => 40],
            ],
        ])->assertRedirect('/admin/products');

        $product = Product::where('name', 'Accordessence')->firstOrFail();
        $this->assertSame(
            [
                ['accord' => 'Woody', 'percent' => 60],
                ['accord' => 'Sweet', 'percent' => 40],
            ],
            $product->main_accords
        );
    }

    public function test_admin_cannot_save_duplicate_main_accords(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)->post('/admin/products', [
            'name' => 'Duplicate',
            'short_description' => 'Accords.',
            'description' => 'A longer description used purely for automated testing purposes.',
            'is_active' => '1',
            'main_accords' => [
                ['accord' => 'Woody', 'percent' => 60],
                ['accord' => 'Woody', 'percent' => 30],
            ],
        ])->assertSessionHasErrors('main_accords.0.accord');

        $this->assertDatabaseMissing('products', ['name' => 'Duplicate']);
    }

    public function test_admin_cannot_save_main_accord_with_zero_percent(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)->post('/admin/products', [
            'name' => 'Zero Percent',
            'short_description' => 'Accords.',
            'description' => 'A longer description used purely for automated testing purposes.',
            'is_active' => '1',
            'main_accords' => [
                ['accord' => 'Woody', 'percent' => 0],
            ],
        ])->assertSessionHasErrors('main_accords.0.percent');

        $this->assertDatabaseMissing('products', ['name' => 'Zero Percent']);
    }

    public function test_admin_cannot_save_more_than_four_main_accords(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)->post('/admin/products', [
            'name' => 'Too Many',
            'short_description' => 'Accords.',
            'description' => 'A longer description used purely for automated testing purposes.',
            'is_active' => '1',
            'main_accords' => [
                ['accord' => 'Woody', 'percent' => 30],
                ['accord' => 'Floral', 'percent' => 30],
                ['accord' => 'Fresh', 'percent' => 30],
                ['accord' => 'Citrus', 'percent' => 10],
                ['accord' => 'Sweet', 'percent' => 1],
            ],
        ])->assertSessionHasErrors('main_accords');

        $this->assertDatabaseMissing('products', ['name' => 'Too Many']);
    }

    public function test_active_product_is_visible_on_the_public_site(): void
    {
        $product = Product::factory()->create(['is_active' => true]);

        $response = $this->get('/products/'.$product->slug);

        $response->assertOk();
        $response->assertSee($product->name);
    }

    public function test_main_accords_appear_on_the_product_detail_page(): void
    {
        $product = Product::factory()->create([
            'is_active' => true,
            'main_accords' => [
                ['accord' => 'Woody', 'percent' => 60],
                ['accord' => 'Sweet', 'percent' => 40],
            ],
        ]);

        $response = $this->get('/products/'.$product->slug);

        $response->assertOk()
            ->assertSee('Main Accords')
            ->assertSee('Woody')
            ->assertSee('60%')
            ->assertSee('Sweet')
            ->assertSee('40%');
    }

    public function test_main_accords_bars_sort_highest_percentage_first(): void
    {
        $product = Product::factory()->create([
            'is_active' => true,
            'main_accords' => [
                ['accord' => 'Sweet', 'percent' => 40],
                ['accord' => 'Woody', 'percent' => 60],
                ['accord' => 'Citrus', 'percent' => 20],
            ],
        ]);

        $response = $this->get('/products/'.$product->slug);

        $response->assertOk();
        $response->assertSeeInOrder(['Woody', 'Sweet', 'Citrus']);
    }
}
