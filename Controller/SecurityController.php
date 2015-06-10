<?php namespace AppquariumBundle\Controller;

use FOS\UserBundle\Controller\SecurityController as BaseController,
    Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpFoundation\RedirectResponse;

class SecurityController extends BaseController {

    public function loginAction(Request $request)
    {

        $router = $this->get('router');

        $security_context = $this->container->get('security.context');

        if ($security_context->isGranted('ROLE_ADMIN'))
        {
            $path = $router->generate('admin.users_list');
            return new RedirectResponse($path);
        }
        elseif($security_context->isGranted('ROLE_USER'))
        {
            $path = $router->generate('dashboard_homepage');
            return new RedirectResponse($path);
        }

        $response = parent::loginAction($request);
        return $response;
    }
} 