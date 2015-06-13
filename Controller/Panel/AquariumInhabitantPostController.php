<?php

namespace AppquariumBundle\Controller\Panel;

use AppquariumBundle\Aquarium\Command\PostAquariumInhabitantCommand;
use AppquariumBundle\Aquarium\Command\PostInhabitantLogCommand;
use AppquariumBundle\Aquarium\ValueObjects\Decimal;
use AppquariumBundle\Aquarium\ValueObjects\Description;
use AppquariumBundle\Aquarium\ValueObjects\Family;
use AppquariumBundle\Aquarium\ValueObjects\Integer;
use AppquariumBundle\Aquarium\ValueObjects\Name;
use AppquariumBundle\Aquarium\ValueObjects\String;
use AppquariumBundle\Controller\AvatarTrait;
use AppquariumBundle\Controller\CustomBaseController;
use SimpleBus\Message\Bus\MessageBus;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class AquariumInhabitantPostController extends CustomBaseController
{
    use AvatarTrait;

    private $commandBus;


    public function __construct(MessageBus $commandBus, Container $container)
    {
        $this->commandBus = $commandBus;
        $this->container = $container;

    }


    public function newCustomInhabitantFormAction()
    {

        return $this->render("dashboard/newAquariumInhabitantForm.html.twig");
    }


    public function newBlogPostStoreAction(Request $request, $inhabitantId)
    {
        $comment = json_decode($request->getContent());

        $command = new PostInhabitantLogCommand($comment->comment, $inhabitantId);
        $this->commandBus->handle($command);
        return new Response(json_encode(array(
            "comment" => $command->response->getComment(),
            "date" => $command->response->getCreatedAt(),
            "id" => $command->response->getId()
        )));
    }


    public function storeAction(Request $request, $idAquarium)
    {

        $this->checkUser($idAquarium);

        $aquariumInhabitantId = $this->storeInhabitant($request, $idAquarium);
        return $this->redirect("/inhabitant/profile/" . $aquariumInhabitantId);
    }

    public function editAction(Request $request, $idInhabitant)
    {
        $idInhabitant = filter_var($idInhabitant, FILTER_SANITIZE_NUMBER_INT);
        $aquariumInhabitantId = $this->storeInhabitant($request, null, $idInhabitant );
        return $this->redirect("/inhabitant/profile/" . $aquariumInhabitantId);
    }




    private function storeInhabitant(Request $request, $idAquarium = null, $idInhabitant = null)
    {

        $inhabitantData = [];

        $avatarData = $this->avatarToArray($request, "avatar");



        $inhabitantData["id"] = $idInhabitant;
        $inhabitantData["alias"] = (new String(strip_tags($request->request->get("alias"))))->value();
        $inhabitantData["scientificName"] = strip_tags($request->request->get("scientificName"));
        $inhabitantData["family"] = (new Family(strip_tags($request->request->get("family"))))->value();
        $inhabitantData["price"] = (new Decimal(strip_tags($request->request->get("price"))))->value();
        $inhabitantData["feedTime"] = (new Integer(strip_tags($request->request->get("feedTime"))))->value();
        $inhabitantData["foodType"] = strip_tags($request->request->get("foodType"));
        $inhabitantData["number"] = (new Integer(strip_tags($request->request->get("number"))))->value();
        $inhabitantData["description"] = strip_tags($request->request->get("description"));
        $inhabitantData["aquariumId"] = $idAquarium;

        $command = new PostAquariumInhabitantCommand($inhabitantData, $avatarData);
        $this->commandBus->handle($command);
        return $command->inhabitantId;


    }


}
