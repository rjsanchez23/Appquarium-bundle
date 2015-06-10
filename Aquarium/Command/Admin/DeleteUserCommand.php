<?php namespace AppquariumBundle\Aquarium\Command\Admin;

use SimpleBus\Message\Type\Command,
    AppquariumBundle\Aquarium\ValueObjects\Email;

class DeleteUserCommand implements Command {

    private $email;

    public function __construct(Email $email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

} 