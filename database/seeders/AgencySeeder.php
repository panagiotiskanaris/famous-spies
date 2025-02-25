<?php

namespace Database\Seeders;

use App\Models\Agency;
use Illuminate\Database\Seeder;

class AgencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Agency::factory(2)
            ->sequence([
                'name' => 'CIA',
            ], [
                'name' => 'LAPD',
            ])
            ->create();
    }
}
