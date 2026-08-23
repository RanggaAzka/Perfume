<?php

namespace Tests\Feature;

use App\Models\Refill;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RefillTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_refill_page_only_shows_active_refills(): void
    {
        Refill::factory()->create(['name' => 'Aventus', 'is_active' => true]);
        Refill::factory()->create(['name' => 'Discontinued Scent', 'is_active' => false]);

        $response = $this->get('/refills');

        $response->assertOk();
        $response->assertSee('Aventus');
        $response->assertDontSee('Discontinued Scent');
    }

    public function test_non_admin_cannot_manage_refills(): void
    {
        $user = User::factory()->create(['role' => 'customer']);

        $response = $this->actingAs($user)->get('/admin/refills');

        $response->assertForbidden();
    }

    public function test_admin_can_create_and_deactivate_a_refill(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->post('/admin/refills', [
            'name' => 'Baccarat Rouge 540',
            'is_active' => '1',
            'sort_order' => 1,
        ]);

        $response->assertRedirect('/admin/refills');
        $this->assertDatabaseHas('refills', ['name' => 'Baccarat Rouge 540', 'is_active' => 1]);

        $refill = Refill::where('name', 'Baccarat Rouge 540')->firstOrFail();

        $updateResponse = $this->actingAs($admin)->put("/admin/refills/{$refill->id}", [
            'name' => 'Baccarat Rouge 540',
            'sort_order' => 1,
            // is_active omitted = unchecked checkbox
        ]);

        $updateResponse->assertRedirect('/admin/refills');
        $this->assertDatabaseHas('refills', ['id' => $refill->id, 'is_active' => 0]);

        // Deactivated refills should disappear from the public page.
        $publicResponse = $this->get('/refills');
        $publicResponse->assertDontSee('Baccarat Rouge 540');
    }
}
