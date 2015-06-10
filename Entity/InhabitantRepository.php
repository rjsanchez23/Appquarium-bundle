<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 09/04/15
 * Time: 18:23
 */

namespace AppquariumBundle\Entity;


use Doctrine\ORM\EntityManager;

class InhabitantRepository extends EntityManager {

    public function findAll()
    {
        return $this->getEntityManager()->createQuery('SELECT * FROM AppquariumBunlde:Inhabitant')->getResult();

    }

}