<?php

namespace Database\Factories;

use App\Models\Spy;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Spy>
 */
class SpyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'surname' => fake()->name(),
        ];
    }
}
