<?php

namespace AppquariumBundle\Controller\HomePage;


use AppquariumBundle\Controller\CustomBaseController;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;

class HomePageController extends CustomBaseController
{


    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function indexAction()
    {
        return $this->render(':homepage:index.html.twig');
    }

}
