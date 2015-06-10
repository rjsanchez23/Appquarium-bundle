<?php


namespace AppquariumBundle\Services;


use AppquariumBundle\Aquarium\Repository\EntityRepositoryInterface;
use AppquariumBundle\Entity\Accessory;
use SimpleBus\Message\Message;

class AccessoryPost
{


    private $accessory;
    private $entityManager;

    public function __construct(EntityRepositoryInterface $entityManager, Accessory $accessory)
    {

        $this->accessory = $accessory;
        $this->entityManager = $entityManager;

    }

    public function store(Message $message)
    {

        $this->accessory->setName($message->data["name"]);
        $this->accessory->setPrice($message->data["price"]);
        $this->accessory->setDate(strtotime(str_replace("/", "-", $message->data["date"])));
        $this->accessory->setAquarium($this->aquarium($message->aquariumId));
        $this->entityManager->save($this->accessory);

        return $this->accessory->getId();


    }

    private function aquarium($id)
    {
        $aquariumRepository = $this->entityManager->repository("AppquariumBundle:Aquarium");
        return $aquariumRepository->find($id);
    }

}