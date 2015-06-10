<?php


namespace AppquariumBundle\Services;


use AppquariumBundle\Aquarium\Repository\EntityRepositoryInterface;


class PredefinedInhabitantsService {

    private $predefinedInhabitantsRepository;

    public function __construct(EntityRepositoryInterface $entityManager){

        $this->predefinedInhabitantsRepository = $entityManager->repository('AppquariumBundle:Inhabitant');
    }

    public function inhabitants(){
        $inhabitants = $this->predefinedInhabitantsRepository->findAll();
        return $inhabitants;
    }
}