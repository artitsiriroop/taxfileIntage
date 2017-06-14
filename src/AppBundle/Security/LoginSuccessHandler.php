<?php
namespace AppBundle\Security;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Router;



class LoginSuccessHandler implements AuthenticationSuccessHandlerInterface
{

    // …

    /**
     * @param Request        $request
     * @param TokenInterface $token
     * @return RedirectResponse
     */

    protected $router;
    protected $security;
    protected  $authorizationChecker;

    public function __construct(TokenStorage $security,Router $router,AuthorizationChecker $authorizationChecker)
    {
        $this->router = $router;
        $this->security = $security->getToken();
        $this->authorizationChecker=$authorizationChecker;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {





        //$this->('session')->set('loginUserId', $user);


        if ($this->authorizationChecker->isGranted('ROLE_SUPER_ADMIN'))
        {

            $response = new RedirectResponse($this->router->generate('sonata_admin_dashboard'));

        }
        elseif ($this->authorizationChecker->isGranted('ROLE_ADMIN'))
        {
            $response = new RedirectResponse($this->router->generate('upload_file_index'));
        }
        elseif ($this->authorizationChecker->isGranted('ROLE_USER'))
        {
            $response = new RedirectResponse($this->router->generate('user_homepage'));

        }
        elseif ($this->authorizationChecker->isGranted('ROLE_FIELD_ADMIN'))
        {
            $response = new RedirectResponse($this->router->generate('upload_file_index'));

        }
        //$this->get('session')->set('loginUserId', $user['user_id']);


        return $response;
    }
}