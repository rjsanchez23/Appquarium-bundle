<?php namespace AppquariumBundle\Aquarium\Command\Admin;

use AppquariumBundle\Services\Admin\AdminService;
use SimpleBus\Message\Handler\MessageHandler;
use SimpleBus\Message\Message;

class UpdateUserCommandHandler implements MessageHandler{

    private $service;

    public function __construct(AdminService $service)
    {
        $this->service = $service;
    }

    public function handle(Message $message)
    {
        $this->service->update($message->getUserData());
    }
} 