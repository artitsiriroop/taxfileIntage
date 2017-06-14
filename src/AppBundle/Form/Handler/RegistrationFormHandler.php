<?php
/**
 * Created by PhpStorm.
 * User: arttit
 * Date: 28/3/2560
 * Time: 22:52 น.
 */
namespace AppBundle\Form\Handler;


use FOS\UserBundle\Model\UserInterface;

class RegistrationFormHandler
{
    protected function onSuccess(UserInterface $user, $confirmation)
    {
        // Note: if you plan on modifying the user then do it before calling the
        // parent method as the parent method will flush the changes

        parent::onSuccess($user, $confirmation);

        // otherwise add your functionality here
    }
}
