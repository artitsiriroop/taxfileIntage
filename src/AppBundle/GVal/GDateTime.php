<?php
/**
 * Created by PhpStorm.
 * User: arttit
 * Date: 17/4/2560
 * Time: 17:09 น.
 */

namespace AppBundle\GVal;


class GDateTime
{
    private $nowDateFormat;
    function __construct()
    {
        $nowDate=new \DateTime();
        $nowDateFormat=$nowDate->format('Y-m-d H:i:s');
        $this->nowDateFormat= $nowDateFormat;
    }
    public function getDateTime()
    {
        return $this->nowDateFormat;

    }
    public function getYear()
    {
        $nowDate=new \DateTime();
        $nowDateFormat=$nowDate->format('Y');
        return $nowDateFormat;

    }
    public function getMonth()
    {
        $nowDate=new \DateTime();
        $nowDateFormat=$nowDate->format('m');
        return $nowDateFormat;

    }
    public function getDate()
    {
        $nowDate=new \DateTime();
        $nowDateFormat=$nowDate->format('d');
        return $nowDateFormat;

    }

}