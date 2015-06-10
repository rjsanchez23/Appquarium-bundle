<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 06/06/15
 * Time: 21:09
 */

namespace AppquariumBundle\Aquarium\ValueObjects;


class Family {

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

        if (($type !== "Vertebrate" ) || ($type !== "Invertebrate"))
        {
            $this->value = "Vertebrate";
        }
    }


}