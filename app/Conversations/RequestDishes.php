<?php

namespace App\Conversations;

use App\Enumerators\DishesEnum;
use App\Models\Dish;
use App\Models\Menu;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;

class RequestDishes extends Conversation
{
    protected $menu;

    public function __construct(Menu $menu)
    {
        $this->menu = $menu;
    }

    public function run()
    {
        $this->askDishes();
    }

    private function askDishes()
    {
        $dishDayQuestion = Question::create("Escolha Seu Prato:")
            ->fallback('Não conseguimos identificar seu Pedido')
            ->callbackId('ask_dishes')
            ->addButtons($this->buttons());

        $this->ask($dishDayQuestion, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                $dish = (new Dish())->find($answer->getValue());
                $dish->users()->syncWithoutDetaching(auth()->user());

                $this->getBot()->startConversation(new AdditionalConversation($this->menu));
            }
        });
    }

    private function buttons(): array
    {
        $dishes = data_get($this->menu->dishesTypes, DishesEnum::DISH_DAY, []);

        $buttons = [];
        foreach ($dishes as $dish){
            array_push($buttons, Button::create($dish->name)->value($dish->id));
        }

        return $buttons;
    }
}