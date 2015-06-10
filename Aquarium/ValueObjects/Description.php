<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 06/06/15
 * Time: 20:58
 */

namespace AppquariumBundle\Aquarium\ValueObjects;


class Description {

    private $value;
    const STRING_PATTERN = '/^[a-z0-9_\-\s]$/';

    public function __construct($description)
    {
        $this->value = $description;
        $this->validate($description);
    }

    public function value()
    {
        return $this->value;
    }

    public function __toString()
    {
        return $this->value;
    }

    private function validate($description)
    {
        if(!preg_match(self::STRING_PATTERN, $description))
        {
            $this->value= " ";
        }
    }

}