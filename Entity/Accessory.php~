<?php

namespace AppquariumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Accessory
 */
class Accessory
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $price;

    /**
     * @var string
     */
    private $date;

    /**
     * @var \AppquariumBundle\Entity\Aquarium
     */
    private $aquarium;


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
     * Set name
     *
     * @param string $name
     * @return Accessory
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set price
     *
     * @param string $price
     * @return Accessory
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set date
     *
     * @param string $date
     * @return Accessory
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return string 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set aquarium
     *
     * @param \AppquariumBundle\Entity\Aquarium $aquarium
     * @return Accessory
     */
    public function setAquarium(\AppquariumBundle\Entity\Aquarium $aquarium = null)
    {
        $this->aquarium = $aquarium;

        return $this;
    }

    /**
     * Get aquarium
     *
     * @return \AppquariumBundle\Entity\Aquarium 
     */
    public function getAquarium()
    {
        return $this->aquarium;
    }
}
