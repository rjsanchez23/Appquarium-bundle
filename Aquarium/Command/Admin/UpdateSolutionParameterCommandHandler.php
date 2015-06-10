<?php namespace AppquariumBundle\Aquarium\Command\Admin;

use AppquariumBundle\Services\Admin\ParametersSolutionService,
    SimpleBus\Message\Handler\MessageHandler,
    SimpleBus\Message\Message;

class UpdateSolutionParameterCommandHandler implements MessageHandler{

    private $service;

    public function __construct(ParametersSolutionService $service)
    {
        $this->service = $service;
    }

    public function handle(Message $message)
    {
        $max_parameters_solution = $message->getMaxSolutionParameters();
        $min_parameters_solution = $message->getMinSolutionParameters();
        $this->service->updateMaxSolutionParameters($max_parameters_solution);
        $this->service->updateMinSolutionParameters($min_parameters_solution);
    }

} 