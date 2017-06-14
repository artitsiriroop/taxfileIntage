<?php
/**
 * Created by PhpStorm.
 * User: arttit
 * Date: 16/4/2560
 * Time: 7:10 น.
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * M_Employee
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TestRepository")
 * @ORM\Table(name="Test")
 */
class Test
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */

    private  $id;

    /**
     * @var string
     * @ORM\Column(name="testvalue", type="string", length=255)
     */
    private $testvalue;


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
    public function getTestvalue()
    {
        return $this->testvalue;
    }

    /**
     * @param string $testvalue
     */
    public function setTestvalue($testvalue)
    {
        $this->testvalue = $testvalue;
    }


    public function __toString() {
        return (string)$this->testvalue;
    }



}