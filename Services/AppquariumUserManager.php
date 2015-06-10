<?php

namespace AppquariumBundle\Services;

use AppquariumBundle\Aquarium\Library\Cipher;
use Doctrine\Common\Persistence\ObjectManager;
use FOS\UserBundle\Doctrine\UserManager as BaseUserManager;
use FOS\UserBundle\Util\CanonicalizerInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class AppquariumUserManager extends BaseUserManager {

    private $cipher;
    
    public function __construct(EncoderFactoryInterface $encoderFactory,
                                CanonicalizerInterface $usernameCanonicalizer,
                                CanonicalizerInterface $emailCanonicalizer,
                                ObjectManager $om,
                                Cipher $cipher,
                                $class)
    {

        parent::__construct($encoderFactory, $usernameCanonicalizer, $emailCanonicalizer, $om, $class);
        $this->cipher = $cipher;
    }

    public function findUserByEmail($email)
    {
        $canonicalizedEmail = $this->canonicalizeEmail($email);
        $encryptedEmail = $this->cipher->encrypt($canonicalizedEmail);
        return $this->findUserBy(array('emailCanonical' => $encryptedEmail));
    }

    public function findUserByUsername($username)
    {
        $canonicalizedUsername = $this->canonicalizeUsername($username);
        $encryptedUsername = $this->cipher->encrypt($canonicalizedUsername);
        return $this->findUserBy(array('usernameCanonical' => $encryptedUsername));
    }
} 