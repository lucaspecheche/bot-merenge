<?php

Route::match(['get', 'post'], '/botman', function (){
    $botman = app('botman');
    $botman->listen();
});

//Route::get('/botman/tinker', 'BotManController@tinker');