<?php

namespace AppBundle\GVal;
/**
 * Created by PhpStorm.
 * User: arttit
 * Date: 30/3/2560
 * Time: 11:40 น.
 */
class  variables{
    public static $empCodeText="รหัสพนักงาน";
    public  static $firstnameText="ชื่อ";
    public  static $lastnameText="นามสกุล";

    public static $cpnCodeText="รหัส";
    public  static $cpnCodeDescText="ชื่อบริษัท";





    public static function getempCodeText() {
       return  self::$empCodeText;

    }

    /**
     * @return string
     */
    public static function getFirstnameText()
    {
        return self::$firstnameText;
    }

    /**
     * @return string
     */
    public static function getLastnameText()
    {
        return self::$lastnameText;
    }

    /**
     * @return string
     */
    public static function getCpnCodeDescText()
    {
        return self::$cpnCodeDescText;
    }

    /**
     * @return string
     */
    public static function getCpnCodeText()
    {
        return self::$cpnCodeText;
    }


}