<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Outfit>
 */
class OutfitFactory extends Factory
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
            'name' => fake()->words(3, true),
            'description' => fake()->text(),
            'sale_price' => fake()->randomNumber(),
            'cover_image' => 'media/outfits/default_outfit.jpg',
            'status' => fake()->boolean(),
            'user_id'  => fake()->randomElement($managers->pluck('id')),
        ];
    }
}


