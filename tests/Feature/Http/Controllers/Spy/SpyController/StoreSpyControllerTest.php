<?php

use App\Models\Agency;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

beforeEach(function () {
    Sanctum::actingAs(User::factory()->create());
});

test('Creates a new spy successfully.', function () {
    $agency = Agency::factory()->create();

    $payload = [
        'name' => 'James',
        'surname' => 'Bond',
        'date_of_birth' => '1980-04-13',
        'country_of_operation' => 'United Kingdom',
        'agency_id' => $agency->id,
    ];

    $response = $this->postJson(route('spies.store'), $payload);

    $response->assertCreated()
        ->assertJsonPath('data.full_name', 'James Bond')
        ->assertJsonPath('data.country_of_operation', 'United Kingdom');

    $this->assertDatabaseHas('spies', [
        'name' => 'James',
        'surname' => 'Bond',
        'country_of_operation' => 'United Kingdom',
        'agency_id' => $agency->id,
    ]);
});

test('Fails to create a spy with invalid data.', function () {
    $payload = [
        'name' => '',
        'surname' => 'Bond',
        'date_of_birth' => 'invalid-date',
        'country_of_operation' => 'United Kingdom',
    ];

    $response = $this->postJson(route('spies.store'), $payload);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['name', 'date_of_birth']);
});
