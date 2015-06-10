<?php


namespace AppquariumBundle\Entity;

use Doctrine\ORM\EntityRepository;
class AquariumParamRepository  extends EntityRepository
{

    public function findByName($name)
    {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT a FROM AppquariumBundle:AquariumParam a WHERE a.name = '".$name."'"
            )
            ->getSingleResult();
    }

    public function AquariumParams($aquariumId)
    {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT a, p FROM AppquariumBundle:ParamValueRange a JOIN a.aquarium u JOIN a.param p WHERE u.id = $aquariumId"
            )
            ->getResult();
    }

    public function defaultParams()
    {

        $sql = "SELECT name FROM aquarium_param where defaultParam = 1";
        $stmt = $this->getEntityManager()->getConnection()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();


    }

}