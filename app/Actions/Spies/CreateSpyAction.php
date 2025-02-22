<?php

namespace App\Actions\Spies;

use App\Models\Spy;

class CreateSpyAction
{
    public function handle(array $spyData): Spy
    {
        return Spy::query()->create($spyData);
    }
}
