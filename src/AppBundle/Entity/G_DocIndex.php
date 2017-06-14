<?php
/**
 * Created by PhpStorm.
 * User: arttit
 * Date: 22/4/2560
 * Time: 8:43 น.
 */

namespace AppBundle\Entity;
/**
 * G_Company
 *
 * @ORM\Table(name="G_DocIndex")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\G_DocIndexRepository")
 */
use Doctrine\ORM\Mapping as ORM;
class G_DocIndex
{


    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     * @ORM\Column(name="docIndex", type="integer")
     */
    private  $docIndex;



    /**
     * @ORM\Column(name="docType", type="string",length=10)
     */
    private  $docType;



    /**
     * @ORM\Column(name="docTime", type="date")
     */
    private  $docTime;


    /**
     * @ORM\Column(name="docYear", type="string",length=4,options={"fixed" = true})
     */
    private  $docYear;

    /**
     * @ORM\Column(name="docMonth", type="string",length=2,options={"fixed" = true})
     */
    private  $docMonth;

    /**
     * @ORM\Column(name="docDay", type="string",length=2,options={"fixed" = true})
     */
    private  $docDay;









    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }




    /**
     * @return int
     */
    public function getDocIndex()
    {
        return $this->docIndex;
    }

    /**
     * @param int $docIndex
     * @return  G_DocIndex
     */
    public function setDocIndex($docIndex)
    {
        $this->docIndex = $docIndex;
    }

    /**
     * @return int
     */
    public function getDocType()
    {
        return $this->docType;
    }

    /**
     * @param int $docType
     */
    public function setDocType($docType)
    {
        $this->docType = $docType;
    }

    /**
     * @return mixed
     */
    public function getDocTime()
    {
        return $this->docTime;
    }

    /**
     * @param mixed $docTime
     */
    public function setDocTime($docTime)
    {
        $this->docTime = $docTime;
    }

    /**
     * @return mixed
     */
    public function getDocDay()
    {
        return $this->docDay;
    }

    /**
     * @return mixed
     */
    public function getDocMonth()
    {
        return $this->docMonth;
    }

    /**
     * @return mixed
     */
    public function getDocYear()
    {
        return $this->docYear;
    }

    /**
     * @param mixed $docDay
     */
    public function setDocDay($docDay)
    {
        $this->docDay = $docDay;
    }

    /**
     * @param mixed $docMonth
     */
    public function setDocMonth($docMonth)
    {
        $this->docMonth = $docMonth;
    }

    /**
     * @param mixed $docYear
     */
    public function setDocYear($docYear)
    {
        $this->docYear = $docYear;
    }






}