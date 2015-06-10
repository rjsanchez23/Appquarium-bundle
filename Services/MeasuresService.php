<?php
namespace AppquariumBundle\Services;

use AppquariumBundle\Aquarium\Repository\EntityRepositoryInterface;


class MeasuresService
{

    private $entityManager;

    public function __construct(EntityRepositoryInterface $entityManager)
    {

        $this->entityManager = $entityManager;

    }

    public function lastAquariumMeasures($aquariumId)
    {

        $measureRepository = $this->entityManager->repository("AppquariumBundle:WaterParamMeasure");
        return $measureRepository->AquariumParamsValues($aquariumId);

    }

    public function historyMeasures($paramId, $lastDays)
    {

        $measureRepository = $this->entityManager->repository("AppquariumBundle:WaterParamMeasure");
        return $measureRepository->historyMeasures($paramId, $lastDays);

    }

    public function historyMonthMeasures($paramId, $lastMonths)
    {
        $measureRepository = $this->entityManager->repository("AppquariumBundle:WaterParamMeasure");
        return $measureRepository->historyMonthMeasures($paramId, $lastMonths);

    }



}