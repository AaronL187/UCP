<?php

namespace Tests\Feature;

use App\Models\SerialChange;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class serialTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    public function test_user_can_view_profile_if_authenticated()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->get('/profil');

        $response->assertStatus(200);
    }

    public function test_guest_cannot_view_profile()
    {
        $response = $this->get('/profil');

        $response->assertRedirect('/login');
    }

    public function test_user_can_submit_serial_change_request()
    {
        $user = User::factory()->create();
        $serialData = [
            'old_serial' => 'fa6aFce69f9BaCdAAFFDb6aEA0C9Ce75',
            'new_serial' => 'fa6aFce69f9BaCdAAFFDAAAAAAAAAAAA',
            'reason' => 'Upgrade'
        ];

        $response = $this->actingAs($user)
            ->post('/serial/store', $serialData);

        $response->assertRedirect();
        $this->assertDatabaseHas('serial_changes', $serialData);
    }

    public function test_admin_can_accept_serial_change_request()
    {
        $user = User::factory()->create(['adminlevel' => 4]);
        $changeRequest = SerialChange::factory()->create(['status' => null]);

        $response = $this->actingAs($user)
            ->post("/serial/accept/{$changeRequest->id}");

        $response->assertRedirect();
        $this->assertDatabaseHas('serial_changes', [
            'id' => $changeRequest->id,
            'status' => 1 // Accepted
        ]);
    }

}
