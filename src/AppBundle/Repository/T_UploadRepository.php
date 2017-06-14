<?php
/**
 * Created by PhpStorm.
 * User: arttit
 * Date: 20/4/2560
 * Time: 19:46 น.
 */

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
class T_UploadRepository  extends  EntityRepository
{
    public  function getUpLoadLocation($id)
    {
        $em= $this->getEntityManager();
        $query =
            $em->createQuery('SELECT upLoad.uploadLocation FROM AppBundle:T_Upload upLoad WHERE upLoad.id = :uploadId')
            ->setParameter('uploadId',$id);
        $result =  $query->getFirstResult();
        return $result;

    }
}