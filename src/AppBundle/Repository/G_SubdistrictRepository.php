<?php
/**
 * Created by PhpStorm.
 * User: arttit
 * Date: 18/4/2560
 * Time: 13:40 น.
 */

namespace AppBundle\Repository;

/**
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\G_SubdistrictRepository")
 * @ORM\Table(name="G_Subdistrict",
 *     uniqueConstraints={@ORM\UniqueConstraint(name="subDisCode_unique",columns={"subDisCode"})},
 *
 * )
 *
 */
use Symfony\Component\BrowserKit\Response;
class G_SubdistrictRepository  extends \Doctrine\ORM\EntityRepository
{
    public  function getListOfZip()
    {

        $em= $this->getEntityManager();
        $query = $em->createQuery('SELECT  prv.prvNameTh,dt.disNameTh, sdt.subDisNameTh,sdt.zipCode  FROM AppBundle:G_Subdistrict sdt 
                                   JOIN  sdt.disCode  dt 
                                   JOIN  sdt.prvCode prv');
           // ->setParameter('cpnCode',$cpnCode);
        $result =  $query->getResult();

       // $result=implode('#',$result);
        //return $result;
      //  $em= $this->getEntityManager();
       // $query = $em->createQuery('SELECT  sdt.zipCode  FROM AppBundle:G_Subdistrict sdt ');
      //  $result =  $query->getResult();
       // return new Response(json_encode($result));
        return $result;



    }


}