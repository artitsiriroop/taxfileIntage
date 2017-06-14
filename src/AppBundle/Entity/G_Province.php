<?php
/**
 * Created by PhpStorm.
 * User: arttit
 * Date: 18/4/2560
 * Time: 11:18 น.
 */

namespace AppBundle\Entity;
namespace AppBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * G_Company
 * @ORM\Entity(repositoryClass="AppBundle\Repository\G_ProvinceRepository")
 * @ORM\Table(name="G_Province",
 *     uniqueConstraints={@ORM\UniqueConstraint(name="prvCode_unique",columns={"prvCode"})},
 *
 * )
 *
 */
class G_Province
{

    private $id;


    /**
     * @var string
     * @ORM\Id
     * @ORM\Column(name="prvCode", type="string",length=5, options={"fixed" = true})
     *
     */

    private $prvCode;



    /**
     * @var string
     * @ORM\Column(name="prvNameTh", type="string",length=120)
     */
    private $prvNameTh;

    /**
     * @var string
     * @ORM\Column(name="prvNameEn", type="string",length=120)
     */
    private $prvNameEn;


    /**
     *@ORM\OneToMany(targetEntity="G_District", mappedBy="prvCode")
     */

    private  $disCodes;

    /**
     * @return mixed
     */
    public function getDiscodes()
    {
        return $this->discodes;
    }

    /**
     * @param string $discode
     */
    public function setDiscodes($disCodes)
    {
        $this->discodes = $disCodes;
    }

    /**
     *@ORM\OneToMany(targetEntity="G_SubDistrict", mappedBy="prvCode")
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





    /*********************
     * G_Province constructor.
     */




    function __construct()
    {
        $this->discode = new ArrayCollection();
    }

    function __toString()
    {
        return (string)$this->prvNameTh;
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
     */
    public function setPrvCode($prvCode)
    {
        $this->prvCode = $prvCode;
    }

    /**
     * @param string $prvNameEn
     */
    public function setPrvNameEn($prvNameEn)
    {
        $this->prvNameEn = $prvNameEn;
    }

    /**
     * @param string $prvNameTh
     */
    public function setPrvNameTh($prvNameTh)
    {
        $this->prvNameTh = $prvNameTh;
    }



}