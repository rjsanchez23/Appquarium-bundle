<?php


namespace AppquariumBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

abstract class CustomBaseController extends Controller
{
    public function checkUser($aquariumId)
    {
        $aquariumId = filter_var($aquariumId, FILTER_SANITIZE_NUMBER_INT);
        $aquariumService = $this->get('aquarium_service');
        $aquarium = $aquariumService->aquarium($aquariumId);

        if (is_null($aquarium) || ($aquarium->getUser()->getId() != $this->getUser()->getId())) {
            throw $this->createNotFoundException('The Aquarium does not exist');
        }
    }
}