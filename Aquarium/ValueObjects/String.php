<?php namespace AppquariumBundle\Aquarium\ValueObjects;


class String {

    private $value;

    public function __construct($string)
    {
        $this->value = $string;
        $this->validate($string);
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
        if(empty($string))
        {
            throw (new \InvalidArgumentException("El campo no debe estar vacío", 404));
        }
    }




}