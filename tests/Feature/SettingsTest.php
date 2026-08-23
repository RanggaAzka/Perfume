<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SettingsTest extends TestCase
{
    use RefreshDatabase;

    public function test_non_admin_cannot_access_settings(): void
    {
        $user = User::factory()->create(['role' => 'customer']);

        $response = $this->actingAs($user)->get('/admin/settings');

        $response->assertForbidden();
    }

    public function test_admin_can_update_settings(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->put('/admin/settings', [
            'contact_email' => 'hello@perfu.me',
            'instagram_url' => 'https://instagram.com/perfu.me',
        ]);

        $response->assertRedirect('/admin/settings');
        $this->assertDatabaseHas('site_settings', ['contact_email' => 'hello@perfu.me']);
    }

    public function test_admin_settings_page_renders_fonnte_status(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get('/admin/settings');

        $response->assertOk();
        $response->assertSee('Fonnte Device Status');
        $response->assertSee('Send Test WhatsApp');

        // Guard against nested <form> elements (invalid HTML that breaks
        // the Save Settings button): track tag depth across the page —
        // settings form, test-whatsapp form and the sidebar logout form
        // must all be siblings, never nested.
        $content = (string) $response->getContent();
        preg_match_all('/<form\b|<\/form>/', $content, $tags, PREG_OFFSET_CAPTURE);

        $depth = 0;
        foreach ($tags[0] as [$tag]) {
            if ($tag === '</form>') {
                $depth--;
                $this->assertGreaterThanOrEqual(0, $depth, 'Closing </form> without a matching opening tag.');
            } else {
                $depth++;
                $this->assertLessThanOrEqual(1, $depth, 'Nested <form> detected — this breaks form submission.');
            }
        }
        $this->assertSame(0, $depth, 'Unbalanced <form> tags.');
    }

    public function test_footer_shows_saved_contact_email(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin)->put('/admin/settings', ['contact_email' => 'hello@perfu.me']);

        $response = $this->get('/');

        $response->assertSee('hello@perfu.me');
    }

    public function test_homepage_does_not_invent_contact_info_when_settings_are_blank(): void
    {
        $response = $this->get('/');

        $response->assertDontSee('hello@perfu.me');
    }
}
