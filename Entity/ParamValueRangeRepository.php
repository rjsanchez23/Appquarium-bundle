<?php


namespace AppquariumBundle\Entity;

use Doctrine\ORM\EntityRepository;
class ParamValueRangeRepository  extends EntityRepository
{


    public function AquariumParamsValues($aquariumId)
    {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT a, p FROM AppquariumBundle:ParamValueRange a JOIN a.aquarium u JOIN a.param p WHERE u.id = $aquariumId"
            )
            ->getResult();
    }

}