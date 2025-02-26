<?php

use App\Actions\Spy\CreateSpyAction;
use App\Models\Agency;
use App\Models\Spy;

beforeEach(function () {
    $this->action = new CreateSpyAction;
});

test('Creates a spy with valid data.', function () {
    $spyData = Spy::factory()->make([
        'name' => 'James',
        'surname' => 'Bond',
    ])->toArray();

    $spy = $this->action->handle($spyData);

    expect($spy)->toBeInstanceOf(Spy::class)
        ->and($spy->name)->toBe('James')
        ->and($spy->surname)->toBe('Bond')
        ->and($spy->date_of_death)->toBeNull()
        ->and($spy->agency_id)->toBeNull();

    $this->assertDatabaseHas('spies', [
        'name' => 'James',
        'surname' => 'Bond',
    ]);
});

test('Throw DB Error for combination of name, surname and agency_id already exists.', function () {
    $agency = Agency::factory()->create();

    Spy::factory()->create([
        'name' => 'James',
        'surname' => 'Bond',
        'agency_id' => $agency->id,
    ]);

    $spyData = Spy::factory()->make([
        'name' => 'James',
        'surname' => 'Bond',
        'agency_id' => $agency->id,
    ])->toArray();

    $this->action->handle($spyData);
})->throws(PDOException::class);
