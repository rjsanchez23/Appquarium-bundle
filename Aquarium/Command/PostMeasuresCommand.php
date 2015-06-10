<?php


namespace AppquariumBundle\Aquarium\Command;

use SimpleBus\Message\Type\Command;

class PostMeasuresCommand implements Command
{

    public $id;
    public $measures;
    public $avatar;
    public $measuresDate;
    public $response;


    public function __construct(Array $measures, $measuresDate, $aquariumId)
    {
        $this->measures = $measures;
        $this->id = $aquariumId;
        $this->measuresDate = $measuresDate;
    }

    public function __get($property)
    {
        if (isset($this->measures[$property])) {
            return $this->measures[$property];
        }
        return null;
    }


}