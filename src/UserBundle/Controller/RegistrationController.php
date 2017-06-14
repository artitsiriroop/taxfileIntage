<?php
// src/Acme/UserBundle/Controller/RegistrationController.php

namespace UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;

use FOS\UserBundle\Controller\RegistrationController as BaseController;

use AppBundle\Entity\m_employee;

class RegistrationController extends BaseController
{

    public function registerAction(Request $request)
    {
        $response = parent::registerAction($request);

        // ... do custom stuff

        return $response;

    }

}