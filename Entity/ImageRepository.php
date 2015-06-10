<?php


namespace AppquariumBundle\Entity;

use Doctrine\ORM\EntityRepository;
class ImageRepository  extends EntityRepository
{



    public function aquariumImages($aquariumId)
    {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT i FROM AppquariumBundle:Image i JOIN i.aquarium a WHERE a.id = $aquariumId"
            )
            ->getResult();
    }

}