<?php

namespace App\Providers;

use App\Http\Middleware\AuthUserWebHook;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Cache\LaravelCache;
use BotMan\BotMan\Drivers\DriverManager;
use Illuminate\Support\ServiceProvider;
use BotMan\BotMan\Container\LaravelContainer;
use BotMan\BotMan\Storages\Drivers\FileStorage;

class BotManTelegramProvider extends ServiceProvider
{
    public function boot()
    {
        app('botman')->middleware->received(new AuthUserWebHook());
    }

    public function register()
    {
        DriverManager::loadDriver(\BotMan\Drivers\Telegram\TelegramDriver::class);

        $this->app->singleton('botman', function ($app) {
            $storage = new FileStorage(storage_path('botman'));

            $botman = BotManFactory::create(config('telegram'), new LaravelCache(), app('request'),
                $storage);

            $botman->setContainer(new LaravelContainer($this->app));

            return $botman;
        });

    }
}
