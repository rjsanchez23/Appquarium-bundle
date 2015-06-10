<?php

namespace AppquariumBundle\Services;


use AppquariumBundle\Aquarium\Library\Upload;
use AppquariumBundle\Aquarium\Repository\EntityRepositoryInterface;
use AppquariumBundle\Entity\AquariumInhabitant;

use AppquariumBundle\Entity\InhabitantLog;


class AquariumInhabitantPost
{

    private $inhabitant;
    private $entityManager;
    private $uploadManager;


    public function __construct(
        EntityRepositoryInterface $entityManager,
        AquariumInhabitant $inhabitant,
        Upload $uploadManager
    ) {

        $this->entityManager = $entityManager;
        $this->inhabitant = $inhabitant;
        $this->uploadManager = $uploadManager;
    }

    public function store(Array $inhabitantData, Array $avatar)
    {

        if (!is_null($inhabitantData["id"]))
        {
            $this->inhabitant = $this->inhabitant($inhabitantData["id"]);
        }
        if (!is_null($inhabitantData["aquariumId"]))
        {

            $aquarium = $this->aquarium($inhabitantData["aquariumId"]);
            $this->inhabitant->setAquarium($aquarium);
            $this->inhabitant->setCreatedAt(strtotime("now"));


        }
        $this->uploadAvatar($avatar);
        $this->inhabitant->setUpdatedAt(strtotime("now"));
        $this->inhabitant->setAlias($inhabitantData["alias"]);
        $this->inhabitant->setFamily($inhabitantData["family"]);
        $this->inhabitant->setScientificName($inhabitantData["scientificName"]);
        $this->inhabitant->setPrice($inhabitantData["price"]);
        $this->inhabitant->setFoodType($inhabitantData["foodType"]);
        $this->inhabitant->setFeedTime($inhabitantData["feedTime"]);
        $this->inhabitant->setNumber($inhabitantData["number"]);
        $this->inhabitant->setDescription($inhabitantData["description"]);


        $this->entityManager->save($this->inhabitant);

        return $this->inhabitant->getId();

    }


    public function storeLog($comment)
    {

        $log = new InhabitantLog();


        $inhabitant = $this->inhabitant($comment->inhabitantId);
        $log->setAquariumInhabitant($inhabitant);
        $log->setComment($comment->comment);
        $log->setCreatedAt(strtotime("now"));
        $comment->response = $log;
        $this->entityManager->save($log);

    }

    public function aquarium($aquariumId)
    {
        $aquariumRepository = $this->entityManager->repository("AppquariumBundle:Aquarium");
        return $aquariumRepository->find($aquariumId);
    }

    public function inhabitant($inhabitantId)
    {
        $inhabitantRepository = $this->entityManager->repository("AppquariumBundle:AquariumInhabitant");
        return $inhabitantRepository->find($inhabitantId);
    }


    private function uploadAvatar($avatar)
    {

        if (!empty($avatar["tmp_name"]))
        {

            $imageHashedName = $this->uploadManager->upload($avatar, "assets/dashboard/img/uploads/");
            $this->inhabitant->setAvatar($imageHashedName);

        }

    }


}
