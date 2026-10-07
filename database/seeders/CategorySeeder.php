<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Les quatre catégories de la carte, dans l'ordre où elles s'affichent.
     */
    public function run(): void
    {
        foreach (['Frites', 'Snacks', 'Sauces', 'Boissons'] as $index => $name) {
            Category::create(['name' => $name, 'position' => $index + 1]);
        }
    }
}
