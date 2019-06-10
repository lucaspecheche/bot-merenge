<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public function dishes()
    {
        return $this->belongsToMany(Dish::class, 'dishes_menus', 'menuId', 'dishId')->withTimestamps();
    }

    public static function dishByType($id): Menu
    {
        $menu              = Menu::query()->find($id)->first();
        $menu->dishesTypes = $menu->dishes->groupBy('type');

        return $menu;
    }
}
