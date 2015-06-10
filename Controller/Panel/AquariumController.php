<?php

namespace AppquariumBundle\Controller\Panel;


use AppquariumBundle\Controller\CustomBaseController;
use SimpleBus\Message\Bus\MessageBus;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;
use Symfony\Component\HttpFoundation\JsonResponse;


class AquariumController extends CustomBaseController
{

    private $commandBus;

    public function __construct(MessageBus $commandBus, Container $container)
    {
        $this->commandBus = $commandBus;
        $this->container = $container;
    }


    public function aquariumDetailsAction($aquariumID)
    {

        $this->checkUser($aquariumID);
        $aquarium = $this->aquarium($aquariumID);
        $measures = $this->actualParamsLevel($aquariumID);
        $accessories = $this->aquariumAccessories($aquariumID);
        $inhabitants = $this->aquariumInhabitants($aquariumID);
        $totalSpending = $this->totalSpend($inhabitants, $accessories);
        $aquariumImages = $this->aquariumImages($aquariumID);

        return $this->render('dashboard/aquariumDetails.html.twig',
            array(
                'aquarium' => $aquarium,
                'parameters' => $measures,
                'inhabitants' => $inhabitants,
                'images' => $aquariumImages,
                'price' => $totalSpending,
                "accessories" => $accessories
            )
        );

    }

    public function deleteAquariumAction($aquariumId)
    {
        $this->checkUser($aquariumId);
        $this->removeAquarium($aquariumId);
        return new JsonResponse(array("result" => $aquariumId));

    }


    private function actualParamsLevel($aquariumID)
    {
        $measuresService = $this->get('measures_service');
        return $measuresService->LastAquariumMeasures($aquariumID);
    }

    private function removeAquarium($aquariumID)
    {
        $aquariumService = $this->get('aquarium_service');
        $aquarium = $this->aquarium($aquariumID);
        $aquariumService->delete($aquarium);
    }


    private function aquariumAccessories($aquariumID)
    {
        $accessoryService = $this->get('accessory_service');
        return $accessoryService->aquariumAccessories($aquariumID);
    }

    private function aquariumInhabitants($aquariumID)
    {
        $inhabitantService = $this->get('aquarium_inhabitant_service');
        return $inhabitantService->inhabitantsByAquarium($aquariumID);
    }

    private function aquariumImages($aquariumID)
    {
        $imageService = $this->get('aquarium_image_service');
        return $imageService->aquariumImages($aquariumID);
    }


    private function totalSpend($inhabitants, $accessories)
    {
        $totalSpending = 0;
        foreach ($inhabitants as $currentInhabitant) {
            $totalSpending += ($currentInhabitant->getPrice() * $currentInhabitant->getNumber());
        }

        foreach ($accessories as $currentAccessory) {
            $totalSpending += $currentAccessory->getPrice();
        }
        return $totalSpending;
    }


    private function aquarium($aquariumID)
    {
        $aquariumService = $this->get('aquarium_service');
        return $aquariumService->aquarium($aquariumID);
    }

}
