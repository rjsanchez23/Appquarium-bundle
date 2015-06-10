<?php namespace AppquariumBundle\Aquarium\ValueObjects;

use InvalidArgumentException;

class Email {

    private $value;

    public function __construct($email)
    {
        $this->validate($email);
        $this->value = $email;
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
        if(!filter_var($value, FILTER_VALIDATE_EMAIL))
        {
            throw new InvalidArgumentException('Email invalido');
        }
    }
} 