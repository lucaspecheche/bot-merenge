<?php

use App\Http\Controllers\BotManController;
use BotMan\BotMan\BotMan;

$botman = resolve('botman');

$botman->hears('/hello', function (BotMan $bot) {
    $bot->reply('Hello yourself.');
});

$botman->hears('/add', BotManController::class.'@add');

$botman->hears('/list', BotManController::class.'@list');
