<?php

namespace AppquariumBundle\Controller\Panel;


use AppquariumBundle\Controller\CustomBaseController;
use SimpleBus\Message\Bus\MessageBus;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


class StatisticsController extends CustomBaseController
{

    private $commandBus;

    public function __construct(MessageBus $commandBus, Container $container)
    {
        $this->commandBus = $commandBus;
        $this->container = $container;
    }


    public function statisticsAction($aquariumId)
    {
        $daysBack = 7;
        $statisticsService = $this->get('statistics_service');
        $this->checkUser($aquariumId);
        $parameters = $statisticsService->actualParamsLevel($aquariumId);
        $measures = $statisticsService->paramHistoryMeasures($parameters, $daysBack);

        return $this->render('dashboard/statistic.html.twig',
            array(
                "aquarium" => $aquariumId,
                "parameters" => $parameters,
                "measures" => $measures,
            )
        );
    }




    public function ajaxStatisticsAction(Request $request)
    {

        $ajaxParamArray = json_decode($request->getContent());
        $ajaxParamArray->paramId = filter_var($ajaxParamArray->paramId, FILTER_SANITIZE_NUMBER_INT);
        $ajaxParamArray->periodId = filter_var($ajaxParamArray->periodId, FILTER_SANITIZE_NUMBER_INT);
        $statisticsService = $this->get('statistics_service');
        if ($ajaxParamArray->periodId > 30) {
            $arrayData = $statisticsService->monthsPeriod($ajaxParamArray->paramId, $ajaxParamArray->periodId);
        } else {
            $arrayData = $statisticsService->daysPeriod($ajaxParamArray->paramId, $ajaxParamArray->periodId);
        }

        return new JsonResponse($arrayData);
    }





}
