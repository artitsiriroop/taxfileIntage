<?php
/**
 * Created by PhpStorm.
 * User: arttit
 * Date: 24/4/2560
 * Time: 10:13 น.
 */

namespace AppBundle\Listener;



use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;
use FOS\UserBundle\Doctrine\UserManager;
use Symfony\Component\Routing\Router;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;









class LoginListener{
    protected $userManager;
    protected $authorizationChecker;
    protected $router;
    protected  $dispatcher;
    public function __construct(UserManager $userManager,AuthorizationChecker $authorizationChecker,Router $router,EventDispatcherInterface $dispatcher){
        $this->userManager = $userManager;
        $this->authorizationChecker=$authorizationChecker;
        $this->router=$router;
        $this->dispatcher=$dispatcher;
    }
    public function onSecurityInteractiveLogin( InteractiveLoginEvent $event )
    {


        if ($this->authorizationChecker->isGranted ( 'IS_AUTHENTICATED_FULLY' )) {
            $user = $event->getAuthenticationToken()->getUser ();

            if ($user->getLastLogin() === null) {
                $this->dispatcher->addListener (KernelEvents::RESPONSE, array (
                    $this,
                    'onKernelResponse'
                ) );
            }
        }
    }
    public function onKernelResponse(FilterResponseEvent $event) {
        $response = new RedirectResponse ( $this->router->generate ( 'fos_user_change_password' ) );
        $event->setResponse ( $response );
    }

}

