<?php


namespace AppquariumBundle\Entity;

use Doctrine\ORM\EntityRepository;

class AquariumMaintenanceRepository extends EntityRepository
{



    public function Next7DaysEvents($aquariumID)
    {

        $sql = <<<'SQL'
            SELECT  maintenance_date, name
            FROM aquarium_maintenance
            WHERE maintenance_date > UNIX_TIMESTAMP()
            AND  aquarium_id = ? AND maintenance_date < UNIX_TIMESTAMP(DATE_ADD(NOW(), INTERVAL 7 day))
            ORDER BY maintenance_date ASC
SQL;

        $stmt = $this->getEntityManager()->getConnection()->prepare($sql);
        $stmt->bindValue(1, $aquariumID,\PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();


    }

}