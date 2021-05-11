<?php

use Illuminate\Database\Seeder;

class FoodCategoriesTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\FoodCategory::create([
            'name' => 'Acompanhamentos',
        ]);
        App\FoodCategory::create([
            'name' => 'Carnes',
        ]);
        App\FoodCategory::create([
            'name' => 'Saladas',
        ]);
        App\FoodCategory::create([
            'name' => 'Sobremesas',
        ]);
        App\FoodCategory::create([
            'name' => 'Bebidas',
        ]);
    }
}
