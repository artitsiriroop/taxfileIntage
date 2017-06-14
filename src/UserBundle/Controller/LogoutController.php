<?php
/**
 * Created by PhpStorm.
 * User: arttit
 * Date: 9/4/2560
 * Time: 17:04 น.
 */

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
class LogoutController extends  Controller
{
    public function logoutAction()
    {
        return $this->render('UserBundle:Global:logout.html.twig');
    }

}