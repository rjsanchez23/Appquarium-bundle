<?php namespace AppquariumBundle\Aquarium\Command\Admin;

use SimpleBus\Message\Type\Command;

class UpdateUserCommand implements Command{

    private $user_data;

    public function __construct(array $data)
    {
        $this->user_data = $data;
    }

    public function getUserData()
    {
        return $this->user_data;
    }
} 