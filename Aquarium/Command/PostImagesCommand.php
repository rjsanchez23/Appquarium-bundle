<?php


namespace AppquariumBundle\Aquarium\Command;

use SimpleBus\Message\Type\Command;

class PostImagesCommand implements Command{

    public $aquariumId;
    public $images;
    public $response;



    public function __construct(Array $images, $aquariumId)
    {

        $this->images = $images;
        $this->aquariumId = $aquariumId;
    }




}