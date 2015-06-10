<?php


namespace AppquariumBundle\Aquarium\Command;


use AppquariumBundle\Services\AccessoryPost;
use SimpleBus\Message\Handler\MessageHandler;
use SimpleBus\Message\Message;

class PostAccessoryCommandHandler implements MessageHandler {

    private $register;

    public function __construct(AccessoryPost $register)
    {
        $this->register = $register;
    }

    public function handle(Message $message)
    {
        $message->accessoryId = $this->register->store($message);
    }
}