<?php

use App\Models\Agency;
use App\Models\Mission;
use App\Models\Spy;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

beforeEach(function () {
    Sanctum::actingAs(User::factory()->create());
});

test('deletes a spy successfully', function () {
    $spy = Spy::factory()->create();

    $response = $this->deleteJson(route('spies.destroy', $spy->id));

    $response->assertNoContent();

    $this->assertDatabaseMissing('spies', [
        'id' => $spy->id,
    ]);
});

test('Fails to delete a spy that does not exist.', function () {
    $response = $this->deleteJson(route('spies.destroy', 9999)); // Non-existent ID

    $response->assertNotFound();
});

test('Handles the deletion exception gracefully', function () {
    $agency = Agency::factory()->create();

    $spy = Spy::factory()->create([
        'agency_id' => $agency->id,
    ]);

    Mission::factory()->create([
        'agency_id' => $agency->id,
        'spy_id' => $spy->id,
    ]);

    $response = $this->deleteJson(route('spies.destroy', $spy->id));

    $response->assertStatus(400);

    $this->assertDatabaseHas('spies', [
        'id' => $spy->id,
    ]);
});
