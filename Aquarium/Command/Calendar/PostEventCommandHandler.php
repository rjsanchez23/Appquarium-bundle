<?php


namespace AppquariumBundle\Aquarium\Command\Calendar;


use AppquariumBundle\Services\CalendarService;
use SimpleBus\Message\Handler\MessageHandler;
use SimpleBus\Message\Message;

class PostEventCommandHandler implements MessageHandler {

    private $register;

    public function __construct(CalendarService $register)
    {
        $this->register = $register;
    }

    public function handle(Message $message)
    {
        $message->eventId =  $this->register->store($message);
    }
}