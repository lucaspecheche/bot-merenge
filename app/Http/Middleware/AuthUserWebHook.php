<?php

namespace App\Http\Middleware;

use App\User;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Interfaces\Middleware\Received;
use BotMan\BotMan\Messages\Incoming\IncomingMessage;
use Illuminate\Support\Facades\Auth;

class AuthUserWebHook implements Received
{
    public function received(IncomingMessage $message, $next, BotMan $bot)
    {
        $identifier = $bot->getDriver()->getUser($message);

        $user = (new User)->findOrCreate($identifier);
        Auth::login($user);

        return $next($message);
    }

}
