<?php
/**
 * Created by PhpStorm.
 * User: arttit
 * Date: 18/4/2560
 * Time: 12:14 น.
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;


/**
 * G_Company
 * @ORM\Entity(repositoryClass="AppBundle\Repository\G_SubdistrictRepository")
 * @ORM\Table(name="G_Subdistrict",
 *     uniqueConstraints={@ORM\UniqueConstraint(name="subDisCode_unique",columns={"subDisCode"})},
 *
 * )
 *
 */
class G_Subdistrict
{


    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="subDisCode", type="string",length=10, options={"fixed" = true})
     */

    private $subDisCode;

    /**
     * @var string
     * @ORM\Column(name="subDisNameTh", type="string",length=120)
     */
    private $subDisNameTh;



    /**
     * @var string
     * @ORM\Column(name="subDisNameEn", type="string",length=120)
     */
    private $subDisNameEn;



    /**
     * @var string
     * @ORM\Column(name="zipCode", type="string",length=10,options={"fixed" = true})
     */
    private $zipCode;



    /**
     * @ORM\ManyToOne(targetEntity="G_District", inversedBy="subDisCode")
     * @ORM\JoinColumn(name="disCode_id", referencedColumnName="disCode")
     */
    private $disCode;



    /**
     * @ORM\ManyToOne(targetEntity="G_Province", inversedBy="subDisCode")
     * @ORM\JoinColumn(name="prvCode_id", referencedColumnName="prvCode")
     */
    private $prvCode;





    function __toString()
    {
        return (string)$this->subDisNameTh;
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
    public function getDisCode()
    {
        return $this->disCode;
    }

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
    public function getPrvCode()
    {
        return $this->prvCode;
    }




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
    public function setDisCode($disCode)
    {
        $this->disCode = $disCode;
    }

    /**
     * @param string $subDisCode
     */
    public function setSubDisCode($subDisCode)
    {
        $this->subDisCode = $subDisCode;
    }

    /**
     * @param string $subDisNameEn
     */
    public function setSubDisNameEn($subDisNameEn)
    {
        $this->subDisNameEn = $subDisNameEn;
    }

    /**
     * @param string $zipCode
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;
    }

    /**
     * @param string $subDisNameTh
     */
    public function setSubDisNameTh($subDisNameTh)
    {
        $this->subDisNameTh = $subDisNameTh;
    }

    /**
     * @param mixed $prvCode
     */
    public function setPrvCode($prvCode)
    {
        $this->prvCode = $prvCode;
    }



    /*
     * mapping
     */








}