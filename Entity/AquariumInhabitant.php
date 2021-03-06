<?php

namespace AppquariumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AquariumInhabitant
 */
class AquariumInhabitant
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $avatar = "tresojos.jpg";

    /**
     * @var string
     */
    private $alias;

    /**
     * @var integer
     */
    private $createdAt;

    /**
     * @var integer
     */
    private $updatedAt;

    /**
     * @var string
     */
    private $family;

    /**
     * @var string
     */
    private $scientificName;

    /**
     * @var string
     * @column(name="price", type="decimal", precision="2", options={"default" = 0.0})
     */
    private $price = 0.0;

    /**
     * @var string
     */
    private $foodType;

    /**
     * @var integer
     */
    private $feedTime;

    /**
     * @var \AppquariumBundle\Entity\Aquarium
     */
    private $aquarium;


    /**
     * @var integer
     */
    private $number;

    /**
     * @var string
     */
    private $description;


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
     * Set avatar
     *
     * @param string $avatar
     * @return AquariumInhabitant
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
     * Set alias
     *
     * @param string $alias
     * @return AquariumInhabitant
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
     * Set createdAt
     *
     * @param integer $createdAt
     * @return AquariumInhabitant
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
     * @return AquariumInhabitant
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
     * Set family
     *
     * @param string $family
     * @return AquariumInhabitant
     */
    public function setFamily($family)
    {
        $this->family = $family;

        return $this;
    }

    /**
     * Get family
     *
     * @return string 
     */
    public function getFamily()
    {
        return $this->family;
    }

    /**
     * Set scientificName
     *
     * @param string $scientificName
     * @return AquariumInhabitant
     */
    public function setScientificName($scientificName)
    {
        $this->scientificName = $scientificName;

        return $this;
    }

    /**
     * Get scientificName
     *
     * @return string 
     */
    public function getScientificName()
    {
        return $this->scientificName;
    }

    /**
     * Set price
     *
     * @param string $price
     * @return AquariumInhabitant
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
     * Set foodType
     *
     * @param string $foodType
     * @return AquariumInhabitant
     */
    public function setFoodType($foodType)
    {
        $this->foodType = $foodType;

        return $this;
    }

    /**
     * Get foodType
     *
     * @return string 
     */
    public function getFoodType()
    {
        return $this->foodType;
    }

    /**
     * Set feedTime
     *
     * @param integer $feedTime
     * @return AquariumInhabitant
     */
    public function setFeedTime($feedTime)
    {
        $this->feedTime = $feedTime;

        return $this;
    }

    /**
     * Get feedTime
     *
     * @return integer 
     */
    public function getFeedTime()
    {
        return $this->feedTime;
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
     * Set description
     * @param string $description
     * @return AquariumInhabitant
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }
    /**
     * Set aquarium
     *
     * @param \AppquariumBundle\Entity\Aquarium $aquarium
     * @return AquariumInhabitant
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


    /**
     * Set number
     *
     * @param integer $number
     * @return AquariumInhabitant
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return integer 
     */
    public function getNumber()
    {
        return $this->number;
    }

}
