<?php
namespace AppquariumBundle\Services;

use AppquariumBundle\Aquarium\Repository\EntityRepositoryInterface;


class ImagesService
{

    private $entityManager;

    public function __construct(EntityRepositoryInterface $entityManager)
    {

        $this->entityManager = $entityManager;

    }

    public function aquariumImages($aquariumId)
    {

        $imageRepository = $this->entityManager->repository("AppquariumBundle:Image");
        return $imageRepository->aquariumImages($aquariumId);

    }

    public function image($id)
    {

        $imageRepository = $this->entityManager->repository("AppquariumBundle:Image");
        return $imageRepository->find($id);


    }

    public function deleteImage($image)
    {

        $this->entityManager->remove($image);
        unlink("assets/dashboard/img/uploads/".$image->getName());

    }


}