<?php

namespace AppquariumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Aquarium
 */
class Aquarium
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $alias;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $waterType;

    /**
     * @var integer
     */
    private $capacity;

    /**
     * @var string
     */
    private $avatar = "tank_bg.jpg";

    /**
     * @var \AppquariumBundle\Entity\User
     */
    private $user;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->problem = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set alias
     *
     * @param string $alias
     * @return Aquarium
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Get alias
     *
     * @return string 
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Aquarium
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set waterType
     *
     * @param string $waterType
     * @return Aquarium
     */
    public function setWaterType($waterType)
    {
        $this->waterType = $waterType;

        return $this;
    }

    /**
     * Get waterType
     *
     * @return string 
     */
    public function getWaterType()
    {
        return $this->waterType;
    }

    /**
     * Set capacity
     *
     * @param integer $capacity
     * @return Aquarium
     */
    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;

        return $this;
    }

    /**
     * Get capacity
     *
     * @return integer 
     */
    public function getCapacity()
    {
        return $this->capacity;
    }

    /**
     * Set avatar
     *
     * @param string $avatar
     * @return Aquarium
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar
     *
     * @return string 
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Set user
     *
     * @param \AppquariumBundle\Entity\User $user
     * @return Aquarium
     */
    public function setUser(\AppquariumBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppquariumBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }


}
