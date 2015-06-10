<?php

namespace AppquariumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ParamValueRange
 */
class ParamValueRange
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $maxValue;

    /**
     * @var string
     */
    private $minValue;

    /**
     * @var \AppquariumBundle\Entity\Aquarium
     */
    private $aquarium;

    /**
     * @var \AppquariumBundle\Entity\AquariumParam
     */
    private $param;


    /**
     * Set id
     *
     * @param integer $id
     * @return ParamValueRange
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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
     * Set maxValue
     *
     * @param string $maxValue
     * @return ParamValueRange
     */
    public function setMaxValue($maxValue)
    {
        $this->maxValue = $maxValue;

        return $this;
    }

    /**
     * Get maxValue
     *
     * @return string 
     */
    public function getMaxValue()
    {
        return $this->maxValue;
    }

    /**
     * Set minValue
     *
     * @param string $minValue
     * @return ParamValueRange
     */
    public function setMinValue($minValue)
    {
        $this->minValue = $minValue;

        return $this;
    }

    /**
     * Get minValue
     *
     * @return string 
     */
    public function getMinValue()
    {
        return $this->minValue;
    }

    /**
     * Set aquarium
     *
     * @param \AppquariumBundle\Entity\Aquarium $aquarium
     * @return ParamValueRange
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
     * Set param
     *
     * @param \AppquariumBundle\Entity\AquariumParam $param
     * @return ParamValueRange
     */
    public function setParam(\AppquariumBundle\Entity\AquariumParam $param = null)
    {
        $this->param = $param;

        return $this;
    }

    /**
     * Get param
     *
     * @return \AppquariumBundle\Entity\AquariumParam 
     */
    public function getParam()
    {
        return $this->param;
    }
}
