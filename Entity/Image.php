<?php

namespace AppquariumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Image
 */
class Image
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
     * @return Image
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
     * Set aquarium
     *
     * @param \AppquariumBundle\Entity\Aquarium $aquarium
     * @return Image
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
