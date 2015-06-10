<?php namespace AppquariumBundle\Aquarium\ValueObjects;

class Name {

    private $value;
    const STRING_PATTERN = '/^[\w\s]+$/';

    public function __construct($string)
    {
        $this->validate($string);
        $this->value = $string;
    }

    public function value()
    {
        return $this->value;
    }

    public function __toString()
    {
        return $this->value;
    }

    private function validate($string)
    {
        if(!preg_match(self::STRING_PATTERN, $string) || mb_strlen($string, 'UTF-8') > 30)
        {
            throw new \InvalidArgumentException("El campo siguiente: $string no cumple con el formato esperado.");
        }
    }
}