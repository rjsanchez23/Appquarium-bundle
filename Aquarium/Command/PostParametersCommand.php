<?php


namespace AppquariumBundle\Aquarium\Command;

use SimpleBus\Message\Type\Command;

class PostParametersCommand implements Command{


    public $idAquarium;
    public $parameters;

    public function __construct($idAquarium, Array $parameters)
    {

        $this->idAquarium = $idAquarium;
        $this->parameters = $parameters;
    }

    public function __get($property)
    {
        if( isset($this->parameters[$property]) )
        {
            return $this->parameters[$property];
        }
        return null;
    }


}