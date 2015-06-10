<?php

namespace AppquariumBundle\Services;


use AppquariumBundle\Aquarium\Repository\EntityRepositoryInterface;
use AppquariumBundle\Entity\AquariumParam;
use AppquariumBundle\Entity\ParamValueRange;



class ParameterPost
{


    private $parameter;
    private $entityManager;
    private $param;

    public function __construct(EntityRepositoryInterface $entityManager, ParamValueRange $paramValue, AquariumParam $param)
    {
        $this->entityManager = $entityManager;
        $this->parameter = $paramValue;
        $this->param = $param;

    }

    public function store($aquariumId, Array $parameterData)
    {
        $parametersSaved = $this->persistParametersRange($parameterData, $aquariumId);
        $aquariumParameters = $this->paramAquarium($this->aquarium($aquariumId));


        $parametersToDelete = array_udiff($aquariumParameters, $parametersSaved,
            function ($obj_a, $obj_b) {
                return $obj_a->getId() - $obj_b->getId();
            }
        );
        $this->removeAquariumParamsRange($parametersToDelete);


    }

    /**
     * Returns array of paramenterRangeValue Entities
     */
    private function persistParametersRange($parameterData, $aquariumId){
        $parametersToSave = [];
        foreach ($parameterData as $parameterName => $values) {

            $parameterRange = $this->paramRange($this->aquarium($aquariumId),$this->paramByName($parameterName) );

            $parameterRange->setMaxValue($values["max"]);
            $parameterRange->setMinValue($values["min"]);

            $this->entityManager->save($parameterRange);
            $parametersToSave[] = $parameterRange;


        }
        return $parametersToSave;
    }

    private function paramAquarium($aquarium)
    {
        $parameterRepository = $this->entityManager->repository("AppquariumBundle:ParamValueRange");
        $parameterRange = $parameterRepository->findBy(array(
            'aquarium' => $aquarium
        ));

        return $parameterRange;
    }
    private function paramRange($aquarium, $parameter)
    {
        $parameterRepository = $this->entityManager->repository("AppquariumBundle:ParamValueRange");
        $parameterRange = $parameterRepository->findOneBy(array(
            'aquarium' => $aquarium,
            'param' => $parameter
        ));
        if(is_null($parameterRange)){
            $parameterRange = new ParamValueRange();
            $parameterRange->setAquarium($aquarium);
            $parameterRange->setParam($parameter);

        }
        return $parameterRange;
    }

    private function paramByName($name)
    {
        $parameterRepository = $this->entityManager->repository("AppquariumBundle:AquariumParam");
        $param = $parameterRepository->findOneBy(array(
            'name' => $name
        ));

        if(is_null($param)){
            $param = $this->storeParam($name);
        }

        return $param;
    }

    private function storeParam($name)
    {
        $param = clone $this->param;
        $param->setName($name);
        $this->entityManager->save($param);

        return $param;
    }

    private function aquarium($id)
    {
        $aquariumRepository = $this->entityManager->repository("AppquariumBundle:Aquarium");
        return $aquariumRepository->find($id);
    }

    private function removeAquariumParamsRange(array $parameters)
    {

        foreach($parameters as $currentParam){
            $this->entityManager->remove($currentParam);
        }
    }

}