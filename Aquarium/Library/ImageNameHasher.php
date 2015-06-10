<?php


namespace AppquariumBundle\Aquarium\Library;


class ImageNameHasher
{
    public function hash($name)
    {
       return  uniqid() . '.' . pathinfo( $name, PATHINFO_EXTENSION);
    }


}