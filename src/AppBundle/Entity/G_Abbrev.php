<?php
/**
 * Created by PhpStorm.
 * User: arttit
 * Date: 22/4/2560
 * Time: 8:54 น.
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * G_Company
 *
 * @ORM\Table(name="G_Abbrev")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\G_AbbrevRepository")
 */

class G_Abbrev
{

    /**
     * @var string
     * @ORM\Id
     * @ORM\Column(name="code", type="string",length=10, options={"fixed" = true})
     */
    private  $code;

    /**
     * @var string
     * @ORM\Id
     * @ORM\Column(name="desc", type="string",length=30)
     */
    private  $desc;

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getDesc()
    {
        return $this->desc;
    }

    /**
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @param string $desc
     */
    public function setDesc($desc)
    {
        $this->desc = $desc;
    }


}