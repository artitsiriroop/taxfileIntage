<?php
/**
 * Created by PhpStorm.
 * User: arttit
 * Date: 8/4/2560
 * Time: 21:32 น.
 */

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
class DashboardController extends Controller
{
    public function dashboardAction()
    {

        $usrId= $this->get('security.token_storage')->getToken()->getUser()->getId();
        $result=$this->getDoctrine()->getRepository("AppBundle:User")->find($usrId);
        $cpnCode=$result->getCpnCode();
        return $this->render('UserBundle:Admin:dashboard.html.twig',array('cpnCode'=>$cpnCode));
    }

}