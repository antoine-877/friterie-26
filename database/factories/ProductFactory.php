<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Douze produits de friterie, absents des données du seeder.
     */
    private const NAMES = [
        'Américain préparé', 'Bicky burger', 'Boulette', 'Cheeseburger', 'Hamburger', 'Jus d\'orange',
        'Lucifer', 'Poulycroc', 'Sauce américaine', 'Sauce brazil', 'Thé glacé', 'Viandelle',
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'name' => fake()->randomElement(self::NAMES),
            'price' => fake()->randomFloat(2, 0.8, 9),
            'description' => fake()->optional()->sentence(),
            'sold_out_at' => null,
        ];
    }

    /**
     * Un produit en rupture depuis une heure à une semaine.
     */
    public function soldOut(): static
    {
        return $this->state(fn (array $attributes): array => [
            'sold_out_at' => fake()->dateTimeBetween('-1 week', '-1 hour'),
        ]);
    }
}
