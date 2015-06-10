<?php

namespace AppquariumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AquariumMaintenance
 */
class AquariumMaintenance
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $maintenanceDate;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $comment;

    /**
     * @var boolean
     */
    private $done = 0;

    /**
     * @var boolean
     */
    private $periodicMaintenance = 0;

    /**
     * @var integer
     */
    private $period;

    /**
     * @var integer
     */
    private $createdAt;

    /**
     * @var integer
     */
    private $updatedAt;

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
     * Set maintenanceDate
     *
     * @param integer $maintenanceDate
     * @return AquariumMaintenance
     */
    public function setMaintenanceDate($maintenanceDate)
    {
        $this->maintenanceDate = $maintenanceDate;

        return $this;
    }

    /**
     * Get maintenanceDate
     *
     * @return integer 
     */
    public function getMaintenanceDate()
    {
        return $this->maintenanceDate;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return AquariumMaintenance
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
     * Set comment
     *
     * @param string $comment
     * @return AquariumMaintenance
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
     * Set done
     *
     * @param boolean $done
     * @return AquariumMaintenance
     */
    public function setDone($done)
    {
        $this->done = $done;

        return $this;
    }

    /**
     * Get done
     *
     * @return boolean 
     */
    public function getDone()
    {
        return $this->done;
    }

    /**
     * Set periodicMaintenance
     *
     * @param boolean $periodicMaintenance
     * @return AquariumMaintenance
     */
    public function setPeriodicMaintenance($periodicMaintenance)
    {
        $this->periodicMaintenance = $periodicMaintenance;

        return $this;
    }

    /**
     * Get periodicMaintenance
     *
     * @return boolean 
     */
    public function getPeriodicMaintenance()
    {
        return $this->periodicMaintenance;
    }

    /**
     * Set period
     *
     * @param integer $period
     * @return AquariumMaintenance
     */
    public function setPeriod($period)
    {
        $this->period = $period;

        return $this;
    }

    /**
     * Get period
     *
     * @return integer 
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * Set createdAt
     *
     * @param integer $createdAt
     * @return AquariumMaintenance
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
     * Set updatedAt
     *
     * @param integer $updatedAt
     * @return AquariumMaintenance
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return integer 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set aquarium
     *
     * @param \AppquariumBundle\Entity\Aquarium $aquarium
     * @return AquariumMaintenance
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
