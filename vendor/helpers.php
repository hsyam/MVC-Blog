<?php
/**
 * Created by PhpStorm.
 * User: hassan
 * Date: 9/24/18
 * Time: 5:42 PM
 */

if(!function_exists('pre')){

    function pre($var){
        echo "<pre>";
        print_r($var);
        echo "</pre>";
    }
}


if(!function_exists('array_get')){

    function array_get($array , $key , $default = null){
        return isset($array[$key]) ? $array[$key] : $default;
    }
}