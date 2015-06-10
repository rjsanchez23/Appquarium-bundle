<?php
namespace AppquariumBundle\Services;


use AppquariumBundle\Aquarium\Library\StatisticsParser;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;

class StatisticsService
{

    private $container;
    private $statisticsParser;

    public function __construct(Container $container, StatisticsParser $statisticsParser)
    {

        $this->container = $container;
        $this->statisticsParser = $statisticsParser;
    }


    public function daysPeriod($valueRangeId, $period)
    {
        $measuresService = $this->container->get('measures_service');
        $measures = $measuresService->historyMeasures($valueRangeId, $period);
        $measures = $this->measuresDateValueArrayFormat($measures);

        return $this->statisticsParser->measuresAllDaysPeriodBack($period, $measures);

    }


    public function monthsPeriod($valueRangeId, $period)
    {

        $measuresService = $this->container->get('measures_service');
        $measures = $measuresService->historyMonthMeasures($valueRangeId, $period);
        $measuresMonthsBackArray = $this->measuresDateValueArrayFormat($measures, "month_value");

        return $this->statisticsParser->measuresAllMonthPeriodBack($period, $measuresMonthsBackArray);
    }

    private function measuresDateValueArrayFormat($measures, $timeFormatFlag = "day_value")
    {
        $measureValue = array();
        foreach ($measures as $currentMeasure) {
            $measureValue[$currentMeasure[$timeFormatFlag]] = (float)$currentMeasure["value"];
        }
        return $measureValue;
    }




    public function paramHistoryMeasures($parameters, $daysBack)
    {
        $parameterDefault = $this->aquariumDefaultParam($parameters);
        return $this->daysPeriod($parameterDefault, $daysBack);
    }

    public function actualParamsLevel($aquariumID)
    {
        $measuresService = $this->container->get('measures_service');
        return $measuresService->LastAquariumMeasures($aquariumID);
    }


    private function aquariumDefaultParam($parameters)
    {
        if (!empty($parameters)) {
            return $parameters[0]["value_range_id"];
        }
        return null;

    }


}
