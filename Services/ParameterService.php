<?php
namespace AppquariumBundle\Services;

use AppquariumBundle\Aquarium\Repository\EntityRepositoryInterface;



class ParameterService {

    private $parameterRepository;

    public function __construct(EntityRepositoryInterface $entityManager){

        $this->parameterRepository = $entityManager->repository("AppquariumBundle:AquariumParam");

    }

    public function aquariumParameters($aquariumId){

        return $this->parameterRepository->AquariumParams($aquariumId);

    }

    public function defaultParams($aquariumId){

        return $this->parameterRepository->defaultParams($aquariumId);

    }






}