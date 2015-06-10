<?php

namespace AppquariumBundle\Controller\Panel;


use AppquariumBundle\Aquarium\Command\PostImagesCommand;
use AppquariumBundle\Controller\AvatarTrait;
use AppquariumBundle\Controller\CustomBaseController;
use SimpleBus\Message\Bus\MessageBus;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


class ImagePostController extends CustomBaseController
{
    use AvatarTrait;
    private $commandBus;

    public function __construct(MessageBus $commandBus, Container $container)
    {
        $this->commandBus = $commandBus;
        $this->container = $container;
    }


    public function uploadImage(Request $request, $aquariumId)
    {

        $this->checkUser($aquariumId);
        $imagesArray = $this->avatarToArray($request, 'file');
        $command = $this->postImage($imagesArray, $aquariumId);
        return new JsonResponse($command->response);

    }


    public function deleteImages(Request $request)
    {

        $images = json_decode($request->getContent());
        $imagesDeleted = [];

        foreach ($images as $currentImage) {
            $imagesDeleted[] = $this->removeImage($currentImage);
        }

        return new JsonResponse($imagesDeleted);
    }

    private function postImage($imagesArray, $aquariumId)
    {
        $command = new PostImagesCommand($imagesArray, $aquariumId);
        $this->commandBus->handle($command);
        return $command;
    }

    private function removeImage($image)
    {

        $imageService = $this->get('aquarium_image_service');
        $image = $imageService->image($image);
        $this->checkUser($image->getAquarium()->getId());
        $imageService->deleteImage($image);
        return $image->getId();

    }


}
