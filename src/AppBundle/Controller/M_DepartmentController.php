<?php
/**
 * Created by PhpStorm.
 * User: arttit
 * Date: 14/4/2560
 * Time: 18:01 น.
 */

namespace AppBundle\Controller;

use AppBundle\Entity\M_Department;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class M_DepartmentController extends Controller
{

    /**
     * Lists all  entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entries = $em->getRepository('AppBundle:M_Department')->findAll();

        return $this->render('M_Department/index.html.twig', array(
            'M_Department' => $entries,
        ));
    }


}