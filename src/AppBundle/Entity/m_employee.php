<?php
/**
 * Created by PhpStorm.
 * User: arttit
 * Date: 30/3/2560
 * Time: 7:17 น.
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;




/**
 * M_Employee
 * @ORM\Entity(repositoryClass="AppBundle\Repository\m_employeeRepository")
 * @ORM\Table(name="M_Employee",
 *     uniqueConstraints={@ORM\UniqueConstraint(name="empCode_unique",columns={"empCode"})},
 *     indexes={@ORM\Index(name="empname_idx", columns={"name"})}
 * )
 * @ORM\HasLifecycleCallbacks()
 */
class m_employee
{




    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @ORM\ManyToOne(targetEntity="G_Company", inversedBy="employees")
     * @ORM\JoinColumn(name="cpnCode_id", referencedColumnName="cpnCode")
     */
    private $cpnCode;



    /**
     * @ORM\OneToOne(targetEntity="User")
     * @ORM\JoinColumn(name="fos_id", referencedColumnName="id")
     */
    private  $fos;


    /**
     * @var string
     * @ORM\Column(name="empCode", type="string", length=20,options={"fixed" = true})
     */

    private  $empCode;



     private $docYear;

    /**
     * @return mixed
     */




    public function getDocYear()
    {
        return $this->docYear;
    }

    /**
     * @param mixed $docYear
     */
    public function setDocYear($docYear)
    {
        $this->docYear = $docYear;
    }





    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;


    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    private $lastname;


    /**
     * @var string
     * @ORM\Column(name="address1", type="string", length=255, nullable=true)
     */

    private $address1;

    /**
     * @var string
     *
     * @ORM\Column(name="address2", type="string", length=255, nullable=true)
     */

    private $address2;




    /**
     * @var string
     * @ORM\Column(name="subDistrictNameTh", type="string", length=120,nullable=true)
     */
    private $subDistrictNameTh;


    /**
     * @var string
     * @ORM\Column(name="districtNameTh", type="string", length=120, nullable=true)
     */
    private $districtNameTh;

    /**
     * @var string
     * @ORM\Column(name="prvNameTh", type="string", length=120, nullable=true)
     */
    private $prvNameTh;


    /**
     * @var string
     * @ORM\Column(name="zipCode", type="string", length=10, nullable=true)
     */
    private $zipCode;


    /**
     * @var string
     * @ORM\Column(name="telephoneNo", type="string", length=15, nullable=true)
     */
    private $telephoneNo;

    /**
     * @return string
     */
    public function getTelephoneNo()
    {
        return $this->telephoneNo;
    }

    /**
     * @param string $telephoneNo
     */
    public function setTelephoneNo($telephoneNo)
    {
        $this->telephoneNo = $telephoneNo;
    }







    /**
     * @var dateTime
     *
     * @ORM\Column(name="created_at",type="datetime")
     */
    protected $created_at;

    /**
     * @var dateTime
     *
     * @ORM\Column(name="modified_at",type="datetime",nullable=true)
     */
    protected $modified_at;








    /**
     * @var \AppBundle\Entity\Test $testvalue
     */
    private  $testvalue;


    /**
     * @return \AppBundle\Entity\Test
     */
    public function getTestvalue()
    {
        return $this->testvalue;
    }



    /**
     * @param \AppBundle\Entity\Test $testvalue
     * @return  m_employee
     */
    public function setTestvalue(\AppBundle\Entity\Test  $testvalue)
    {
        $this->testvalue = $testvalue;
    }










    function __construct()
    {

      $this->updatedTimestamps();

     // $this->address1=new ArrayCollection();




    }
    public function __toString() {
        return (string)$this->name;
    }







