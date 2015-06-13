<?php

namespace AppquariumBundle\Aquarium\ValueObjects;


class Decimal {

    private $value;

    public function __construct($decimal)
    {
        $this->value = $decimal;
        $this->validate($decimal);
    }

    public function value()
    {
        return $this->value;
    }

    public function validate($decimal)
    {

        if (!filter_var($decimal, FILTER_VALIDATE_FLOAT) && !filter_var($decimal, FILTER_VALIDATE_INT))
        {
            $this->value = 0;
        }

    }
}
