<?php

namespace AppquariumBundle\Controller\Panel;


use AppquariumBundle\Aquarium\Command\PostAquariumCommand;
use AppquariumBundle\Aquarium\Command\PostParametersCommand;
use AppquariumBundle\Aquarium\ValueObjects\Decimal;
use AppquariumBundle\Aquarium\ValueObjects\Description;
use AppquariumBundle\Aquarium\ValueObjects\Integer;
use AppquariumBundle\Aquarium\ValueObjects\String;
use AppquariumBundle\Aquarium\ValueObjects\WaterType;
use AppquariumBundle\Controller\AvatarTrait;
use AppquariumBundle\Controller\CustomBaseController;
use SimpleBus\Message\Bus\MessageBus;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;
use Symfony\Component\HttpFoundation\Request;


class AquariumPostController extends CustomBaseController
{
    use AvatarTrait;
    private $commandBus;

    public function __construct(MessageBus $commandBus, Container $container)
    {
        $this->commandBus = $commandBus;
        $this->container = $container;
    }


    public function newAquariumFormAction()
    {
        return $this->render('dashboard/newAquariumForm.html.twig');
    }


    public function editAquariumFormAction($aquariumId)
    {
        $this->checkUser($aquariumId);
        $aquariumService = $this->get('aquarium_service');
        $aquarium = $aquariumService->aquarium($aquariumId);

        $parameterService = $this->get('parameter_service');
        $parameters = $parameterService->aquariumParameters($aquariumId);

        return $this->render('dashboard/editAquariumForm.html.twig', array('aquarium' => $aquarium, 'parameters' => $parameters));

    }

    public function storeAction(Request $request)
    {
        return $this->handlePostAquarium($request);

    }

    public function editAction($aquariumId, Request $request)
    {
        $this->checkUser($aquariumId);
        return $this->handlePostAquarium($request, $aquariumId);

    }

    private function handlePostAquarium(Request $request, $aquariumId = null)
    {


        $aquariumData = $this->aquariumDataForm($request);
        $parameterData = $this->parameterDataForm($request);
        $avatarData = $this->avatarToArray($request, "avatar");

        $newAquariumId = $this->postAquarium($aquariumData, $avatarData, $this->getUser()->getId(), $aquariumId);
        $this->postParameter($newAquariumId, $parameterData);
        return $this->redirect("/aquarium/profile/" . $newAquariumId);
    }

    private function postAquarium($aquariumData, $avatarData, $userId, $aquariumId)
    {
        $command = new PostAquariumCommand($aquariumData, $avatarData, $this->getUser()->getId(), $aquariumId);
        $this->commandBus->handle($command);
        return $command->id;
    }

    private function postParameter($newAquariumId, $parameterData)
    {
        $command = new PostParametersCommand($newAquariumId, $parameterData);
        $this->commandBus->handle($command);
    }

    private function aquariumDataForm(Request $request)
    {

        $aquariumData = [];
        $aquariumData ["alias"] = (new String(strip_tags($request->request->get("alias"))))->value();
        $aquariumData ["capacity"] = (new Integer($request->request->get("capacity")))->value();
        $aquariumData ["water"] = (new WaterType(strip_tags($request->request->get("water"))))->value();
        $aquariumData ["description"] = (strip_tags($request->request->get("description")));

        return $aquariumData;
    }

    private function parameterDataForm(Request $request)
    {

        $form = $request->request->all();

        $parameterData = [];
        if (isset($form["parameters"])) {
            foreach ($form["parameters"] as $parameter) {
                $parameterData[$parameter]["max"] = (new Decimal($request->request->get(str_replace(' ', '_', $parameter) . "_max")))->value();
                $parameterData[$parameter]["min"] = (new Decimal($request->request->get(str_replace(' ', '_', $parameter) . "_min")))->value();
            }
        }
        return $parameterData;
    }

}
