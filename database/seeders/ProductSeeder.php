<?php

namespace Database\Seeders;

use App\Models\Allergen;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Les seize produits de la carte, dont un en rupture.
     * Les dates sont fixes, pour que les captures du cours restent vraies.
     */
    public function run(): void
    {
        $products = [
            ['Petite frite', 'Frites', '3.00', 'Un cornet de frites fraîches, coupées le matin.', [], null],
            ['Grande frite', 'Frites', '4.00', 'Le grand cornet, pour les gros appétits.', [], null],
            ['Fricadelle', 'Snacks', '2.50', 'La classique, croustillante dehors.', ['Gluten', 'Soja'], null],
            ['Boulet sauce lapin', 'Snacks', '4.50', 'Un boulet de viande nappé de sauce lapin, recette de la maison.', ['Gluten', 'Œuf', 'Moutarde'], null],
            ['Croquette de fromage', 'Snacks', '2.80', 'Deux croquettes au fromage fondant.', ['Gluten', 'Lactose', 'Œuf'], null],
            ['Cervelas', 'Snacks', '2.70', 'Nature ou en sauce.', ['Moutarde'], null],
            ['Brochette ardennaise', 'Snacks', '4.20', 'Viande marinée, grillée à la commande.', [], null],
            ['Mitraillette', 'Snacks', '7.50', 'Une demi-baguette, une viande au choix, des frites et une sauce.', ['Gluten'], null],
            ['Mayonnaise', 'Sauces', '0.80', null, ['Œuf', 'Moutarde'], null],
            ['Andalouse', 'Sauces', '0.80', 'Une mayonnaise relevée à la tomate et au poivron.', ['Œuf', 'Moutarde'], null],
            ['Samouraï', 'Sauces', '0.80', 'Pour ceux qui aiment quand ça pique.', ['Œuf', 'Moutarde'], null],
            ['Tartare', 'Sauces', '0.80', 'Avec des cornichons et des câpres.', ['Œuf', 'Moutarde'], null],
            ['Sauce lapin', 'Sauces', '1.20', 'La sauce du boulet, servie à part.', ['Gluten', 'Moutarde'], '2026-10-03 11:30:00'],
            ['Eau plate 50 cl', 'Boissons', '1.50', null, [], null],
            ['Limonade', 'Boissons', '2.00', null, [], null],
            ['Café', 'Boissons', '1.80', null, [], null],
        ];

        foreach ($products as [$name, $categoryName, $price, $description, $allergenNames, $soldOutAt]) {
            $product = Product::create([
                'category_id' => Category::where('name', $categoryName)->value('id'),
                'name' => $name,
                'price' => $price,
                'description' => $description,
                'sold_out_at' => $soldOutAt,
            ]);

            $product->allergens()->attach(Allergen::whereIn('name', $allergenNames)->pluck('id'));
        }
    }
}
