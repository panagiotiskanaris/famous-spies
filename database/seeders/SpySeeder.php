<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Agency;
use App\Models\Spy;
use Illuminate\Database\Seeder;

class SpySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $agencies = Agency::query()->select(['id', 'name'])->get();

        Spy::factory(2)
            ->sequence([
                'name' => 'James',
                'surname' => 'Bond',
                'country_of_operation' => 'USA',
                'agency_id' => $agencies->where('name', 'CIA')->first()->id,
            ], [
                'name' => 'Panos',
                'surname' => 'K.',
                'country_of_operation' => 'Greece',
                'agency_id' => $agencies->where('name', 'LAPD')->first()->id,
            ])
            ->create();
    }
}
