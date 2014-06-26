<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * libs
 */
class libs
{

    public static function HardCheckQuery($query)
    {
        if (is_array($query)) {
            foreach ($query as $value) {
                if (is_string($value)) {
                    $value = trim($value);
                    $value = stripslashes($value);
                    $value = strip_tags($value);
                    $value = htmlspecialchars($value);
                } elseif (is_array($value)) {
                    foreach ($value as $val) {
                        if (is_string($val)) {
                            $val = trim($val);
                            $val = stripslashes($val);
                            $val = strip_tags($val);
                            $val = htmlspecialchars($val);
                        }
                    }
                }
            }
        } else {
            $query = trim($query);
            $query = stripslashes($query);
            $query = strip_tags($query);
            $query = htmlspecialchars($query);
        }
        return $query;
    }

    public static function HardSQL($query)
    {
//         if(is_array($query)){
//            foreach ($query as $value) {
//                if(is_string($value)){
//                    $value = strip_tags($value);
//                    $value = mysql_real_escape_string(trim($value));
//                }elseif(is_array($value)){
//                     foreach ($value as $val) {
//                         if(is_string($val)){
//                            $val = strip_tags($val);
//                            $val = mysql_real_escape_string(trim($val));
//                         }
//                     }
//                }
//            }
//        }else{
//            $query = strip_tags($query);
//            $query = mysql_real_escape_string(trim($query));
//        }
        return $query;
    }

    public static function generateCode($length = NULL)
    {
        if ($length == NULL)
            $length = 8;
        $symbols = '0123456789qwertHPTOEyuiopSDGEasdfghjklzxcvbnm';

        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $key = rand(0, strlen($symbols) - 1);
            $string .= $symbols[$key];
        }
        return $string;
    }

    public static function generateNumber($length = NULL)
    {
        if ($length == NULL)
            $length = 8;

        $symbols = '0123456789';

        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $key = rand(0, strlen($symbols) - 1);
            $string .= $symbols[$key];
        }
        if (!ORM::factory('User')->where('username', '=', $string)->find()->loaded())
            return $string;
        else
            func::generatelogin();
    }

    public static function GetIp()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
    /*
     * $array = array(__("пользователь"), __("пользователя"), __("пользователей"));
     * functions::getWord($chell_cout, $array)
     */

    public static function getWord($number, $suffix)
    {
        $keys = array(2, 0, 1, 1, 1, 2);
        $mod = $number % 100;
        $suffix_key = ($mod > 7 && $mod < 20) ? 2 : $keys[min($mod % 10, 5)];
        return $suffix[$suffix_key];
    }
}
