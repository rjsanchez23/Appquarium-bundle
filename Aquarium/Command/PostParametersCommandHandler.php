<?php

namespace AppquariumBundle\Aquarium\Command;


use AppquariumBundle\Services\ParameterPost;
use SimpleBus\Message\Handler\MessageHandler;
use SimpleBus\Message\Message;

class PostParametersCommandHandler implements MessageHandler {

    private $register;

    public function __construct(ParameterPost $register)
    {
        $this->register = $register;
    }

    public function handle(Message $message)
    {

        $this->register->store($message->idAquarium, $message->parameters);
    }
}