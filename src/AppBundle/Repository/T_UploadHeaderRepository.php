<?php
/**
 * Created by PhpStorm.
 * User: arttit
 * Date: 22/4/2560
 * Time: 14:03 น.
 */

namespace AppBundle\Repository;


class T_UploadHeaderRepository extends \Doctrine\ORM\EntityRepository
{

    public  function getPersonalDocHeader($param)
    {
        $em= $this->getEntityManager();
        $query = $em->createQuery('SELECT  DISTINCT(header.docYear) as docYear,header.id  FROM AppBundle:T_UploadHeader header 
                                    INNER JOIN AppBundle:T_UploadDetail detail WITH header.id=detail.header
                                    WHERE detail.userName = :userName')
            ->setParameter('userName',$param["id"]);
        $result =  $query->getResult();
        return $result;

    }

}