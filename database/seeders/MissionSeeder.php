<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Mission;
use App\Models\Spy;
use Illuminate\Database\Seeder;

class MissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $spies = Spy::query()->select(['id', 'name', 'agency_id'])->get();

        $ciaSpy = $spies->where('name', 'James')->first();
        $lapdSpy = $spies->where('name', 'Panos')->first();

        Mission::factory(2)
            ->sequence([
                'title' => 'Make the World a better place.',
                'agency_id' => $ciaSpy->agency_id,
                'spy_id' => $ciaSpy->id,
            ], [
                'title' => 'Clannish the world from bugs.',
                'agency_id' => $lapdSpy->agency_id,
                'spy_id' => $lapdSpy->id,
            ])
            ->create();
    }
}
