<?php
/**
 * Created by PhpStorm.
 * User: arttit
 * Date: 15/4/2560
 * Time: 12:52 น.
 */

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\User;
class UserRepository extends  EntityRepository
{
    public function findCompanyByUseId($id)
    {
        $em= $this->getEntityManager();
        $query = $em->createQuery('SELECT  u.fk_cpnCode  FROM AppBundle:User u WHERE u.id = :id')
                    ->setParameter('id',$id);
        $result =  $query->getFirstResult();


        return $result;


    }
    public function setUserStatus($fosId,$boolean)
    {

        $em= $this->getEntityManager();
        $query = $em->createQuery('UPDATE   AppBundle:User  usr SET usr.enabled=:boolean  WHERE usr.id = :id')
            ->setParameter('boolean',$boolean)
            ->setParameter('id',$fosId);



        return $query;

    }
    public  function countUserByUsername($username)
    {
        $em= $this->getEntityManager();
        $query = $em->createQuery('SELECT COUNT(usr.id)  FROM  AppBundle:User  usr   WHERE usr.username = :username')
            ->setParameter('username',$username);

        $result =  $query->getSingleScalarResult();
        return $result;


    }

    protected  function hookSaveFosUse($form)
    {
        $user=new User();
        $data=$form->getData();
         $user->setUsername($data['form[name]']);
         $user->setPassword($data['form[lastname]']);
         $user->setRoles('xx');
         $user->setEmail($data['zz@hotmsil.com']);
         $user->setEmailCanonical($data['zz@hotmsil.com']);
         $user->setCpnCode($data['form[name]']);

        $em = $this->getDoctrine()->getManager();

        // tells Doctrine you want to (eventually) save the Product (no queries yet)
        $em->persist($user);

        // actually executes the queries (i.e. the INSERT query)
        $em->flush();

    }

}