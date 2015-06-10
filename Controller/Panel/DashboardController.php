<?php

namespace AppquariumBundle\Controller\Panel;

use AppquariumBundle\Controller\CustomBaseController;
use SimpleBus\Message\Bus\MessageBus;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;


class DashboardController extends CustomBaseController
{

    private $commandBus;

    public function __construct(MessageBus $commandBus, Container $container)
    {
        $this->commandBus = $commandBus;
        $this->container = $container;
    }


    public function dashboardAction()
    {

        $aquariums = $this->userAquariums($this->getUser()->getId());
        $userAquariumsInfo = $this->userDashboardAquariums($aquariums);

        return $this->render('dashboard/aquariumsPanel.html.twig', array('aquariumsPanel' => $userAquariumsInfo));

    }


    private function userDashboardAquariums($userAquariums)
    {
        $aquariums = array();

        foreach ($userAquariums as $currentAquarium) {
            $aquariumID = $currentAquarium->getId();
            $inhabitants = $this->aquariumInhabitants($aquariumID);
            $measures = $this->ActualParamsLevel($aquariumID);

            $aquariums[] = array(
                "aquario" => $currentAquarium,
                "inhabitants" => $inhabitants,
                "measures" => $measures
            );
        }

        return $aquariums;
    }

    private function userAquariums($userID)
    {
        $aquariumService = $this->get('aquarium_service');
        return $aquariumService->aquariums($userID);
    }

    private function aquariumInhabitants($aquariumID)
    {
        $inhabitantService = $this->get('aquarium_inhabitant_service');
        return $inhabitantService->inhabitantsByAquarium($aquariumID);
    }

    private function ActualParamsLevel($aquariumID)
    {
        $measuresService = $this->get('measures_service');
        return $measuresService->LastAquariumMeasures($aquariumID);
    }


}
