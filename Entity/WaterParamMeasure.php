<?php

namespace AppquariumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WaterParamMeasure
 */
class WaterParamMeasure
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $value;

    /**
     * @var integer
     */
    private $date;

    /**
     * @var \AppquariumBundle\Entity\paramValueRange
     */
    private $paramValueRange;


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
     * Set value
     *
     * @param string $value
     * @return WaterParamMeasure
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set date
     *
     * @param integer $date
     * @return WaterParamMeasure
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return integer 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set paramValueRange
     *
     * @param \AppquariumBundle\Entity\ParamValueRange $paramValueRange
     * @return WaterParamMeasure
     */
    public function setParamValueRange(\AppquariumBundle\Entity\ParamValueRange $paramValueRange = null)
    {
        $this->paramValueRange = $paramValueRange;

        return $this;
    }

    /**
     * Get paramValueRange
     *
     * @return \AppquariumBundle\Entity\Aquarium 
     */
    public function getParamValueRange()
    {
        return $this->paramValueRange;
    }

}
