<?php

declare(strict_types=1);

namespace App\Actions\Spy;

use App\Models\Spy;

class CreateSpyAction
{
    public function handle(array $spyData): Spy
    {
        return Spy::query()->create([
            'name' => $spyData['name'],
            'surname' => $spyData['surname'],
            'date_of_birth' => $spyData['date_of_birth'],
            'country_of_operation' => $spyData['country_of_operation'] ?? null,
            'date_of_death' => $spyData['date_of_death'] ?? null,
            'agency_id' => $spyData['agency_id'] ?? null,
        ]);
    }
}
