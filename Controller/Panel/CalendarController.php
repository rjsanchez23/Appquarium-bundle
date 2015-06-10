<?php

namespace AppquariumBundle\Controller\Panel;


use AppquariumBundle\Aquarium\Command\Calendar\PostEventCommand;
use AppquariumBundle\Controller\CustomBaseController;
use SimpleBus\Message\Bus\MessageBus;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


class CalendarController extends CustomBaseController
{

    private $commandBus;

    public function __construct(MessageBus $commandBus, Container $container)
    {
        $this->commandBus = $commandBus;
        $this->container = $container;
    }


    public function calendarAction($idAquarium)
    {

        $calendarService = $this->get('calendar_service');
        $events = $calendarService->eventsForCalendar($idAquarium);
        return $this->render('dashboard/calendar.html.twig',
            array(
                'aquarium' => $idAquarium,
                'events' => json_encode($events)
            )
        );

    }

    public function removeEventCalendarAction($idEvent){
        $calendarService = $this->get('calendar_service');
        $calendarService->remove($idEvent);
        return new JsonResponse(array("result" => "ok"));
    }

    public function postEventCalendarAction(Request $request, $idAquarium)
    {

        $ajaxEventArray = get_object_vars(json_decode($request->getContent()));
        $command = new PostEventCommand($ajaxEventArray, $idAquarium);
        $this->commandBus->handle($command);
        return new JsonResponse(array("id" =>$command->eventId));
    }




}
