<?php
namespace AppquariumBundle\Services;

use AppquariumBundle\Aquarium\Repository\EntityRepositoryInterface;
use AppquariumBundle\Entity\Aquarium;


class AquariumService {

    private $entityManager;

    public function __construct(EntityRepositoryInterface $entityManager){

        $this->entityManager = $entityManager;

    }


    public function aquariums($userId){

        return $this->entityManager->repository("AppquariumBundle:Aquarium")->findByUser($userId);

    }

    public function delete(Aquarium $aquarium){

        $this->entityManager->remove($aquarium);

    }


    public function aquarium($id){

        return $this->entityManager->repository("AppquariumBundle:Aquarium")->find($id);

    }




}