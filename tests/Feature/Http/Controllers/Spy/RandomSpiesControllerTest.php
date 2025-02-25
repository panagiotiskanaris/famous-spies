<?php

use App\Models\Spy;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
});

test('Returns a collection of 5 random spies.', function () {
    Spy::factory()->count(10)->hasAgency()->create();

    $response = $this->actingAs($this->user, 'sanctum')->getJson('/api/random-spies');

    $response->assertOk();

    $response->assertJsonCount(5, 'data');

    $response->assertJsonStructure([
        'data' => [
            '*' => [
                'full_name',
                'country_of_operation',
                'date_of_birth',
                'date_of_death',
            ],
        ],
    ]);
});

test('Returns an empty collection if no spies exist.', function () {
    Spy::query()->delete();

    $response = $this->actingAs($this->user, 'sanctum')->getJson('/api/random-spies');

    $response->assertOk();

    $response->assertJsonCount(0, 'data');
});
