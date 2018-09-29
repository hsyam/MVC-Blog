<?php
/**
 * Created by PhpStorm.
 * User: hassan
 * Date: 9/24/18
 * Time: 4:52 PM
 */

namespace System;
class File{

    const DS = DIRECTORY_SEPARATOR;
    private $root;
    public function __construct($root)
    {
        $this->root = $root;
    }

    public function exists($file){
        return file_exists($this->to($file));
    }

    public function call($file){
         require $this->to($file);
    }

    public function toVendor($path){
        return $this->to('vendor/'. $path);
    }

    public function to($path){
        return $this->root . static::DS . str_replace(['/','\\'] , static::DS , $path)   ;


    }

}