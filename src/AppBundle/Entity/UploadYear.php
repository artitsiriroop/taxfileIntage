<?php
/**
 * Created by PhpStorm.
 * User: arttit
 * Date: 20/4/2560
 * Time: 20:41 น.
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;


/**
 * M_Employee
 * @ORM\Entity(repositoryClass="AppBundle\Repository\m_employeeRepository")
 * @ORM\Table(name="G_Docyear")
 * @ORM\HasLifecycleCallbacks()
 */
class UploadYear
{
    /**
     * @var int
     * @ORM\Column(name="uploadYear", type="integer")
     * @ORM\Id
     */
    private  $uploadYear;

    /**
     * @return int
     */
    public function getUploadYear()
    {
        return $this->uploadYear;
    }

    /**
     * @param int $uploadYear
     */
    public function setUploadYear($uploadYear)
    {
        $this->uploadYear = $uploadYear;
    }

}