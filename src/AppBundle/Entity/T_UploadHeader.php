<?php
/**
 * Created by PhpStorm.
 * User: arttit
 * Date: 22/4/2560
 * Time: 9:32 น.
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\T_UploadHeaderRepository")
 * @ORM\Table(name="T_UploadHeader",
 *     uniqueConstraints={@ORM\UniqueConstraint(name="docCode_unique",columns={"docCode"})}
 * )
 */

class T_UploadHeader
{



    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var dateTime
     * @ORM\Column(name="docCode", type="string", length=30)
     */
    private  $docCode;

    /**
     * @ORM\Column(name="docYear",  type="integer")
     */
    private $docYear;

    /**
     * @var string
     * @ORM\Column(name="uploadBy", type="string", length=30)
     */
    private  $uploadBy;



    /**
     * @var dateTime
     * @ORM\Column(name="uploadTime",type="datetime")
     */
    protected $uploadTime;

    /**
     * @var string
     * @ORM\Column(name="uploadLocation", type="string", length=255)
     * @Assert\NotBlank(message="Please, upload  zip file.")
     * @Assert\File(maxSize = "1024Mi",mimeTypes={ "application/zip" })
     */
    private  $uploadLocation;

    /**
     * @var string
     * @ORM\Column(name="unzipUploadLocation", type="string", length=255)
     */


    private $unzipUploadLoaction;




    /**
     *@ORM\OneToMany(targetEntity="T_UploadDetail", mappedBy="header")
     */
    private $detailIds;










    /**
     * @ORM\ManyToOne(targetEntity="G_Company", inversedBy="tUploadHeaders")
     * @ORM\JoinColumn(name="cpnCode_id", referencedColumnName="cpnCode")
     */
    private  $cpnCode;



    /**
     * @var integer
     * @ORM\Column(name="sumItems", type="integer")
     */
    private  $sumItems;

    /**
     * @var integer
     * @ORM\Column(name="sumAccounts", type="integer")
     */
    private  $sumAccounts;











    /**
     * @return mixed
     */
    public function getDetailIds()
    {
        return $this->detailIds;
    }

    /**
     * @param mixed $detailIds
     */
    public function setDetailIds($detailIds)
    {
        $this->detailIds = $detailIds;
    }


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getDocCode()
    {
        return $this->docCode;
    }




    /**
     * @return string
     */
    public function getUploadLocation()
    {
        return $this->uploadLocation;
    }


    /**
     *
     * @param string $uploadLocation
     */
    public function setUploadLocation($uploadLocation)
    {
        $this->uploadLocation = $uploadLocation;
    }



    /**
     * @param mixed $docCode
     */
    public function setDocCode($docCode)
    {
        $this->docCode = $docCode;
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
    public function getSumItems()
    {
        return $this->sumItems;
    }

    /**
     * @return int
     */
    public function getSumAccounts()
    {
        return $this->sumAccounts;
    }

    /**
     * @return mixed
     */
    public function getDocYear()
    {
        return $this->docYear;
    }

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

    /**
     * @return mixed
     */
    public function getUnzipUploadLoaction()
    {
        return $this->unzipUploadLoaction;
    }

    /**
     * @param mixed $unzipUploadLoaction
     */
    public function setUnzipUploadLoaction($unzipUploadLoaction)
    {
        $this->unzipUploadLoaction = $unzipUploadLoaction;
    }

    /**
     * @return mixed
     */
    public function getCpnCode()
    {
        return $this->cpnCode;
    }

    /**
     * @param mixed $cpnCode
     */
    public function setCpnCode($cpnCode)
    {
        $this->cpnCode = $cpnCode;
    }

    /**
     * @param mixed $sumItems
     */
    public function setSumItems($sumItems)
    {
        $this->sumItems = $sumItems;
    }

    /**
     * @param int $sumAccounts
     */
    public function setSumAccounts($sumAccounts)
    {
        $this->sumAccounts = $sumAccounts;
    }


}