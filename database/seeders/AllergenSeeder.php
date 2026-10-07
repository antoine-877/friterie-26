<?php

namespace Database\Seeders;

use App\Models\Allergen;
use Illuminate\Database\Seeder;

class AllergenSeeder extends Seeder
{
    /**
     * Les huit allergènes que la carte de Nadia déclare.
     */
    public function run(): void
    {
        foreach (['Gluten', 'Lactose', 'Œuf', 'Arachide', 'Soja', 'Moutarde', 'Poisson', 'Céleri'] as $name) {
            Allergen::create(['name' => $name]);
        }
    }
}
