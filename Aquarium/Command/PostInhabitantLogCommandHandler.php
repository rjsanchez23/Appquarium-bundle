<?php

namespace AppquariumBundle\Aquarium\Command;




use AppquariumBundle\Services\AquariumInhabitantPost;
use SimpleBus\Message\Handler\MessageHandler;
use SimpleBus\Message\Message;


class PostInhabitantLogCommandHandler implements MessageHandler {

    private $register;

    public function __construct(AquariumInhabitantPost $register)
    {
        $this->register = $register;
    }

    public function handle(Message $message)
    {

        $this->register->storeLog($message);


    }
}