<?php

namespace Database\Seeders;

use App\Models\Agency;
use App\Models\Mission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $agency = Agency::query()->first();

        Mission::factory()->create([
            'agency_id' => $agency->id,
        ]);
    }
}
