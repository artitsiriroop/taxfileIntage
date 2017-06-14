<?php
/**
 * Created by PhpStorm.
 * User: arttit
 * Date: 21/4/2560
 * Time: 19:06 น.
 */

namespace UserBundle\Controller;


class TestController extends Controller
{

public  function  indexAction()
{

    return $this->render('UserBundle:Admin:settingDepartmentIndex.html.twig');
}
}