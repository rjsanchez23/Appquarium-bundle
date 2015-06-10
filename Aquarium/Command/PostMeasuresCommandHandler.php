<?php


namespace AppquariumBundle\Aquarium\Command;



use AppquariumBundle\Services\MeasurePost;
use SimpleBus\Message\Handler\MessageHandler;
use SimpleBus\Message\Message;

class PostMeasuresCommandHandler implements MessageHandler {

    private $register;

    public function __construct(MeasurePost $register)
    {
        $this->register = $register;
    }

    public function handle(Message $message)
    {

        $this->register->store($message->measures, $message->measuresDate, $message->id);

    }
}