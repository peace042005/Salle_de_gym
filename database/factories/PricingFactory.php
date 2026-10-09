<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pricing>
 */
class PricingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $managers = User::where('role', 'manager');

        return [
            'name' => fake()->randomElement([' Offre Gold', 'Offre Platine', 'Offre Diamond']),
            'duration' => fake()->text(),
            'price' => fake()->randomNumber(),
            'user_id'  => fake()->randomElement($managers->pluck('id')),
        ];
    }
}
