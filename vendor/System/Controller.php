<?php
/**
 * Created by PhpStorm.
 * User: hassan
 * Date: 9/29/18
 * Time: 5:45 PM
 */

namespace System;


abstract class Controller
{

    private $app ;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function __get($key)
    {
        return $this->app->get($key);
    }

}