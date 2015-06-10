<?php namespace AppquariumBundle\Aquarium\ValueObjects;

class Surname {

    private $value;
    const STRING_PATTERN = '/^[a-z0-9_\-\s]{3,30}$/';

    public function __construct($string)
    {
        $this->validate($string);
        $this->value = $string;
    }

    public function value()
    {
        return $this->value;
    }
    private function validate($string)
    {
        if(!is_string($string) || mb_strlen($string, 'UTF-8') > 30)
        {
            throw new \InvalidArgumentException("El campo siguiente: $string no cumple con el formato esperado.");
        }
    }

    public function __toString()
    {
        return $this->value;
    }
} 