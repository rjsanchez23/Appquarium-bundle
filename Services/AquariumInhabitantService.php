<?php

namespace AppquariumBundle\Services;

use AppquariumBundle\Aquarium\Repository\EntityRepositoryInterface;


class AquariumInhabitantService
{

    private $entityManager;

    public function __construct(EntityRepositoryInterface $entityManager)
    {

        $this->entityManager = $entityManager;

    }

    public function inhabitants()
    {
        $inhabitants = $this->entityManager->repository("AppquariumBundle:AquariumInhabitant")->findAll();
        return $inhabitants;
    }

    public function inhabitantsByAquarium($aquariumId)
    {
        $inhabitants = $this->entityManager->repository("AppquariumBundle:AquariumInhabitant")->findByAquarium($aquariumId);
        return $inhabitants;
    }

    public function inhabitantDetails($inhabitantId)
    {
        $inhabitant = $this->entityManager->repository("AppquariumBundle:AquariumInhabitant")->find($inhabitantId);
        return $inhabitant;
    }


    public function remove($inhabitant)
    {

        $this->entityManager->remove($inhabitant);

    }


}