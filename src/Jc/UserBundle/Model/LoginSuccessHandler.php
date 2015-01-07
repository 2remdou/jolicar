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
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

class LoginSuccessHandler implements AuthenticationSuccessHandlerInterface {

    private $router;
    private $session;

    public  function __construct(RouterInterface $router,Session $session){
        $this->router = $router;
        $this->session = $session;
    }
    /**
     * This is called when an interactive authentication attempt succeeds. This
     * is called by authentication listeners inheriting from
     * AbstractAuthenticationListener.
     *
     * @param Request $request
     * @param TokenInterface $token
     *
     * @return Response never null
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        // TODO: Implement onAuthenticationSuccess() method.
        $key = '_security.main.target_path';
        if($this->session->has($key)){
            $url = $this->session->get($key);

            $this->session->remove($key);
        }
        else{
            $url = $this->router->generate('joliecar_accueil');
        }
        $this->session->getFlashBag()->add('message','Bienvenue sur Joliecar '.$token->getUser()->getNom());

        return new RedirectResponse($url);
    }
}