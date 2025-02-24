<?php

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
        $agency = Agency::query()->first();

        Spy::factory(2)->create([
            'agency_id' => $agency->id,
        ]);
    }
}
