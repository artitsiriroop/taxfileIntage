<?php
/**
 * Created by PhpStorm.
 * User: arttit
 * Date: 25/4/2560
 * Time: 20:50 น.
 */

namespace AppBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\T_UploadDocDetailRepository")
 * @ORM\Table(name="T_UploadDocDetail")
 */

class T_UploadDocDetail
{

    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @ORM\ManyToOne(targetEntity="T_UploadHeader", inversedBy="detailIds")
     * @ORM\JoinColumn(name="header_id", referencedColumnName="id",onDelete="CASCADE")
     */
    private  $header;


    /**
     * @var dateTime
     * @ORM\Column(name="docCode", type="string", length=30)
     */
    private  $docCode;


    /**
     * @var string
     * @ORM\Column(name="userName", type="string", length=20,options={"fixed" = true})
     */

    private  $userName;



    /**
     * @var integer
     * @ORM\Column(name="sumItems", type="integer")
     */
    private  $sumItems;




    /**
     * @ORM\ManyToOne(targetEntity="G_Company", inversedBy="tUploadHeaders")
     * @ORM\JoinColumn(name="cpnCode_id", referencedColumnName="cpnCode")
     */
    private  $cpnCode;



    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return integer
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * @param integer $header
     */
    public function setHeader($header)
    {
        $this->header = $header;
    }

    public function __construct() {
        $this->header = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getDocCode()
    {
        return $this->docCode;
    }

    /**
     * @param string $docCode
     */
    public function setDocCode($docCode)
    {
        $this->docCode = $docCode;
    }

    /**
     * @return string
     */
    public function getCpnCode()
    {
        return $this->cpnCode;
    }

    /**
     * @param string $cpnCode
     */
    public function setCpnCode($cpnCode)
    {
        $this->cpnCode = $cpnCode;
    }

    /**
     * @return integer
     */
    public function getSumItems()
    {
        return $this->sumItems;
    }

    /**
     * @param integer $sumItems
     */
    public function setSumItems($sumItems)
    {
        $this->sumItems = $sumItems;
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

}