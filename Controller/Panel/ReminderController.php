<?php

namespace AppquariumBundle\Controller\Panel;

use AppquariumBundle\Controller\CustomBaseController;
use SimpleBus\Message\Bus\MessageBus;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;


class ReminderController extends CustomBaseController
{

    private $commandBus;

    public function __construct(MessageBus $commandBus, Container $container )
    {
        $this->commandBus = $commandBus;
        $this->container = $container;
    }

    public function next7DaysReminders($aquariumID)
    {
        $this->checkUser($aquariumID);
        $calendarService = $this->get('calendar_service');
        $events = $calendarService->Next7DaysEvents($aquariumID);
        return $this->render('dashboard/aquariumReminder.html.twig',
            array(
                'reminders' => $events,
            )
        );
    }
}
