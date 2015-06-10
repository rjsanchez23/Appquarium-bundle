<?php namespace AppquariumBundle\Aquarium\Command\Admin;

use AppquariumBundle\Services\Admin\AdminService,
    SimpleBus\Message\Handler\MessageHandler,
    SimpleBus\Message\Message;

class DeleteUserCommandHandler implements MessageHandler{

    private $service;

    public function __construct(AdminService $service)
    {
        $this->service = $service;
    }

    public function handle(Message $message)
    {
        $email = $message->getEmail();
        $this->service->delete($email);
    }
} 