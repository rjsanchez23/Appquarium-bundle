<?php namespace AppquariumBundle\Aquarium\Library;


interface CipherInterface {

    public function encrypt($string);
    public function decrypt($encrypted_string);
} 