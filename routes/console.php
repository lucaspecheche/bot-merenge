<?php

use Illuminate\Foundation\Inspiring;
use App\Models\Menu;
/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('tt', function () {
    $menu = (new Menu());
    $dish = \App\Models\Dish::query()->find(1);
    $requests = \App\Models\Request::query()->find(4);
    dd($menu->dishDay(1)->first()->dishes->toArray());

    //dd($menu->dishes->toArray());
});