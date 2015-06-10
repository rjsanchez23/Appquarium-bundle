<?php

namespace AppquariumBundle\Controller\Panel;

use AppquariumBundle\Controller\CustomBaseController;
use SimpleBus\Message\Bus\MessageBus;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;
use Symfony\Component\HttpFoundation\JsonResponse;


class AquariumInhabitantController extends CustomBaseController {


    private $commandBus;

    public function __construct(MessageBus $commandBus, Container $container )
    {

        $this->commandBus =  $commandBus;
        $this->container = $container;
    }


    public function showInhabitantFileAction($inhabitantId){


        $inhabitantId = filter_var($inhabitantId, FILTER_SANITIZE_NUMBER_INT);

        $logService = $this->get('inhabitant_log_service');
        $inhabitantService = $this->get('aquarium_inhabitant_service');
        $inhabitant = $inhabitantService->inhabitantDetails($inhabitantId);
        $this->checkUser($inhabitant->getAquarium()->getId());
        $inhabitantLogs = $logService->logs($inhabitant);
        $inhabitant->setCreatedAt(date("d/m/Y",$inhabitant->getCreatedAt()));

        return $this->render("dashboard/inhabitantFile.html.twig", array('inhabitant' => $inhabitant, "logs" => $inhabitantLogs));

    }

    public function newAquariumInhabitantFormAction($idAquarium)
    {
        $idAquarium = filter_var($idAquarium, FILTER_SANITIZE_NUMBER_INT);
        $this->checkUser($idAquarium);

        $aquariumService = $this->get('aquarium_service');
        $aquarium = $aquariumService->aquarium($idAquarium);

        return $this->render('dashboard/newAquariumInhabitantForm.html.twig', array('aquarium' => $aquarium));
    }

    public function editInhabitantFormAction($inhabitantId)
    {
        $inhabitantId = filter_var($inhabitantId, FILTER_SANITIZE_NUMBER_INT);

        $inhabitantService = $this->get('aquarium_inhabitant_service');
        $inhabitant = $inhabitantService->inhabitantDetails($inhabitantId);
        $this->checkUser($inhabitant->getAquarium()->getId());


        return $this->render('dashboard/editInhabitantForm.html.twig', array('inhabitant' => $inhabitant));



    }

    public function deleteBlogPostAction($blogPostId)
    {
        $blogPostId = filter_var($blogPostId, FILTER_SANITIZE_NUMBER_INT);
        $logService = $this->get('inhabitant_log_service');
        $post = $logService->postDetails($blogPostId);
        $this->checkUser($post->getAquariumInhabitant()->getAquarium()->getId());
        $logService->remove($post);
        return new JsonResponse($post);

    }

    public function deleteAction($idInhabitant)
    {
        $idInhabitant = filter_var($idInhabitant, FILTER_SANITIZE_NUMBER_INT);
        $inhabitantArray = $this->deleteInhabitant($idInhabitant);
        return $this->redirect("/aquarium/profile/".$inhabitantArray["idAquarium"]);

    }


    public function deleteFromListAction($idInhabitant)
    {

        $inhabitant = $this->deleteInhabitant($idInhabitant);
        return new JsonResponse($inhabitant);
    }

    private function deleteInhabitant($idInhabitant)
    {
        $inhabitantService = $this->get('aquarium_inhabitant_service');
        $inhabitant = $inhabitantService->inhabitantDetails($idInhabitant);
        $this->checkUser($inhabitant->getAquarium()->getId());
        $result = array("alias" => $inhabitant->getAlias(), "id" => $inhabitant->getId(), "idAquarium" => $inhabitant->getAquarium()->getId());
        $inhabitantService->remove($inhabitant);
        return $result;


    }


}
