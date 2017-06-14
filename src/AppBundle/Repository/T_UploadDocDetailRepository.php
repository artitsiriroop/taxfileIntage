<?php
/**
 * Created by PhpStorm.
 * User: arttit
 * Date: 25/4/2560
 * Time: 22:39 น.
 */

namespace AppBundle\Repository;


class T_UploadDocDetailRepository extends \Doctrine\ORM\EntityRepository
{
    public  function getAllDocDetail($header)
    {

        $em= $this->getEntityManager();
        $query = $em->createQuery('SELECT ddt.id,ddt.sumItems,ddt.userName,emp.name,emp.lastname FROM AppBundle:T_UploadDocDetail ddt
             LEFT JOIN AppBundle:User fos WITH fos.username = ddt.userName
             LEFT JOIN AppBundle:m_employee emp WITH fos.id = emp.fos
             WHERE ddt.header = :header ')
              ->setParameter('header',$header);
        $result =  $query->getResult();
        return $result;
    }


}