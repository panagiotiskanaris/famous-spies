<?php

use App\Actions\Spy\DeleteSpyAction;
use App\Exceptions\SpyDeletionException;
use App\Models\Agency;
use App\Models\Spy;

beforeEach(function () {
    $this->action = new DeleteSpyAction;

    $this->spy = Spy::factory()->create();
});

test('Deletes an existing spy', function () {
    expect(Spy::query()->count())->toBe(1);

    $this->action->handle($this->spy);

    expect(Spy::query()->count())->toBe(0);
});
