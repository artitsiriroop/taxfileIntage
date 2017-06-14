<?php
/**
 * Created by PhpStorm.
 * User: arttit
 * Date: 22/4/2560
 * Time: 8:47 น.
 */

namespace AppBundle\Repository;


class G_DocIndexRepository  extends \Doctrine\ORM\EntityRepository
{
    public  function nowDocIndex($docType)
    {


        $em= $this->getEntityManager();
        $query = $em->createQuery('SELECT doc FROM AppBundle:G_DocIndex doc WHERE doc.docTime = :today and doc.docType:docType')
            ->setParameter('today',new \DateTime())
            ->setParameter('docType',$docType);
        $result =  $query->getFirstResult();

        return $result;
    }
    public  function updateDocIndex($nowDoc,$nowDocId)
    {
        $em= $this->getEntityManager();
        $query= $em->createQuery('UPDATE AppBundle:G_DocIndex doc set doc.docIndex=:newIndex  WHERE doc.id =id')
            ->setParameter('newIndex',$nowDoc+1)
            ->setParameter('id',$nowDocId);






    }

}