<?php

namespace AppquariumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reminder
 */
class Reminder
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
    private $description;

    /**
     * @var integer
     */
    private $createdAt;

    /**
     * @var integer
     */
    private $reminderDate;

    /**
     * @var \AppquariumBundle\Entity\AquariumMaintenance
     */
    private $aquariumMaintenance;


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
     * @return Reminder
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
     * Set description
     *
     * @param string $description
     * @return Reminder
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
     * Set createdAt
     *
     * @param integer $createdAt
     * @return Reminder
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
     * Set reminderDate
     *
     * @param integer $reminderDate
     * @return Reminder
     */
    public function setReminderDate($reminderDate)
    {
        $this->reminderDate = $reminderDate;

        return $this;
    }

    /**
     * Get reminderDate
     *
     * @return integer 
     */
    public function getReminderDate()
    {
        return $this->reminderDate;
    }

    /**
     * Set aquariumMaintenance
     *
     * @param \AppquariumBundle\Entity\AquariumMaintenance $aquariumMaintenance
     * @return Reminder
     */
    public function setAquariumMaintenance(\AppquariumBundle\Entity\AquariumMaintenance $aquariumMaintenance = null)
    {
        $this->aquariumMaintenance = $aquariumMaintenance;

        return $this;
    }

    /**
     * Get aquariumMaintenance
     *
     * @return \AppquariumBundle\Entity\AquariumMaintenance 
     */
    public function getAquariumMaintenance()
    {
        return $this->aquariumMaintenance;
    }
}
