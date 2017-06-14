<?php

namespace AppBundle\Repository;

class  m_employeeRepository extends \Doctrine\ORM\EntityRepository {

    public  function getAllEmpByCpn($cpnCode)
        {
            $em= $this->getEntityManager();
            $query = $em->createQuery('SELECT emp FROM AppBundle:m_employee emp  JOIN emp.fos fos WHERE emp.cpnCode = :cpnCode and fos.enabled=1')
                ->setParameter('cpnCode',$cpnCode);
            $result =  $query->getResult();
            return $result;

        }

    public  function joinUserByFos($id)
    {
        $em= $this->getEntityManager();
        $query = $em->createQuery('SELECT f.id FROM AppBundle:m_employee emp
        JOIN emp.fos f   WHERE emp.id = :id')
            ->setParameter('id',$id);
        $result =  $query->getFirstResult();
        return $result;

    }

    /*
     * public  function getAllEmpByCpn($cpnCode)
        {
            $em= $this->getEntityManager();
            $query = $em->createQuery('SELECT emp FROM AppBundle:m_employee emp WHERE emp.cpnCode = :cpnCode')
                ->setParameter('cpnCode',$cpnCode);
            $result =  $query->getResult();
            return $result;

        }
     */



}