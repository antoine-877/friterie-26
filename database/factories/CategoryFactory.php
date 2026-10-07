<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Huit noms de catégorie, absents des données du seeder.
     */
    private const NAMES = [
        'Burgers', 'Desserts', 'Glaces', 'Menus enfants', 'Pitas', 'Salades', 'Suggestions', 'Viandes',
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
            'position' => fake()->numberBetween(5, 20),
        ];
    }
}
