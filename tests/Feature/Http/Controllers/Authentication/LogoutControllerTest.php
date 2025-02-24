<?php

use App\Models\User;
use Laravel\Sanctum\Sanctum;

test('Logout a user successfully.', function () {
    $user = User::factory()->create();

    Sanctum::actingAs($user);

    $response = $this->postJson('/api/logout');

    $response->assertStatus(200);

    $response->assertJson([
        'message' => 'Logged out successfully.',
    ]);

    $this->assertDatabaseMissing('personal_access_tokens', [
        'tokenable_id' => $user->id,
        'tokenable_type' => get_class($user),
    ]);
});

test('Fails to log out when the user is not authenticated.', function () {
    $response = $this->postJson('/api/logout');

    $response->assertStatus(401);
});
