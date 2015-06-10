<?php namespace AppquariumBundle\Aquarium\Library;

use AppquariumBundle\Aquarium\Library\CipherInterface;

class Cipher implements CipherInterface {

    const KEY = 'MySuP3RS3cR3TAppQu4riumK';

    public function encrypt($string)
    {
        return trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, self::KEY, $string, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND))));
    }

    public function decrypt($encrypted_string)
    {
        return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, self::KEY, base64_decode($encrypted_string), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)));
    }
} 