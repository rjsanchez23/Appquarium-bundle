<?php namespace AppquariumBundle\Services\Admin;

use Doctrine\ORM\EntityManager;

class ParametersSolutionService {

    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    private function getSolutionParameterByName($name)
    {
        $parametersSolutionRepository = $this->entityManager->getRepository("AppquariumBundle:AquariumParam");
        return $parametersSolutionRepository->findOneBy( ['name' => $name] );
    }

    public function updateMaxSolutionParameters(array $parameters)
    {
        foreach($parameters as $name => $value)
        {
            $parameter = $this->getSolutionParameterByName($name);

            if($parameter->getSolution_high() == $value)
            {
                continue;
            }

            $parameter->setSolution_high($value);
            $this->entityManager->flush();
            $this->entityManager->clear();
        }

    }

    public function updateMinSolutionParameters(array $parameters)
    {
        foreach($parameters as $name => $value)
        {
            $parameter = $this->getSolutionParameterByName($name);

            if($parameter->getSolution_low() == $value)
            {
                continue;
            }

            $parameter->setSolution_low($value);
            $this->entityManager->flush();
            $this->entityManager->clear();
        }
    }

} 