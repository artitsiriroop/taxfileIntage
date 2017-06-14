<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\AttributeOverrides;
use Doctrine\ORM\Mapping\AttributeOverride;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @ORM\Table(name="fos_user")
 *  * @AttributeOverrides({
 *     @AttributeOverride(name="email",
 *         column=@ORM\Column(
 *             name="email",
 *             type="string",
 *             length=180,
 *             unique=false,
 *             nullable=true
 *         )
 *     )
 * , @AttributeOverride(name="emailCanonical",
 *         column=@ORM\Column(
 *             name="email_canonical",
 *             type="string",
 *             length=180,
 *             unique=false,
 *             nullable=true
 *         )
 *     )
 * })
 *
 *
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();



        // your own logic
    }




    /*
     * @var \AppBundle\Entity\m_employee
     */
    private  $name;



    /*
     * @var \AppBundle\Entity\m_employee
     */
    private  $lastname;


    /*
   * @var \AppBundle\Entity\m_employee
   */
    private  $created_at;


 /*
 * @var \AppBundle\Entity\m_employee
 */
    private  $empCode;

 /*
 * @var \AppBundle\Entity\m_employee
 */
    private  $address1;

 /*
* @var \AppBundle\Entity\m_employee
*/
    private  $address2;




    /**
     * @ORM\ManyToOne(targetEntity="G_Company",inversedBy="users")
     * @ORM\JoinColumn(name="cpnCode_id",referencedColumnName="cpnCode")
     */
    private $cpnCode;







    public function __toString() {
        return (string)$this->name;
    }






    /**
     * @return string
     */

    public function getCpnCode()
    {
        return $this->cpnCode;
    }


    /**
     * @return \AppBundle\Entity\m_employee
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * @return \AppBundle\Entity\m_employee
     */
    public  function  getLastname()
    {
        return $this->lastname;

    }

    /**
     * @return \AppBundle\Entity\m_employee
     */

    public function getAddress1()
    {
        return $this->address1;
    }
    /**
     * @return \AppBundle\Entity\m_employee
     */

    public function getAddress2()
    {
        return $this->address1;
    }

    /**
     * @return \AppBundle\Entity\m_employee
     */
    public  function  getCreatedAt()
    {
        return $this->created_at;

    }
    /**
     * @return \AppBundle\Entity\m_employee
     */
    public  function  getEmpCode()
    {
        return $this->empCode;

    }









    /**
     * @param string fk_cpnCode
     *
     *
     */
    public function setCpnCode($cpnCode)
    {
        $this->cpnCode = $cpnCode;
    }



    /*
     * @param string $name
     * @return User
     */
    public function setName( $name)
    {
        return $this->name=$name;
    }


    /*
     * @param string  $lastname
     * @return User
     */
    public function setLastname( $lastname)
    {
        return $this->lastname=$lastname;
    }


    /*
    * @param \AppBundle\Entity\m_employee  $created_at
    *
    * @return User
    */
    public function setCreatedAt(\AppBundle\Entity\m_employee $created_at)
    {
        return $this->created_at=$created_at;
    }


    /*
    * @param string  $empCode
    *
    * @return User
    */
    public function setEmpCode($empCode)
    {
        return $this->empCode=$empCode;
    }

    /*
    * @param string  $address1
    *
    * @return User
    */

    public function setAddress1($address1)
    {
        return $this->address1=$address1;
    }

    /*
    * @param string  $address2
    *
    * @return User
    */

    public function setAddress2($address2)
    {
        return $this->address2=$address2;
    }


    /******************************************************************************************************
     * G_province Table
     ******************************************************************************************************/

    /**
     * @var string
     */

    private $prvCode;

    /**
     * @var string
     */
    private $prvNameTh;

    /**
     * @var string
     */
    private $prvNameEn;

    /**
     * @return string
     */
    public function getPrvCode()
    {
        return $this->prvCode;
    }

    /**
     * @return string
     */
    public function getPrvNameEn()
    {
        return $this->prvNameEn;
    }

    /**
     * @return string
     */
    public function getPrvNameTh()
    {
        return $this->prvNameTh;
    }

    /**
     * @param string $prvCode
     * @return User
     */
    public function setPrvCode($prvCode)
    {
        $this->prvCode = $prvCode;
    }

    /**
     * @param string $prvNameEn
     * @return User
     */
    public function setPrvNameEn($prvNameEn)
    {
        $this->prvNameEn = $prvNameEn;
    }

    /**
     * @param string $prvNameTh
     *  @return User
     */
    public function setPrvNameTh($prvNameTh)
    {
        $this->prvNameTh = $prvNameTh;
    }

    /**********************************************************************************************
     *  G District
     ********************************************************************************************/
    /**
     * @var string
     */
    private  $disCode;

    /**
     * @var string
     *
     */

    private  $disNameTh;

    /**
     * @var string
     */

    private  $disNameEn;








    /**
     * @return string
     */
    public function getDisCode()
    {
        return $this->disCode;
    }

    /**
     * @return string
     */
    public function getDisNameEn()
    {
        return $this->disNameEn;
    }

    /**
     * @return string
     */
    public function getDisNameTh()
    {
        return $this->disNameTh;
    }

    /**
     * @return string
     */
    public function getFkPrvCode()
    {
        return $this->fkPrvCode;
    }





    /*
     * set
     */

    /**
     * @param string $disCode     *
     *  @return User
     */
    public function setDisCode($disCode)
    {
        $this->disCode = $disCode;
    }

    /**
     * @param string $disNameEn
     *    @return User
     */
    public function setDisNameEn($disNameEn)
    {
        $this->disNameEn = $disNameEn;
    }

    /**
     * @param string $disNameTh
     * @return User
     */
    public function setDisNameTh($disNameTh)
    {
        $this->disNameTh = $disNameTh;
    }

    /*
     * subdistrict Table
     */




    /**
     * @var string
     */

    private $subDisCode;

    /**
     * @var string
     */
    private $subDisNameTh;



    /**
     * @var string
     */
    private $subDisNameEn;



    /**
     * @var string
     */
    private $zipCode;















    /**
     * @return string
     */
    public function getSubDisCode()
    {
        return $this->subDisCode;
    }

    /**
     * @return string
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * @return string
     */
    public function getSubDisNameEn()
    {
        return $this->subDisNameEn;
    }


    /**
     * @return mixed
     */





    /**
     * @return string
     */
    public function getSubDisNameTh()
    {
        return $this->subDisNameTh;
    }

    /**
     * @param mixed $disCode
     */

    /**
     * @param string $subDisCode
     * @return User;
     */
    public function setSubDisCode($subDisCode)
    {
        $this->subDisCode = $subDisCode;
    }

    /**
     * @param string $subDisNameEn
     * @return User;
     */
    public function setSubDisNameEn($subDisNameEn)
    {
        $this->subDisNameEn = $subDisNameEn;
    }

    /**
     * @param string $zipCode
     * @return User;
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;
    }

    /**
     * @param string $subDisNameTh
     * @return User;
     */
    public function setSubDisNameTh($subDisNameTh)
    {
        $this->subDisNameTh = $subDisNameTh;
    }

    /**
     * @var string
     */
    private $telephoneNo;

    /**
     * @return string
     *
     */
    public function  getTelephoneNo(){
        return $this->telephoneNo;

    }

    /**
     * @param string $telephoneNo
     * @return User;
     */
    public function  setTelephoneNo($telephoneNo){
        return $this->telephoneNo=$telephoneNo;

    }


}
