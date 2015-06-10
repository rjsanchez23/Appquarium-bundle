<?php namespace AppquariumBundle\Aquarium\ValueObjects;

use InvalidArgumentException;

class Newsletter {

    private $value;

    public function __construct($newsletter)
    {
        $this->validate($newsletter);
        $this->value = $newsletter;
    }

    public function value()
    {
        return $this->value;
    }

    public function __toString()
    {
        return $this->value;
    }

    private function validate($value)
    {
        if(strlen($value) < 50)
        {
            throw new InvalidArgumentException('Porfavor redacted una Newsletter de al menos 50 caracteres de longitud para que se considere valida');
        }
    }
} 