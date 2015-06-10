<?php
namespace AppquariumBundle\Services;

use AppquariumBundle\Aquarium\Repository\EntityRepositoryInterface;
use AppquariumBundle\Entity\Accessory;


class AccessoryService {

    private $entityManager;

    public function __construct(EntityRepositoryInterface $entityManager){

        $this->entityManager = $entityManager;

    }

    public function aquariumAccessories($aquariumId){
        $aquarium = $this->aquarium($aquariumId);
        return $this->entityManager->repository("AppquariumBundle:Accessory")
        ->findBy(
            array(
            "aquarium" => $aquarium
            )
        );

    }

    public function remove(Accessory $accessory){

        $this->entityManager->remove($accessory);

    }
    public function accessory($accessoryId){

        return$this->entityManager->repository("AppquariumBundle:Accessory")->find($accessoryId);

    }
    private function aquarium($aquariumId){

        return$this->entityManager->repository("AppquariumBundle:Aquarium")->find($aquariumId);

    }






}