<?php


namespace AppquariumBundle\Aquarium\Command;



use AppquariumBundle\Services\ImagePost;
use SimpleBus\Message\Handler\MessageHandler;
use SimpleBus\Message\Message;

class PostImagesCommandHandler implements MessageHandler {

    private $register;

    public function __construct(ImagePost $register)
    {
        $this->register = $register;
    }

    public function handle(Message $message)
    {

        $message->response = $this->register->store($message->images, $message->aquariumId);

    }
}