<?php
/**
 * Created by PhpStorm.
 * User: arttit
 * Date: 23/4/2560
 * Time: 12:01 น.
 */

namespace AppBundle\GVal;


class DocCodeGenerator
{
    private  $docCode;
    function __construct($type,$year,$month,$date,$index)
    {

        $this->docCode= $type.$year.$month.$date.sprintf('%03d',$index);
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



}