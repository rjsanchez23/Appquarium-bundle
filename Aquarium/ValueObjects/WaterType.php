<?php

namespace AppquariumBundle\Aquarium\ValueObjects;


class WaterType {

    private $value;

    public function __construct($type)
    {
        $this->value = $type;
        $this->validate($type);
    }

    public function value()
    {
        return $this->value;
    }

    public function validate($type)
    {

        if (($type !== "freshwater" ) || ($type !== "saltwater"))
        {
            $this->value = "freshwater";
        }
    }

}