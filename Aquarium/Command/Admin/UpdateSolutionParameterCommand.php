<?php namespace AppquariumBundle\Aquarium\Command\Admin;

use SimpleBus\Message\Type\Command;

class UpdateSolutionParameterCommand implements Command {

    private $max_solution_parameters_url;
    private $min_solution_parameters_url;

    public function __construct(array $max, array $min)
    {
        $this->max_solution_parameters_url = $max;
        $this->min_solution_parameters_url = $min;
    }

    public function getMaxSolutionParameters()
    {
        return $this->max_solution_parameters_url;
    }

    public function getMinSolutionParameters()
    {
        return $this->min_solution_parameters_url;
    }
} 