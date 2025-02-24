<?php

use App\Models\Agency;
use App\Models\Spy;
use App\Models\User;
use App\Services\AgencyService;

test('The non authenticated user cannot assign a spy to an agency.', function () {
    $agency = Agency::factory()->create();
    $spy = Spy::factory()->create();

    $response = $this->patchJson("api/agencies/{$agency->id}/spies/{$spy->id}/assign");

    $response->assertUnauthorized();
});

test('Assigns a spy to an agency when the user authenticated.', function () {
    $user = User::factory()->create();
    $agency = Agency::factory()->create();
    $spy = Spy::factory()->create();

    $response = $this->actingAs($user, 'sanctum')
        ->patchJson("api/agencies/{$agency->id}/spies/{$spy->id}/assign");

    $response->assertOk();

    $response->assertJson([
        'data' => [
            'id' => $agency->id,
            'name' => $agency->name,
            'spies' => [
                [
                    'full_name' => $spy->full_name,
                    'country_of_operation' => $spy->country_of_operation,
                ],
            ],
        ],
    ]);
});
