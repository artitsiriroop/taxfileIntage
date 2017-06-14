<?php
/**
 * Created by PhpStorm.
 * User: arttit
 * Date: 13/4/2560
 * Time: 19:30 น.
 */

namespace AppBundle\Repository;


class M_DepartmentRepository extends \Doctrine\ORM\EntityRepository
{
    public  function  getAllDepartmentByCpn($cpnCode)
    {
        $em= $this->getEntityManager();
        $query = $em->createQuery('SELECT  doc  FROM AppBundle:M_Department doc WHERE doc.cpnCode = :cpnCode')
            ->setParameter('cpnCode',$cpnCode);
        $result =  $query->getResult();
        return new Response(json_encode($result));


        return $result;

    }

}