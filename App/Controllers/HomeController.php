<?php
/**
 * Created by PhpStorm.
 * User: hassan
 * Date: 9/29/18
 * Time: 5:38 PM
 */

namespace App\Controllers;


use System\Controller;

class HomeController extends Controller
{
    public function index(){
       echo $this->request->url();
    }
}