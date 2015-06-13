<?php


namespace AppquariumBundle\Aquarium\Library;


class StatisticsParser implements StatisticsParserInterface
{


    public function measuresAllDaysPeriodBack($period, $measures)
    {
        $period = $this->periodDaysBackArray($period);
        return $this->allDaysMeasures($period, $measures);
    }

    public function measuresAllMonthPeriodBack($period, $measures)
    {
        $monthPeriod = $this->fromDaysToMonths($period);
        $arrayPeriod = $this->periodMonthBackArray($monthPeriod);

        return $this->allMonthsMeasures($arrayPeriod, $measures);
    }

    private function periodMonthBackArray($monthPeriod)
    {
        $arrayPeriod = array();
        for ($i = $monthPeriod - 1; $i >= 1; $i--) {
            array_push($arrayPeriod, date(('F'), strtotime("-" . $i . "Months")));
        }
        $currentMonth = date('F');
        array_push($arrayPeriod, $currentMonth);
        return $arrayPeriod;
    }

    private function fromDaysToMonths($days)
    {
        return round($days / 30);
    }


    private function allDaysMeasures($period, $measures)
    {
        $arrayData = array();
        $lastMeasure = 0;
        foreach ($period as $day) {
            $key = (int)$day->format('d');
            if (array_key_exists($key, $measures)) {
                $lastMeasure = $measures[$key];
            }
            $arrayData[] = array("value" => $lastMeasure, "date" => $day->format('d/m/Y'));
        }
        return $arrayData;
    }

    private function allMonthsMeasures($period, $measures)
    {
        $arrayData = array();
        $lastMeasure = 0;
        foreach ($period as $month) {
            if (array_key_exists($this->fromMonthNameToNumber($month), $measures)) {
                $lastMeasure = $measures[$this->fromMonthNameToNumber($month)];
            }
            $arrayData[] = array("value" => $lastMeasure, "date" => $month);
        }
        return $arrayData;
    }

    private function fromMonthNameToNumber($monthName)
    {
        return date('n', strtotime("$monthName"));
    }


    private function periodDaysBackArray($period)
    {
        $now = new \DateTime('tomorrow');
        $periodDaysAgo = (new \DateTime())->sub(new \DateInterval("P" . $period . "D"));
        $interval = new \DateInterval('P1D');
        return new \DatePeriod($periodDaysAgo, $interval, $now);
    }


}