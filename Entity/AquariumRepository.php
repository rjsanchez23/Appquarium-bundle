<?php


namespace AppquariumBundle\Entity;

use Doctrine\ORM\EntityRepository;
class AquariumRepository  extends EntityRepository
{

    public function findByUser($id)
    {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT a FROM AppquariumBundle:Aquarium a JOIN a.user u WHERE u.id = $id"
            )
            ->getResult();
    }


}