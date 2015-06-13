<?php

namespace AppquariumBundle\Controller\Panel;


use AppquariumBundle\Aquarium\Command\PostAccessoryCommand;
use AppquariumBundle\Aquarium\ValueObjects\Decimal;
use AppquariumBundle\Aquarium\ValueObjects\Name;
use AppquariumBundle\Aquarium\ValueObjects\String;
use AppquariumBundle\Controller\CustomBaseController;
use SimpleBus\Message\Bus\MessageBus;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


class AccessoryController extends CustomBaseController
{

    private $commandBus;

    public function __construct(MessageBus $commandBus, Container $container )
    {
        $this->commandBus = $commandBus;
        $this->container = $container;
    }

    public function storeAction(Request $request, $idAquarium)
    {
        $this->checkUser($idAquarium);
        $this->storeAccessory($request, $idAquarium);
        return $this->redirect("/aquarium/profile/" . $idAquarium);
    }

    private function storeAccessory(Request $request, $idAquarium)
    {

        $accessoryData = $this->accessoryData($request);
        $command = new PostAccessoryCommand($accessoryData, $idAquarium);
        $this->commandBus->handle($command);
        return $command->aquariumId;


    }

    private function accessoryData(Request $request){
        $accessoryData = [];
        $accessoryData["name"] = (new String($request->request->get("name")))->value();
        $accessoryData["date"] = $request->request->get("date");
        $accessoryData["price"] = (new Decimal($request->request->get("price")))->value();

        return $accessoryData;
    }

    public function deleteAccessory($idAccessory)
    {

        $idAccessory = filter_var($idAccessory, FILTER_SANITIZE_NUMBER_INT);
        $accessoryService = $this->get('accessory_service');
        $accessory = $accessoryService->accessory($idAccessory);
        $this->checkUser($accessory->getAquarium()->getId());
        $result = array("id" => $accessory->getId());

        $accessoryService->remove($accessory);
        return new JsonResponse($result);

    }

}
