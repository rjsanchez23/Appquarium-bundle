<?php namespace AppquariumBundle\Services;

use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface,
    Symfony\Component\Routing\Router,
    Symfony\Component\HttpFoundation\RedirectResponse,
    Symfony\Component\HttpFoundation\Request,
    Symfony\Component\Security\Core\SecurityContext,
    Symfony\Component\Security\Core\Authentication\Token\TokenInterface;


class LoginSuccessHandler implements AuthenticationSuccessHandlerInterface {

    protected $router;
    protected $security;

    public function __construct(Router $router, SecurityContext $security)
    {
        $this->router = $router;
        $this->security = $security;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {

        if ($this->security->isGranted('ROLE_ADMIN'))
        {
            $response = new RedirectResponse($this->router->generate('admin.users_list'));
        }
        elseif ($this->security->isGranted('ROLE_USER'))
        {
            $response = new RedirectResponse($this->router->generate('dashboard_homepage'));
        }

        return $response;
    }
} 