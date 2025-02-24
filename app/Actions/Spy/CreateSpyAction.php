<?php

declare(strict_types=1);

namespace App\Actions\Spy;

use App\Models\Spy;

class CreateSpyAction
{
    public function handle(array $spyData): Spy
    {
        return Spy::query()->create($spyData);
    }
}
