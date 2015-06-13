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
    private $newsletter;


    /**
     * Constructor
     */
    public function __construct()
    {
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
