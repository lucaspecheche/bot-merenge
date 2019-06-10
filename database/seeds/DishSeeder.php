<?php

use Illuminate\Database\Seeder;
use App\Models\Dish;
use App\Enumerators\DishesEnum;

class DishSeeder extends Seeder
{
    public function run()
    {
        $dishes = [
            'A parmegiana de Frango',
            'Peixe Empanado',
            'Escondidinho de Carne',
            'Frango xadrez',
            'Calabresa Acebolada',
            'File de Frango',
            'Omelete'
        ];

        foreach ($dishes as $dish){
            Dish::query()->create(['name' => $dish, 'type' => DishesEnum::DISH_DAY]);
        }
    }
}