    /**************************************************************
     * getter
     *************************************************************/




    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getEmpCode()
    {
        return $this->empCode;
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
    public function getDistrictNameTh()
    {
        return $this->districtNameTh;
    }

    /**
     * @return string
     */
    public function getSubDistrictNameTh()
    {
        return $this->subDistrictNameTh;
    }

    /**
     * @return string
     */
    public function getPrvNameTh()
    {
        return $this->prvNameTh;
    }



    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * @return string
     */
    public function getAddress2()
    {
        return $this->address2;
    }


    /**
     * @return string
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }






    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @return dateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @return dateTime
     */
    public function getModifiedAt()
    {
        return $this->modified_at;
    }









    /******************************************************************************************************
     * Setter
     ******************************************************************************************************/


    /**
     * @param string $cpnCode
     */
    public function setCpnCode($cpnCode)
    {
        $this->cpnCode = $cpnCode;
    }

    /**
     * @param string $empCode
     */
    public function setEmpCode($empCode)
    {
        $this->empCode = $empCode;

    }





    /**
     * Set name
     *
     * @param string $name
     *
     * @return m_employee
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param string $lastname
     *
     **@return m_employee
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }


    /**
     * @param string $address1
     *  @return m_employee
     */
    public function setAddress1($address1)
    {
        $this->address1 = $address1;
    }

    /**
     * @param string $address2
     *  **@return m_employee
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;
    }




    /**
     * @param string $districtNameTh
     */
    public function setDistrictNameTh($districtNameTh)
    {
        $this->districtNameTh = $districtNameTh;
    }

    /**
     * @param string $subDistrictNameTh
     */
    public function setSubDistrictNameTh($subDistrictNameTh)
    {
        $this->subDistrictNameTh = $subDistrictNameTh;
    }

    /**
     * @param string $prvNameTh
     */
    public function setPrvNameTh($prvNameTh)
    {
        $this->prvNameTh = $prvNameTh;
    }


    /**
     * @param string $zipCode
     * @return  m_employee
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;
    }


    /**
     * @param datetime $created_at
     * @return m_employee
     */
    public function setCreatedAt($created_at)
    {
        //$this->created_at = $created_at;
        if($this->getCreatedAt() == null)
        { $temp=new \DateTime(date('Y-m-d H:i:s'));
          $this->created_at =$temp;

        }

    }

    /**
     * @param datetime $modified_at
     *
     * @return m_employee
     */
    public function setModifiedAt($modified_at)
    {
        $temp=new \DateTime(date('Y-m-d H:i:s'));
        $this->modified_at =$temp;
    }








    /*
     * modified
     */

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps()
    {
         $this->setModifiedAt(new \DateTime(date('Y-m-d H:i:s')));

        if($this->getCreatedAt() == null)
        {
            $this->setCreatedAt(new \DateTime(date('Y-m-d H:i:s')));
        }else{


        }

    }

    /**
     *
     * @return integer
     */
    public function getFos()
    {
        return $this->fos;
    }

    /**
     * @param integer $fos
     *
     * @return m_employee
     */
    public function setFos($fos)
    {
        $this->fos = $fos;
    }



    /*
     * Fos variables
     *
     *
     */
    private  $username;

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }




    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }
    private  $email;

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }
    private $roles;

    /**
     * @return mixed
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param mixed $roles
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
    }
    private $enabled;

    /**
     * @return mixed
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * @param mixed $enabled
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }
    private  $prvCode;

    /**
     * @return mixed
     */
    public function getPrvCode()
    {
        return $this->prvCode;
    }

    /**
     * @param mixed $prvCode
     */
    public function setPrvCode($prvCode)
    {
        $this->prvCode = $prvCode;
    }
    private  $disCode;

    /**
     * @return mixed
     */
    public function getDisCode()
    {
        return $this->disCode;
    }

    /**
     * @param mixed $disCode
     */
    public function setDisCode($disCode)
    {
        $this->disCode = $disCode;
    }
    private  $subDisCode;

    /**
     * @return mixed
     */
    public function getSubDisCode()
    {
        return $this->subDisCode;
    }

    /**
     * @param mixed $subDisCode
     */
    public function setSubDisCode($subDisCode)
    {
        $this->subDisCode = $subDisCode;
    }
    private $password;

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }






}

