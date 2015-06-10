<?php


namespace AppquariumBundle\Entity;

use Doctrine\ORM\EntityRepository;

class WaterParamMeasureRepository extends EntityRepository
{

    public function findLastMeasureOfEachParamByAquarium($id)
    {

        return $this->repository()->createQueryBuilder('m')
            ->select("m, MAX(m.date)")
            ->where('m.aquarium = :aquarium')
            ->setParameter('aquarium', $this->aquarium()->find($id))
            ->orderBy("m.aquariumParam")
            ->addOrderBy("m.date", "DESC")
            ->getQuery()
            ->getResult();


    }

    public function AquariumParamsValues($aquariumId)
    {

        $sql = <<<'SQL'
            SELECT  t2.max_value, t2.min_value, t2.id as value_range_id, t3.name, t3.solution_high, t3.solution_low,
            (SELECT MAX(DATE) FROM water_param_measure WHERE param_value_range_id = t2.id) as max_date,
            (SELECT value FROM water_param_measure WHERE param_value_range_id = t2.id and date = max_date) as value
            FROM param_value_range t2
            INNER JOIN aquarium_param t3
            ON t2.param_id = t3.id
            WHERE t2.aquarium_id = ?
SQL;
        $stmt = $this->getEntityManager()->getConnection()->prepare($sql);
        $stmt->bindValue(1, $aquariumId,\PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();


    }
    public function historyMeasures($paramValueId, $lastDays)
    {
        $sql = <<<'SQL'
            SELECT id,day(FROM_UNIXTIME(t1.date)) AS day_value,
		    (SELECT value FROM water_param_measure
			WHERE day(FROM_UNIXTIME(date)) = day(FROM_UNIXTIME(t1.date)) AND param_value_range_id =t1.param_value_range_id
			ORDER BY id DESC LIMIT 1 ) AS value
            FROM water_param_measure t1 where param_value_range_id = ?
            AND date > UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL ? day))
            GROUP BY day(FROM_UNIXTIME(t1.date))
SQL;
        $stmt = $this->getEntityManager()->getConnection()->prepare($sql);
        $stmt->bindValue(1, $paramValueId,\PDO::PARAM_INT);
        $stmt->bindValue(2, $lastDays,\PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();


    }
    public function historyMonthMeasures($paramValueId, $lastMonths)
    {
        $sql = <<<'SQL'
                SELECT month(FROM_UNIXTIME(date)) as month_value, avg(value) as value
                FROM water_param_measure w
                WHERE w.param_value_range_id = ? AND date > UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL ? day))
                GROUP BY month_value
SQL;
        $stmt = $this->getEntityManager()->getConnection()->prepare($sql);
        $stmt->bindValue(1, $paramValueId,\PDO::PARAM_INT);
        $stmt->bindValue(2, $lastMonths,\PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();


    }

    private function repository()
    {
        return $this->getEntityManager()->getRepository("AppquariumBundle:WaterParamMeasure");
    }

    private function aquarium()
    {
        return $this->getEntityManager()->getRepository("AppquariumBundle:Aquarium");
    }

}