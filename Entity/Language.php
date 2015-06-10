<?php

namespace AppquariumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Language
 */
class Language
{
    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $inhabitant;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $newsletter;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->inhabitant = new \Doctrine\Common\Collections\ArrayCollection();
        $this->newsletter = new \Doctrine\Common\Collections\ArrayCollection();

    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Language
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
     * Add inhabitant
     *
     * @param \AppquariumBundle\Entity\Inhabitant $inhabitant
     * @return Language
     */
    public function addInhabitant(\AppquariumBundle\Entity\Inhabitant $inhabitant)
    {
        $this->inhabitant[] = $inhabitant;

        return $this;
    }

    /**
     * Remove inhabitant
     *
     * @param \AppquariumBundle\Entity\Inhabitant $inhabitant
     */
    public function removeInhabitant(\AppquariumBundle\Entity\Inhabitant $inhabitant)
    {
        $this->inhabitant->removeElement($inhabitant);
    }

    /**
     * Get inhabitant
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInhabitant()
    {
        return $this->inhabitant;
    }

    /**
     * Add newsletter
     *
     * @param \AppquariumBundle\Entity\Newsletter $newsletter
     * @return Language
     */
    public function addNewsletter(\AppquariumBundle\Entity\Newsletter $newsletter)
    {
        $this->newsletter[] = $newsletter;

        return $this;
    }

    /**
     * Remove newsletter
     *
     * @param \AppquariumBundle\Entity\Newsletter $newsletter
     */
    public function removeNewsletter(\AppquariumBundle\Entity\Newsletter $newsletter)
    {
        $this->newsletter->removeElement($newsletter);
    }

    /**
     * Get newsletter
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNewsletter()
    {
        return $this->newsletter;
    }

}
