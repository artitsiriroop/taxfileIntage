<?php
/**
 * Created by PhpStorm.
 * User: arttit
 * Date: 20/4/2560
 * Time: 15:50 น.
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * M_Employee
 * @ORM\Entity(repositoryClass="AppBundle\Repository\T_UploadRepository")
 * @ORM\Table(name="T_Upload",
 *  *     uniqueConstraints={@ORM\UniqueConstraint(name="docYearEmp_unique",columns={"docYearEmp"})},
 *        indexes={@ORM\Index(name="docYear_idx", columns={"docYear"}),
 *              @ORM\Index(name="empCode_idx", columns={"empCode"})
 * }
 *     )
 */

class T_Upload
{

    /**
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank(message="Please, upload the product brochure as a PDF file.")
     * @Assert\File(mimeTypes={ "application/zip" })
     */
    private $brochure;

    public function getBrochure()
    {
        return $this->brochure;
    }

    public function setBrochure($brochure)
    {
        $this->brochure = $brochure;

        return $this;
    }




    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;



    /**
     * @ORM\Column(name="docYearEmp", type="string",length=50,nullable=true)
     */
    private $docYearEmp;



    /**
     * @ORM\Column(name="docYear",  type="integer",nullable=true)
     */
    private $docYear;



    /**
     * @ORM\Column(name="empCode", type="string",length=30,nullable=true)
     */
    private  $empCodes;




    /**
     * @ORM\Column(name="fileName", type="string",length=30,nullable=true)
     */
    private  $fileName;





    /**
     * @var string
     * @ORM\Column(name="uploadLocation", type="string", length=450,nullable=true)
     */
    private $uploadLocation;




    /**
     * @var string
     * @ORM\Column(name="uploadLoadBy", type="string", length=30,nullable=true)
     */
    private  $uploadBy;

    /**
     * @var dateTime
     * @ORM\Column(name="uploadTime",type="datetime",nullable=true)
     */
    protected $uploadTime;




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
    public function getUploadLocation()
    {
        return $this->uploadLocation;
    }


    /**
     * @param mixed $uploadLocation
     */
    public function setUploadLocation($uploadLocation)
    {
        $this->uploadLocation = $uploadLocation;
    }



    /**
     * @return mixed
     */
    public function getDocYearEmp()
    {
        return $this->docYearEmp;
    }

    /**
     * @param mixed $docYearEmp
     */
    public function setDocYearEmp($docYearEmp)
    {
        $this->docYearEmp = $docYearEmp;
    }

    /**
     * @return mixed
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * @param mixed $docYear
     */
    public function setDocYear($docYear)
    {
        $this->docYear = $docYear;
    }

    /**
     * @return mixed
     */
    public function getDocYear()
    {
        return $this->docYear;
    }

    /**
     * @return mixed
     */
    public function getEmpCodes()
    {
        return $this->empCodes;
    }

    /**
     * @param mixed $fileName
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }

    /**
     * @param mixed $empCodes
     */
    public function setEmpCodes($empCodes)
    {
        $this->empCodes = $empCodes;
    }

    /**
     * @return string
     */
    public function getUploadBy()
    {
        return $this->uploadBy;
    }

    /**
     * @param string $uploadBy
     */
    public function setUploadBy($uploadBy)
    {
        $this->uploadBy = $uploadBy;
    }

    /**
     * @return dateTime
     */
    public function getUploadTime()
    {
        return $this->uploadTime;
    }

    /**
     * @param dateTime $uploadTime
     */
    public function setUploadTime($uploadTime)
    {
        $this->uploadTime = $uploadTime;
    }

}