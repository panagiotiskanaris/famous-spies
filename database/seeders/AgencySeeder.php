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
        Agency::factory(4)
            ->sequence([
                'name' => 'Agency A',
            ], [
                'name' => 'Agency B',
            ], [
                'name' => 'Agency C',
            ], [
                'name' => 'Agency D',
            ])
            ->create();
    }
}
