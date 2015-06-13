<?php

namespace AppquariumBundle\Entity;


use FOS\UserBundle\Model\User as BaseUser,
    Symfony\Component\HttpFoundation\File\UploadedFile,
    AppquariumBundle\Aquarium\Library\Cipher;


class User extends BaseUser
{
    protected $name;
    protected $surname;
    protected $ip;
    protected $avatar;
    protected $image;
    protected $newsletterSubscription;
    private $tempImage;

    public function __construct()
    {
        parent::__construct();
        $this->newsletterSubscription = false;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage(UploadedFile $file = null)
    {
        $this->image = $file;

        if (isset($this->avatar)) {
            $this->tempImage = $this->getAvatar();
            $this->avatar = null;
        } else {
            $this->avatar = 'default.jpg';
        }
        return $this;
    }

    public function isNewsletterSubscription()
    {
        return $this->newsletterSubscription;
    }

    public function setNewsletterSubscription($subscriptionToNewsletter)
    {
        $this->newsletterSubscription = (Boolean) $subscriptionToNewsletter;
        return $this;
    }

    public function getAvatar()
    {
        return $this->avatar;
    }

    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
        return $this;
    }

    public function getAbsolutePath()
    {
        return null === $this->avatar
            ? null
            : $this->getUploadRootDir().'/'.$this->avatar;
    }

    public function getUploadRootDir()
    {
        return $_SERVER['DOCUMENT_ROOT'] . '/' . $this->getUploadDir();
    }

    protected function getUploadDir()
    {
        return 'assets/dashboard/img/uploads/userAvatar';
    }

    public function getWebPath()
    {
        return '/'.$this->getUploadDir() . '/' . $this->getAvatar();
    }

    public function preUpload()
    {
        if (null !== $this->getImage())
        {
            $filename = sha1(uniqid(mt_rand(), true));
            $this->setAvatar( $filename . '.' . $this->getImage()->guessExtension());
        } else
        {
            $this->setAvatar('default.jpg');
        }
    }

    public function upload()
    {
        if (null === $this->getImage()) {
            return;
        }

        $this->getImage()->move($this->getUploadRootDir(), $this->getAvatar());

        if(isset($this->tempImage) && file_exists($this->getUploadRootDir() . '/' . $this->tempImage))
        {
            unlink($this->getUploadRootDir(). '/' . $this->tempImage);
            $this->tempImage = null;
        }
        $this->image = null;

    }

    public function removeUpload()
    {
        if ($file = $this->getAbsolutePath() && file_exists($this->getAbsolutePath())) {
            unlink($file);
        }
    }

    public function getIp()
    {
        return $this->ip;
    }

    public function setIp()
    {
        $this->ip = $this->get_ip_address();
    }

    public function getSurname()
    {
        $cipher = $this->getCipherAlgorithm();
        if(!$this->is_valid_cipher($this->surname)) return $this->surname;
        return $cipher->decrypt($this->surname);
    }

    public function setSurname($surname)
    {
        $cipher = $this->getCipherAlgorithm();
        $this->surname = $cipher->encrypt($surname);
        return $this;
    }

    public function getName()
    {
        $cipher = $this->getCipherAlgorithm();
        if(!$this->is_valid_cipher($this->name)) return $this->name;
        return $cipher->decrypt($this->name);
    }

    public function setName($name)
    {
        $cipher = $this->getCipherAlgorithm();
        $this->name =  $cipher->encrypt($name);
        return $this;
    }

    public function getUsername()
    {
        $cipher = $this->getCipherAlgorithm();
        if(!$this->is_valid_cipher($this->username)) return $this->username;
        return $cipher->decrypt($this->username);
    }

    public function setUsername($username)
    {
        $cipher = $this->getCipherAlgorithm();
        $this->username = $cipher->encrypt($username);
        return $this;
    }

    public function getUsernameCanonical()
    {
        $cipher = $this->getCipherAlgorithm();
        if(!$this->is_valid_cipher($this->usernameCanonical)) return $this->usernameCanonical;
        return $cipher->decrypt($this->usernameCanonical);
    }

    public function setUsernameCanonical($usernameCanonical)
    {
        $cipher = $this->getCipherAlgorithm();
        $this->usernameCanonical = $cipher->encrypt($usernameCanonical);
        return $this;
    }

    public function getEmail()
    {
        $cipher = $this->getCipherAlgorithm();
        if(!$this->is_valid_cipher($this->email)) return $this->email;
        return $cipher->decrypt($this->email);
    }

    public function setEmail($email)
    {
        $cipher = $this->getCipherAlgorithm();
        $this->email = $cipher->encrypt($email);
        return $this;
    }

    public function getEmailCanonical()
    {
        $cipher = $this->getCipherAlgorithm();
        if(!$this->is_valid_cipher($this->emailCanonical)) return $this->emailCanonical;
        return $cipher->decrypt($this->emailCanonical);
    }

    public function setEmailCanonical($emailCanonical)
    {
        $cipher = $this->getCipherAlgorithm();
        $this->emailCanonical = $cipher->encrypt($emailCanonical);
        return $this;
    }

    private function is_valid_cipher($encoded)
    {
        return (Boolean) strrchr($encoded, '=');
    }

    protected function get_ip_address()
    {
        $ip_keys = array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED',
            'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR'
        );
        foreach ($ip_keys as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip);
                    if ($this->validate_ip($ip)) {
                        return $ip;
                    }
                }
            }
        }
        return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : false;
    }

    protected function validate_ip($ip)
    {
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) === false) {
            return false;
        }
        return true;
    }

    private function getCipherAlgorithm()
    {
        return new Cipher();
    }

}
