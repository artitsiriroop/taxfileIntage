<?php
/**
 * Created by PhpStorm.
 * User: arttit
 * Date: 18/4/2560
 * Time: 11:19 น.
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\G_DistrictRepository")
 * @ORM\Table(name="G_District",
 *     uniqueConstraints={@ORM\UniqueConstraint(name="disCode_unique",columns={"disCode"})},
 *
 * )
 *
 */

class G_District
{

    private $id;

    /**
     * @var string
     * @ORM\Id
     * @ORM\OneToMany(targetEntity="G_Subdistrict", mappedBy="disCode")
     * @ORM\Column(name="disCode", type="string",length=5, options={"fixed" = true})
     */
    private  $disCode;

    /**
     * @var string
     * @ORM\Column(name="disNameTh", type="string",length=120)
     */

    private  $disNameTh;

    /**
     * @var string
     * @ORM\Column(name="disNameEn", type="string",length=120)
     */

    private  $disNameEn;



    /**
     * @ORM\ManyToOne(targetEntity="G_Province", inversedBy="disCodes")
     * @ORM\JoinColumn(name="prvCode_id", referencedColumnName="prvCode")
     */
    private  $prvCode;


    function __toString()
    {
        return (string)$this->disNameTh;
    }


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
    public function getPrvCode()
    {
        return $this->prvCode;
    }




    /*
     * set
     */

    /**
     * @param string $disCode
     */
    public function setDisCode($disCode)
    {
        $this->disCode = $disCode;
    }

    /**
     * @param string $disNameEn
     */
    public function setDisNameEn($disNameEn)
    {
        $this->disNameEn = $disNameEn;
    }

    /**
     * @param string $disNameTh
     */
    public function setDisNameTh($disNameTh)
    {
        $this->disNameTh = $disNameTh;
    }

    /**
     * @param string $prvCode
     */
    public function setPrvCode($prvCode)
    {
        $this->prvCode = $prvCode;
    }



    /*
     * mapping
     */

    /**
     *@ORM\OneToMany(targetEntity="G_SubDistrict", mappedBy="disCode")
     */
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

}