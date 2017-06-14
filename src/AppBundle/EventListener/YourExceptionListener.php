<?php
/**
 * Created by PhpStorm.
 * User: artit-s
 * Date: 2560-06-13
 * Time: 12:31
 */
namespace AppBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
class YourExceptionListener
{
    /**
     * @Route("/lucky/number")
     */
    public function onPdoException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();

        if ($exception instanceof PDOException) {
            $number = mt_rand(0, 100);

            return new Response(
                '<html><body>Lucky number: '.$number.'</body></html>'
            );
            //now you can do whatever you want with this exception
        }
    }
}