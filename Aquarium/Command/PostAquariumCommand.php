<?php


namespace AppquariumBundle\Aquarium\Command;

use SimpleBus\Message\Type\Command;

class PostAquariumCommand implements Command{

    public $aquariumId;
    public $data;
    public $avatar;
    public $userId;


    public function __construct(Array $data, Array $avatar,$userId, $aquariumId = null)
    {
        $this->data = $data;
        $this->avatar = $avatar;
        $this->aquariumId = $aquariumId;
        $this->userId = $userId;
    }

    public function __get($property)
    {
        if( isset($this->data[$property]) )
        {
            return $this->data[$property];
        }
        return null;
    }


}