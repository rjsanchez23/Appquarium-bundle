<?php


namespace AppquariumBundle\Aquarium\Library;


class ImageNameHasher implements ImageNameHasherInterface
{
    public function hash($name)
    {
       return  uniqid() . '.' . pathinfo( $name, PATHINFO_EXTENSION);
    }


}