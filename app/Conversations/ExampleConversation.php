<?php

namespace App\Conversations;

use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;

class ExampleConversation extends Conversation
{
    /**
     * First question
     */
    public function askReason()
    {
        $question = Question::create("Escolha o Pedido de Hoje:")
            ->fallback('Unable to ask question')
            ->callbackId('ask_reason')
            ->addButtons([
                Button::create('A Parmegiana')->value('56'),
                Button::create('Filé de Frango')->value('14'),
            ]);

        return $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                if ($answer->getValue() === 'joke') {
                    $joke = json_decode(file_get_contents('http://api.icndb.com/jokes/random'));
                    $this->say($joke->value->joke);
                } else {
                    $this->say('Pedido Adicionado com sucesso');
                }
            }
        });
    }

    /**
     * Start the conversation
     */
    public function run()
    {
        $this->askReason();
    }
}
