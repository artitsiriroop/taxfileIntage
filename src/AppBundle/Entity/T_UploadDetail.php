<?php
/**
 * Created by PhpStorm.
 * User: arttit
 * Date: 22/4/2560
 * Time: 9:33 น.
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use  Doctrine\Common\Collections\ArrayCollection;
/**
 *  @ORM\Table(name="T_UploadDetail")
 *  @ORM\Entity(repositoryClass="AppBundle\Repository\T_UploadDetailRepository")
 */

class T_UploadDetail
{

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }



    /**
     * @ORM\ManyToOne(targetEntity="T_UploadHeader", inversedBy="detailIds")
     * @ORM\JoinColumn(name="header_id", referencedColumnName="id",onDelete="CASCADE")
     */
    private  $header;

    /**
     * @var string
     * @ORM\Column(name="userName", type="string", length=20,options={"fixed" = true})
     */

    private  $userName;



    /**
     * @var string
     * @ORM\Column(name="filName", type="string", length=45,nullable=true)
     */

    private  $filName;





    /**
     * @var string
     * @ORM\Column(name="uploadLocation", type="string", length=255,nullable=true)
     */

    private  $uploadLocation;



    public function __construct() {
        $this->header = new ArrayCollection();
    }




    /**
     * @return integer
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * @var integer
     * @param string integer
     */
    public function setHeader($header)
    {
        $this->header = $header;
    }

    /**
     * @return string
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param string $userName
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    /**
     * @return string
     */
    public function getUploadLocation()
    {
        return $this->uploadLocation;
    }

    /**
     * @param string $uploadLocation
     */
    public function setUploadLocation($uploadLocation)
    {
        $this->uploadLocation = $uploadLocation;
    }

    /**
     * @return string
     */
    public function getFilName()
    {
        return $this->filName;
    }

    /**
     * @param string $filName
     */
    public function setFilName($filName)
    {
        $this->filName = $filName;
    }



}