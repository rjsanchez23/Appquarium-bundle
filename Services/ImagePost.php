<?php

namespace AppquariumBundle\Services;


use AppquariumBundle\Aquarium\library\Upload;
use AppquariumBundle\Aquarium\Repository\EntityRepositoryInterface;
use AppquariumBundle\Entity\Aquarium;
use AppquariumBundle\Entity\Image;


class ImagePost
{

    private $entityManager;
    private $aquarium;
    private $uploadManager;
    private $image;

    public function __construct(EntityRepositoryInterface $entityManager, Aquarium $aquarium, Image $image, Upload $uploadManager)
    {
        $this->entityManager = $entityManager;
        $this->aquarium = $aquarium;
        $this->uploadManager = $uploadManager;
        $this->image = $image;
    }

    public function store($images,$aquariumId)
    {

        $aquarium = $this->aquarium($aquariumId);

            $imageHashedName = $this->uploadManager->upload($images, "assets/dashboard/img/uploads/");
            $image = clone $this->image;
            $image->setName($imageHashedName);
            $image->setAquarium($aquarium);

            $this->entityManager->save($image);
            $imagesSaved = array("id" => $image->getId(), "name" => $image->getName());


       return $imagesSaved;

    }


    private function aquarium($aquariumId)
    {
        $aquariumRepository = $this->entityManager->repository("AppquariumBundle:Aquarium");
        return $aquariumRepository->find($aquariumId);
    }
}