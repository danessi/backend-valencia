<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ingredient;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insertar ingredientes de ejemplo
        Ingredient::create([
            'name' => 'Tomate',
            'quantity' => 50,
            'price' => 1.25,
        ]);

        Ingredient::create([
            'name' => 'Lechuga',
            'quantity' => 100,
            'price' => 0.75,
        ]);

        Ingredient::create([
            'name' => 'Cebolla',
            'quantity' => 30,
            'price' => 0.80,
        ]);

        Ingredient::create([
            'name' => 'Pepino',
            'quantity' => 20,
            'price' => 1.10,
        ]);

        Ingredient::create([
            'name' => 'Aguacate',
            'quantity' => 15,
            'price' => 1.50,
        ]);
    }
}