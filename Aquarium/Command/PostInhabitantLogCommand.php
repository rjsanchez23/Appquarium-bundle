<?php


namespace AppquariumBundle\Aquarium\Command;

use SimpleBus\Message\Type\Command;



class PostInhabitantLogCommand implements Command{

    public $inhabitantId;
    public $comment;
    public $response;


    public function __construct($comment, $inhabitantId)
    {
        $this->comment = $comment;
        $this->inhabitantId = $inhabitantId;
    }

    public function __get($comment)
    {
        if( isset($this->comment) )
        {
            return $this->comment;
        }
        return null;
    }



}