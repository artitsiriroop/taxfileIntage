<?php
/**
 * Created by PhpStorm.
 * User: arttit
 * Date: 8/4/2560
 * Time: 18:32 น.
 */

namespace AppBundle\Entity;


class Video
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;
    /**
     * @var string
     *
     * @ORM\Column(name="info", type="text")
     */
    private $info;

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
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param string $info
     */
    public function setInfo($info)
    {
        $this->info = $info;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

}