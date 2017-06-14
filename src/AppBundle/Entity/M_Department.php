<?php
/**
 * Created by PhpStorm.
 * User: arttit
 * Date: 30/3/2560
 * Time: 21:55 น.
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * G_Company
 *
 * @ORM\Table(name="M_Department")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\M_DepartmentRepository")
 */
class M_Department{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\JoinColumn(name="fk_cpnCode", referencedColumnName="cpnCode")
     */
    private $cpnCode;



    /**
     * @var string
     * @ORM\Column(name="departmentCode", type="string", length=10)
     */
    private  $departmentCode;



    /**
     * @var string
     *
     * @ORM\Column(name="departmentDesc", type="string", length=120)
     */

    private  $departmenDesc;

    /*
     * get
     */


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCpnCode()
    {
        return $this->cpnCode;
    }

    /**
     * @return string
     */
    public function getDepartmentCode()
    {
        return $this->departmentCode;
    }

    /**
     * @return string
     */
    public function getDepartmenDesc()
    {
        return $this->departmenDesc;
    }

    /*
     * set
     */
    /**
     * @param string $cpnCode
     * @return  M_Department
     */
    public function setCpnCode($cpnCode)
    {
        $this->cpnCode = $cpnCode;
    }

    /**
     * @param string $departmenDesc
     *  @return  M_Department
     */
    public function setDepartmenDesc($departmenDesc)
    {
        $this->departmenDesc = $departmenDesc;
    }

    /**
     * @param string $departmentCode
     *  @return  M_Department
     */
    public function setDepartmentCode($departmentCode)
    {
        $this->departmentCode = $departmentCode;
    }







}