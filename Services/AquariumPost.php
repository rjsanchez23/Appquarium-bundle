<?php


namespace AppquariumBundle\Services;


use AppquariumBundle\Aquarium\library\Upload;
use AppquariumBundle\Aquarium\Repository\EntityRepositoryInterface;
use AppquariumBundle\Entity\Aquarium;
use SimpleBus\Message\Message;

class AquariumPost
{


    private $aquarium;
    private $entityManager;
    private $uploadManager;

    public function __construct(EntityRepositoryInterface $entityManager, Aquarium $aquarium, Upload $uploadManager)
    {

        $this->aquarium = $aquarium;
        $this->entityManager = $entityManager;
        $this->uploadManager = $uploadManager;
    }

    public function store(Message $message)
    {

        if (!is_null($message->aquariumId)) {
            $this->aquarium = $this->aquariumById($message->aquariumId);
        }

        $this->uploadAvatar($message->avatar);
        $user = $this->userAquarium($message->userId);
        $this->aquarium->setAlias($message->data["alias"]);
        $this->aquarium->setCapacity($message->data["capacity"]);
        $this->aquarium->setDescription($message->data["description"]);
        $this->aquarium->setWaterType($message->data["water"]);
        $this->aquarium->setUser($user);
        $this->entityManager->save($this->aquarium);

        return $this->aquarium->getId();


    }

    public function userAquarium($userId)
    {

        $userRepository = $this->entityManager->repository("AppquariumBundle:User");
        return $userRepository->find($userId);
    }

    public function aquariumById($aquariumId)
    {

        $aquariumRepository = $this->entityManager->repository("AppquariumBundle:Aquarium");
        $aquarium = $aquariumRepository->find($aquariumId);
        if (empty($aquarium)) {
            throw new \Exception("invalid Aquarium id");
        }
        return $aquarium;

    }

    private function uploadAvatar($avatar)
    {

        if(!empty($avatar["tmp_name"])){

            $imageHashedName = $this->uploadManager->upload($avatar, "assets/dashboard/img/uploads/");
            $this->aquarium->setAvatar($imageHashedName);
        }

    }

}