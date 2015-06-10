<?php
namespace AppquariumBundle\Services;

use AppquariumBundle\Aquarium\Repository\EntityRepositoryInterface;
use AppquariumBundle\Entity\Accessory;
use AppquariumBundle\Entity\AquariumMaintenance;
use SimpleBus\Message\Message;


class CalendarService {

    private $entityManager;

    public function __construct(EntityRepositoryInterface $entityManager){

        $this->entityManager = $entityManager;

    }

    public function aquariumReminders($aquariumId){
        $aquarium = $this->aquarium($aquariumId);
        return $this->entityManager->repository("AppquariumBundle:AquariumMaintenance")
        ->findBy(
            array(
            "aquarium" => $aquarium,
            )
        );

    }

    public function Next7DaysEvents($aquariumId){
        return $this->entityManager->repository("AppquariumBundle:AquariumMaintenance")
            ->Next7DaysEvents($aquariumId);

    }

    public function store(Message $message)
    {

        $calendar = new AquariumMaintenance();

        $calendar->setName($message->data["title"]);
        $calendar->setMaintenanceDate($message->data["date"]);
        $calendar->setCreatedAt(strtotime("now"));
        $calendar->setUpdatedAt(strtotime("now"));
        $calendar->setAquarium($this->aquarium($message->aquariumId));
        $this->entityManager->save($calendar);
        return $calendar->getId();


    }

    public function remove($idEvent)
    {
        $event = $this->entityManager->repository("AppquariumBundle:AquariumMaintenance")->find($idEvent);
        $this->entityManager->remove($event);

    }

    public function eventsForCalendar($aquariumId)
    {

        $events = $this->aquariumReminders($aquariumId);
        $items = array();
        foreach ($events as $currentEvent) {
            $item['id'] = $currentEvent->getId();
            $item['title'] = $currentEvent->getName();
            $item['date'] = $currentEvent->getMaintenanceDate();


            $items[] = $item;
        }

        return $items;
    }


    private function aquarium($aquariumId){

        return $this->entityManager->repository("AppquariumBundle:Aquarium")->find($aquariumId);

    }






}