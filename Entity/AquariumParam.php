<?php

namespace AppquariumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AquariumParam
 */
class AquariumParam
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
     * @var boolean
     */
    private $defaultParam;
    /**
     * @var string
     */
    private $solution_high;
    /**
     * @var string
     */
    private $solution_low;
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $aquariumInhabitant;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->aquariumInhabitant = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return AquariumParam
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
     * Set default
     *
     * @param boolean $default
     * @return AquariumParam
     */
    public function setDefaultParam($default)
    {
        $this->defaultParam = $default;

        return $this;
    }

    /**
     * Get default
     *
     * @return boolean
     */
    public function getDefaultParam()
    {
        return $this->defaultParam;
    }

    /**
     * Set solution_high
     *
     * @param string $solution_high
     * @return AquariumParam
     */
    public function setSolution_high($solution_high)
    {
        $this->solution_high = $solution_high;

        return $this;
    }

    /**
     * Set solution_low
     *
     * @param string $solution_low
     * @return AquariumParam
     */
    public function setSolution_low($solution_low)
    {
        $this->solution_low = $solution_low;

        return $this;
    }

    /**
     * Get solution_high
     *
     * @return string
     */
    public function getSolution_high()
    {
        return $this->solution_high;
    }

    /**
     * Get solution_low
     *
     * @return string
     */
    public function getSolution_low()
    {
        return $this->solution_low;
    }

    /**
     * Add aquariumInhabitant
     *
     * @param \AppquariumBundle\Entity\AquariumInhabitant $aquariumInhabitant
     * @return AquariumParam
     */


    public function addAquariumInhabitant(\AppquariumBundle\Entity\AquariumInhabitant $aquariumInhabitant)
    {
        $this->aquariumInhabitant[] = $aquariumInhabitant;

        return $this;
    }

    /**
     * Remove aquariumInhabitant
     *
     * @param \AppquariumBundle\Entity\AquariumInhabitant $aquariumInhabitant
     */
    public function removeAquariumInhabitant(\AppquariumBundle\Entity\AquariumInhabitant $aquariumInhabitant)
    {
        $this->aquariumInhabitant->removeElement($aquariumInhabitant);
    }

    /**
     * Get aquariumInhabitant
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAquariumInhabitant()
    {
        return $this->aquariumInhabitant;
    }
}
