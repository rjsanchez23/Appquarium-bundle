<?php

namespace AppquariumBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Symfony\Component\HttpFoundation\Request,
    SimpleBus\Message\Bus\MessageBus,
    Symfony\Component\DependencyInjection\Container,
    Symfony\Component\HttpFoundation\JsonResponse,
    AppquariumBundle\Aquarium\ValueObjects\Newsletter;

class NewsletterAdminController extends Controller {

    private $commandBus;

    public function __construct(MessageBus $commandBus, Container $container)
    {
        $this->commandBus = $commandBus;
        $this->container = $container;
    }
    public function newsletterAction(Request $request)
    {
        return $this->render('admin/newsletter.twig');
    }

    public function sendNewsletterAction(Request $request)
    {
        try
        {
            $input = json_decode($request->getContent());
            $message = new Newsletter($input->message);
            $repository = $this->container->get('appquarium.admin.service');
            $users = $repository->getAllUsersSubscribedToNewsletter();
            $sender = $this->container->get('appquarium.mailer');
            $sender->sendNewsletterMail($users, $message);

            $response = new JsonResponse( ['success' => 'La newsletter se ha enviado correctamente a todos los destinatarios'] );

        }
        catch(\Exception $e)
        {
            $response = new JsonResponse(['error' => $e->getMessage()]);
        }

        return $response;
    }
} 