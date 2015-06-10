<?php

namespace AppquariumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InhabitantLog
 */
class InhabitantLog
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
     * @var string
     */
    private $comment;

    /**
     * @var \AppquariumBundle\Entity\AquariumInhabitant
     */
    private $aquariumInhabitant;


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
     * @return InhabitantLog
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
     * Set comment
     *
     * @param string $comment
     * @return InhabitantLog
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set aquariumInhabitant
     *
     * @param \AppquariumBundle\Entity\AquariumInhabitant $aquariumInhabitant
     * @return InhabitantLog
     */
    public function setAquariumInhabitant(\AppquariumBundle\Entity\AquariumInhabitant $aquariumInhabitant = null)
    {
        $this->aquariumInhabitant = $aquariumInhabitant;

        return $this;
    }

    /**
     * Get aquariumInhabitant
     *
     * @return \AppquariumBundle\Entity\AquariumInhabitant 
     */
    public function getAquariumInhabitant()
    {
        return $this->aquariumInhabitant;
    }
}
