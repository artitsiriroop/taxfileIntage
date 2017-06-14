<?php

namespace AppBundle\Repository;
class G_CompanyRepository extends \Doctrine\ORM\EntityRepository
{
    public  function getIdCode($id)
    {
        $em= $this->getEntityManager();
        $query =
            $em->createQuery('SELECT company FROM AppBundle:G_Company company WHERE company.cpnCode = :id')
                ->setParameter('id',$id);
        $result =  $query->getFirstResult();
        return $result;

    }

}

