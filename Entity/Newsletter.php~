<?php

namespace AppquariumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Newsletter
 */
class Newsletter
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $createdAt;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $languageCode;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->languageCode = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set createdAt
     *
     * @param integer $createdAt
     * @return Newsletter
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return integer 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Add languageCode
     *
     * @param \AppquariumBundle\Entity\Language $languageCode
     * @return Newsletter
     */
    public function addLanguageCode(\AppquariumBundle\Entity\Language $languageCode)
    {
        $this->languageCode[] = $languageCode;

        return $this;
    }

    /**
     * Remove languageCode
     *
     * @param \AppquariumBundle\Entity\Language $languageCode
     */
    public function removeLanguageCode(\AppquariumBundle\Entity\Language $languageCode)
    {
        $this->languageCode->removeElement($languageCode);
    }

    /**
     * Get languageCode
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLanguageCode()
    {
        return $this->languageCode;
    }
}
