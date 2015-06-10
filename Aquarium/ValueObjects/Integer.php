<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 06/06/15
 * Time: 20:56
 */

namespace AppquariumBundle\Aquarium\ValueObjects;


class Integer {

    private $value;

    public function __construct($integer)
    {
        $this->validate($integer);
    }

    public function value()
    {
        return $this->value;
    }

    public function __toString()
    {
        return $this->value;
    }

    public function validate($integer)
    {

        (!filter_var($integer,FILTER_VALIDATE_INT)) ? $this->value = 0 : $this->value = $integer;
    }
}
