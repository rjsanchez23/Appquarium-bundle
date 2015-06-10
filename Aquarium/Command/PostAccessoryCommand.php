<?php


namespace AppquariumBundle\Aquarium\Command;

use SimpleBus\Message\Type\Command;

class PostAccessoryCommand implements Command{

    public $aquariumId;
    public $data;
    public $accessoryId;


    public function __construct(Array $data, $aquariumId)
    {
        $this->data = $data;
        $this->aquariumId = $aquariumId;
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