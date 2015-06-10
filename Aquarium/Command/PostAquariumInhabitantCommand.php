<?php


namespace AppquariumBundle\Aquarium\Command;


use SimpleBus\Message\Type\Command;
use Symfony\Component\HttpFoundation\Response;

class PostAquariumInhabitantCommand implements Command {

    public $inhabitantId;
    public $data;
    public $avatar;
    public $response;

    public function __construct(Array $data, Array $avatar)
    {
        $this->data = $data;
        $this->avatar = $avatar;
    }

    public function __get($property)
    {
        if( isset($this->data[$property]) )
        {
            return $this->data[$property];
        }
        return null;
    }

    public function getResponse(){

    return $this->response;
    }

    public function setResponse(Response $response){
        $this->response = $response;


    }



}