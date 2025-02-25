<?php

use App\Models\Agency;
use App\Models\Spy;
use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;

beforeEach(function () {
    Sanctum::actingAs(User::factory()->create());
});

test('Returns a paginated list of spies.', function () {
    Spy::factory()->count(20)->create();

    $response = $this->getJson(route('spies.index'));

    $response->assertOk()
        ->assertJson(fn (AssertableJson $json) => $json->has('data', 15)
            ->has('meta')
            ->has('links')
        );
});

test('Filters spies by active.', function () {
    Spy::factory()->create(['date_of_death' => null]);
    Spy::factory()->create(['date_of_death' => now()]);

    $response = $this->getJson(route('spies.index', ['isActive' => true]));

    $response->assertOk()
        ->assertJsonCount(1, 'data')
        ->assertJsonPath('data.0.date_of_death', null);
});

test('Filters spies by Country of Operation.', function () {
    Spy::factory()->create(['country_of_operation' => 'France']);
    Spy::factory()->create(['country_of_operation' => 'Germany']);

    $response = $this->getJson(route('spies.index', ['countryOfOperation' => 'France']));

    $response->assertOk()
        ->assertJsonCount(1, 'data')
        ->assertJsonPath('data.0.country_of_operation', 'France');
});

test('Filters spies by agency.', function () {
    $agency = Agency::factory()->create(['name' => 'CIA']);
    Spy::factory()->for($agency)->create();
    Spy::factory()->create();

    $response = $this->getJson(route('spies.index', ['agency' => 'CIA']));

    $response->assertOk()
        ->assertJsonCount(1, 'data')
        ->assertJsonPath('data.0.agency.name', 'CIA');
});

test('Filters spies by name or surname.', function () {
    Spy::factory()->create(['name' => 'James', 'surname' => 'Bond']);
    Spy::factory()->create(['name' => 'Ethan', 'surname' => 'Hunt']);

    $response = $this->getJson(route('spies.index', ['name' => 'Bond']));

    $response->assertOk()
        ->assertJsonCount(1, 'data')
        ->assertJsonPath('data.0.full_name', 'James Bond');
});

test('Filters spies by age range.', function () {
    $today = now();
    Spy::factory()->create(['date_of_birth' => $today->copy()->subYears(30)]);
    Spy::factory()->create(['date_of_birth' => $today->copy()->subYears(40)]);

    $response = $this->getJson(route('spies.index', ['age' => [25, 35]]));

    $response->assertOk()
        ->assertJsonCount(1, 'data');
});

test('Orders spies by full name.', function () {
    Spy::factory()->create(['name' => 'James', 'surname' => 'Bond']);
    Spy::factory()->create(['name' => 'Ethan', 'surname' => 'Hunt']);

    $response = $this->getJson(route('spies.index', ['order' => [['full_name', 'asc']]]));

    $response->assertOk()
        ->assertJson(fn (AssertableJson $json) => $json->has('data', 2)
            ->has('meta')
            ->has('links')
            ->where('data.0.full_name', 'Ethan Hunt')
            ->where('data.1.full_name', 'James Bond')
        );
});
