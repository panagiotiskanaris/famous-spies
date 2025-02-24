<?php

namespace Database\Seeders;

use App\Models\Spy;
use Illuminate\Database\Seeder;

class SpySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Spy::factory(2)->create();
    }
}
