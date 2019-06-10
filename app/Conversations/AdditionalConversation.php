<?php

namespace App\Conversations;

use App\Enumerators\DishesEnum;
use App\Models\Menu;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;

class AdditionalConversation extends Conversation
{
    protected $menu;

    public function __construct(Menu $menu)
    {
        $this->menu = $menu;
    }

    public function run()
    {
        $dishDayQuestion = Question::create("Escolha o adicional Prato:")
            ->fallback('Não conseguimos identificar seu Pedido')
            ->callbackId('ask_additional')
            ->addButtons($this->buttons());

        $this->ask($dishDayQuestion, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                $this->say('Pedido Adicional OK');
            }
        });
    }

    private function buttons(): array
    {
        $dishes = data_get($this->menu->dishesTypes, DishesEnum::ADDITIONAL, []);

        $buttons = [];
        foreach ($dishes as $dish){
            array_push($buttons, Button::create($dish->name)->value($dish->id));
        }

        return $buttons;
    }
}