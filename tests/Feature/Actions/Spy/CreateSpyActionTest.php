<?php

use App\Actions\Spy\CreateSpyAction;
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
