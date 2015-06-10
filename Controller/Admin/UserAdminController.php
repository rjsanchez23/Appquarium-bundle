<?php

namespace AppquariumBundle\Controller\Admin;

use AppquariumBundle\Aquarium\Command\Admin\DeleteUserCommand,
    AppquariumBundle\Aquarium\ValueObjects\Email,
    AppquariumBundle\Aquarium\ValueObjects\Name,
    AppquariumBundle\Aquarium\ValueObjects\Surname,
    Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Symfony\Component\HttpFoundation\Request,
    SimpleBus\Message\Bus\MessageBus,
    Symfony\Component\DependencyInjection\Container,
    Symfony\Component\Routing\Generator\UrlGeneratorInterface,
    Symfony\Component\HttpFoundation\RedirectResponse,
    AppquariumBundle\Aquarium\Command\Admin\UpdateUserCommand,
    Symfony\Component\HttpFoundation\JsonResponse;
use AppquariumBundle\Aquarium\ValueObjects\Integer;

class UserAdminController extends Controller {

    private $commandBus;

    private $router;

    public function __construct(MessageBus $commandBus, Container $container, UrlGeneratorInterface $router)
    {
        $this->commandBus = $commandBus;
        $this->container = $container;
        $this->router = $router;
    }

    public function userListAction(Request $request)
    {
        $user_service = $this->container->get('appquarium.admin.service');
        $users = $user_service->getAllUsers();
        return $this->render('admin/users-list.html.twig', ['users' => $users]);
    }

    public function removeUserAction(Request $request)
    {
        try
        {
            $email = $request->get('rm-email');
            $email = new Email($email);
            $command = new DeleteUserCommand($email);
            $this->commandBus->handle($command);

            $url = $this->router->generate('admin.users_list');
            $session = $this->container->get('session');
            $session->getFlashBag()->add('notice', "El usuario se ha borrado correctamente");
            $response = new RedirectResponse($url);

        }
            catch (\Exception $e)
        {
            $response = $this->render('admin/error.html.twig', ['error' => $e->getMessage()]);
        }

        return $response;
    }

    public function updateUserAction(Request $request)
    {
        try
        {
            $email = new Email($request->get('email'));
            $name = new Name($request->get('name'));
            $username = new Name($request->get('nickname'));
            $surname = new Surname($request->get('surname'));
            $status = $request->request->getInt('status');

            $command = new UpdateUserCommand([
                'email'     => (string) $email,
                'name'      => (string) $name,
                'surname'   => (string) $surname,
                'username'  => (string) $username,
                'status'    => $status
            ]);

            $this->commandBus->handle($command);
            $url = $this->router->generate('admin.users_list');
            $session = $this->container->get('session');
            $session->getFlashBag()->add('notice', "El usuario se ha actualizado correctamente");
            $response = new RedirectResponse($url);

        }
            catch(\Exception $e)
        {
            $response = $this->render('admin/error.html.twig', ['error' => $e->getMessage()]);

        }
        return $response;
    }

    public function sendMessageAction(Request $request)
    {
        try
        {
            $input = json_decode($request->getContent());
            $message = $input->message;
            $receiver = $input->to;

            $email = new Email($receiver);
            $admin_service = $this->container->get('appquarium.admin.service');
            $user = $admin_service->findByEmail($email);
            $sender = $this->container->get('appquarium.mailer');
            $sender->sendEmailMessage($user, $message);
            $response = new JsonResponse( ['success' => 'El email se ha enviado correctamente'] );

        }
            catch(\Exception $e)
        {
            $response = new JsonResponse(['error' => $e->getMessage()]);
        }

        return $response;
    }

} 