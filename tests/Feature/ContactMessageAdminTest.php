<?php

namespace Tests\Feature;

use App\Models\ContactMessage;
use App\Models\ContactMessageReply;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ContactMessageAdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_form_creates_a_message(): void
    {
        $response = $this->post('/contact', [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'phone' => '+62 812 3456 7890',
            'message' => 'Do you carry Aventus for refill?',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('contact_messages', [
            'email' => 'jane@example.com',
            'phone' => '+62 812 3456 7890',
            'is_read' => false,
        ]);
    }

    public function test_contact_form_requires_a_phone_number(): void
    {
        $response = $this->post('/contact', [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'message' => 'Do you carry Aventus for refill?',
        ]);

        $response->assertSessionHasErrors('phone');
    }

    public function test_non_admin_cannot_view_messages(): void
    {
        $user = User::factory()->create(['role' => 'customer']);

        $response = $this->actingAs($user)->get('/admin/messages');

        $response->assertForbidden();
    }

    public function test_admin_viewing_a_message_marks_it_read(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $message = ContactMessage::factory()->create(['is_read' => false]);

        $response = $this->actingAs($admin)->get("/admin/messages/{$message->id}");

        $response->assertOk();
        $this->assertDatabaseHas('contact_messages', ['id' => $message->id, 'is_read' => true]);
    }

    public function test_admin_can_reply_to_a_customer_via_whatsapp(): void
    {
        Http::fake([
            'api.fonnte.com/send' => Http::response(['status' => true, 'detail' => 'success! message in queue']),
        ]);

        \App\Models\SiteSetting::current()->update(['fonnte_token' => 'test-token']);

        $admin = User::factory()->create(['role' => 'admin']);
        $message = ContactMessage::factory()->create(['phone' => '081234567890']);

        $response = $this->actingAs($admin)->post("/admin/messages/{$message->id}/reply", [
            'reply_message' => 'Yes, it is available for refill in-store.',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('contact_message_replies', [
            'contact_message_id' => $message->id,
            'message' => 'Yes, it is available for refill in-store.',
        ]);

        Http::assertSent(function ($request) use ($message) {
            return $request['target'] === '6281234567890'
                && str_contains((string) $request['message'], 'Yes, it is available for refill in-store.');
        });
    }

    public function test_admin_cannot_reply_when_customer_left_no_phone(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $message = ContactMessage::factory()->create(['phone' => null]);

        $response = $this->actingAs($admin)->post("/admin/messages/{$message->id}/reply", [
            'reply_message' => 'Hello?',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('error');
        $this->assertDatabaseCount('contact_message_replies', 0);
    }
}
