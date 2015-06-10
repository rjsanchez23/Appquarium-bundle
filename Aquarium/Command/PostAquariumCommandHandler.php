<?php


namespace AppquariumBundle\Aquarium\Command;


use AppquariumBundle\Services\AquariumPost;
use SimpleBus\Message\Handler\MessageHandler;
use SimpleBus\Message\Message;

class PostAquariumCommandHandler implements MessageHandler {

    private $register;

    public function __construct(AquariumPost $register)
    {
        $this->register = $register;
    }

    public function handle(Message $message)
    {
        $message->id = $this->register->store($message);
    }
}