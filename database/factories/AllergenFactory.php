<?php

namespace Database\Factories;

use App\Models\Allergen;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Allergen>
 */
class AllergenFactory extends Factory
{
    /**
     * Les six allergènes à déclarer que le seeder n'utilise pas.
     */
    private const NAMES = [
        'Crustacés', 'Fruits à coque', 'Lupin', 'Mollusques', 'Sésame', 'Sulfites',
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(self::NAMES),
        ];
    }
}
