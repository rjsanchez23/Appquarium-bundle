<?php


namespace AppquariumBundle\Aquarium\Command;


use AppquariumBundle\Services\AquariumInhabitantPost;

use SimpleBus\Message\Handler\MessageHandler;
use SimpleBus\Message\Message;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class PostAquariumInhabitantCommandHandler implements MessageHandler {


    private $register;


    public function __construct(AquariumInhabitantPost $register)
    {
        $this->register = $register;
    }

    public function handle(Message $message)
    {

        $message->inhabitantId = $this->register->store($message->data, $message->avatar, $message->id);

    }


}