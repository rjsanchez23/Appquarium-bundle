<?php

namespace AppquariumBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Symfony\Component\HttpFoundation\Request,
    SimpleBus\Message\Bus\MessageBus,
    Symfony\Component\DependencyInjection\Container,
    Symfony\Component\Routing\Generator\UrlGeneratorInterface,
    Symfony\Component\HttpFoundation\RedirectResponse,
    AppquariumBundle\Aquarium\Command\Admin\UpdateSolutionParameterCommand;

class ParameterSolutionsAdminController extends Controller {

    private $commandBus;
    private $router;

    public function __construct(MessageBus $commandBus, Container $container, UrlGeneratorInterface $router)
    {
        $this->commandBus = $commandBus;
        $this->container = $container;
        $this->router = $router;
    }

    public function parameterListAction(Request $request)
    {
        $parameter_service = $this->container->get('appquarium.admin.service');
        $parameters = $parameter_service->getAllParameters();
        return $this->render('admin/solutions-list.html.twig', ['parameters' => $parameters]);
    }

    public function storeParametersAction(Request $request)
    {
        try
        {
            $max = $request->request->get('max');
            $min = $request->request->get('min');
            $max_parameters_solution = array_map(function ($parameter) {return filter_var($parameter, FILTER_SANITIZE_URL);}, $max);
            $min_parameters_solution = array_map(function ($parameter) {return filter_var($parameter, FILTER_SANITIZE_URL);}, $min);
            $command = new UpdateSolutionParameterCommand($max_parameters_solution, $min_parameters_solution);
            $this->commandBus->handle($command);

            $url = $this->router->generate('admin.parameters');
            $session = $this->container->get('session');
            $session->getFlashBag()->add('notice', "Los parametros se han actualizado correctamente");
            $response = new RedirectResponse($url);
        }
        catch(\Exception $e)
        {
            $response = $this->render('admin/error.html.twig', ['error' => $e->getMessage()]);
        }

        return $response;

    }
} 