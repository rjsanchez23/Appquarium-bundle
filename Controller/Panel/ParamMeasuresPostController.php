<?php

namespace AppquariumBundle\Controller\Panel;


use AppquariumBundle\Aquarium\Command\PostMeasuresCommand;
use AppquariumBundle\Aquarium\ValueObjects\Decimal;
use AppquariumBundle\Controller\CustomBaseController;
use SimpleBus\Message\Bus\MessageBus;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class ParamMeasuresPostController extends CustomBaseController
{
    private $commandBus;

    public function __construct(MessageBus $commandBus, Container $container)
    {
        $this->commandBus = $commandBus;
        $this->container = $container;
    }


    public function storeAction($idAquarium, Request $request)
    {
        $this->checkUser($idAquarium);
        $measuresRequest = json_decode($request->getContent());


        $result = [];
        foreach ($measuresRequest as $measures)
        {

                $result[$measures->name] = (new Decimal($measures->value))->value();

        }
        $measuresDate = $this->measureDate($result);

         $command = new PostMeasuresCommand($result, $measuresDate, $idAquarium);
         $this->commandBus->handle($command);

        $measuresService = $this->get('measures_service');
        $measures = $measuresService->LastAquariumMeasures($idAquarium);

        return new Response(json_encode($measures));



    }

    private function measureDate(&$arrayForm)
    {

        $measuresDate = $arrayForm["measureDate"];
        unset($arrayForm["measureDate"]);
        return $measuresDate;
    }


}
