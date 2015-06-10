<?php

namespace AppquariumBundle\Controller\Panel;


use AppquariumBundle\Controller\CustomBaseController;
use SimpleBus\Message\Bus\MessageBus;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;


class GalleryController extends CustomBaseController
{

    private $commandBus;

    public function __construct(MessageBus $commandBus, Container $container)
    {
        $this->commandBus = $commandBus;
        $this->container = $container;
    }


    public function galleryUploadAction($aquariumId)
    {
        $this->checkUser($aquariumId);
        $aquariumImages = $this->gallery($aquariumId);

        return $this->render('dashboard/galleryManager.html.twig',
            array(
                'images' => $aquariumImages,
                'aquarium' => $aquariumId
            )
        );

    }

    public function galleryAction($aquariumId)
    {
        $this->checkUser($aquariumId);
        $aquariumImages = $this->gallery($aquariumId);
        return $this->render('dashboard/gallery.html.twig',
            array(
                'images' => $aquariumImages,
                'aquarium' => $aquariumId
            )
        );

    }

    private function gallery($aquariumId)
    {
        $imageService = $this->get('aquarium_image_service');
        return $imageService->aquariumImages($aquariumId);
    }


}
