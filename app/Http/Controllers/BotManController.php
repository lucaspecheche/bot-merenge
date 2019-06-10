<?php

namespace App\Http\Controllers;

use App\Conversations\RequestDishes;
use App\Models\Menu;
use BotMan\BotMan\BotMan;

class BotManController extends Controller
{
    public function add(BotMan $bot)
    {
        $bot->reply('Caiu no add');
    }

    public function list(BotMan $bot)
    {
        $menu = Menu::dishByType(1);
        $bot->startConversation(new RequestDishes($menu));
    }

}
