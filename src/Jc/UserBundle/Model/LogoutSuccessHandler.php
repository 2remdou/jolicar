<?php
/**
 * Created by PhpStorm.
 * User: Toure
 * Date: 05/01/15
 * Time: 15:05
 */

namespace Jc\UserBundle\Model;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Logout\LogoutHandlerInterface;
use Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface;

class LogoutSuccessHandler implements LogoutSuccessHandlerInterface
{

    private $router;
    private $session;

    public function __construct(RouterInterface $router, Session $session)
    {
        $this->router = $router;
        $this->session = $session;
    }


    /**
     * Creates a Response object to send upon a successful logout.
     *
     * @param Request $request
     *
     * @return Response never null
     */
    public function onLogoutSuccess(Request $request)
    {
        // TODO: Implement onLogoutSuccess() method.
        $request->getSession()->getFlashBag()->add('message', 'Vous êtes maintenant déconnecté');

        return new RedirectResponse($this->router->generate('joliecar_accueil'));
    }
}

