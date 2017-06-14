<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * G_Company
 *
 * @ORM\Table(name="G_Company")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\G_CompanyRepository")
 */
class G_Company
{





    /**
     * @var string
     * @ORM\Id
     * @ORM\Column(name="cpnCode", type="string", length=10)
     */
    private $cpnCode;



    /*
     * @ORM\OneToMany(targetEntity="M_Department", mappedBy="departmentCode")
     */
    private  $g_company_department;

    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="cpnCode")
     */
    private  $users;

    /**
     * @return string
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param string $users
     */
    public function setUsers($users)
    {
        $this->users = $users;
    }


    /**
     * @ORM\OneToMany(targetEntity="m_employee", mappedBy="cpnCode")
     */
    private  $employees;

    /**
     * @return string
     */
    public function getEmployees()
    {
        return $this->employees;
    }

    /**
     * @param string $users
     */
    public function setEmployees($employees)
    {
        $this->employees = $employees;
    }



    /**
     * @ORM\OneToMany(targetEntity="T_UploadHeader", mappedBy="cpnCode")
     */
    private  $tUploadHeaders;

    /**
     * @return mixed
     */
    public function getTUploadHeaders()
    {
        return $this->tUploadHeaders;
    }

    /**
     * @param mixed $tUploadHeaders
     */
    public function setTUploadHeaders($tUploadHeaders)
    {
        $this->tUploadHeaders = $tUploadHeaders;
    }








    /**
     * @var string
     * @ORM\Column(name="cpnCodeDesc", type="string", length=120)
     */
    private $cpnCodeDesc;


    /**
     * @var dateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $created_at;




    public function __construct()
    {
        $this->employees = new ArrayCollection();
        $this->g_company_department=new ArrayCollection();
        $this->users=new ArrayCollection();
        $this->setCreatedAt();
    }



    /*
     * getter
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
    public function getCpnCodeDesc()
    {
        return $this->cpnCodeDesc;
    }

    /**
     * @return dateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }


    /**
     * setter
     *
     */

    public function __toString()
    {
        return (string)$this->getCpnCode();
    }



    /**
     * @param string $cpnCode
     *
     * @return G_Company
     */
    public function setCpnCode($cpnCode)
    {
        $this->cpnCode = $cpnCode;
    }


    /**
     * @param string $cpnCodeDesc
     *
     * @return  G_Company
     */
    public function setCpnCodeDesc($cpnCodeDesc)
    {
        $this->cpnCodeDesc = $cpnCodeDesc;
    }

    /**
     * @param dateTime $created_at
     */
    public function setCreatedAt()
    {
        if($this->getCreatedAt() == null)
        { $temp=new \DateTime(date('Y-m-d H:i:s'));
            $this->created_at =$temp;

        }
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
        }
    }








}




