<?php namespace AppquariumBundle\Aquarium\Library;


interface StatisticsParserInterface {

    public function measuresAllDaysPeriodBack($period, $measures);
    public function measuresAllMonthPeriodBack($period, $measures);
} 