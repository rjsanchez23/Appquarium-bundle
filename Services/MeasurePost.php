<?php

namespace AppquariumBundle\Services;


use AppquariumBundle\Aquarium\Repository\EntityRepositoryInterface;


use AppquariumBundle\Entity\WaterParamMeasure;
use Doctrine\Common\Util\Debug;


class MeasurePost
{


    private $measure;
    private $entityManager;

    public function __construct(EntityRepositoryInterface $entityManager, WaterParamMeasure $measure)
    {

        $this->measure = $measure;
        $this->entityManager = $entityManager;
    }

    public function store(Array $measures, $measuresDate, $aquariumId)
    {
        $aquarium = $this->aquarium($aquariumId);

        $response = [];
        foreach ($measures as $currentMeasure => $measureValue) {
            if(empty($measureValue)){
                continue;
            }
            $parameter = $this->paramValueRange($this->parameter($currentMeasure), $aquarium);

            $measuresDate = str_replace("/", "-", $measuresDate);
            $measure = clone $this->measure;
            $measure->setValue($measureValue);
            $measure->setDate(strtotime($measuresDate) + (strtotime(date("Y-m-d H:i:s"))-strtotime(date("Y-m-d"))));
            $measure->setParamValueRange($parameter);
            $this->entityManager->save($measure);


        }

    }

    private function paramValueRange($parameter, $aquarium)
    {

        $parameterRepository = $this->entityManager->repository("AppquariumBundle:ParamValueRange");

        return $parameterRepository->findOneBy(array(
            'aquarium' => $aquarium,
            'param'    => $parameter

        ));
    }

    private function aquarium($aquariumId)
    {

        $aquariumRepository = $this->entityManager->repository("AppquariumBundle:Aquarium");
        return $aquariumRepository->find($aquariumId);
    }

    private function parameter($parameterName)
    {

        $parameterRepository = $this->entityManager->repository("AppquariumBundle:AquariumParam");

        return $parameterRepository->findOneBy(array(
            'name' => $parameterName
        ));
    }




}