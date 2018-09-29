<?php
/**
 * Created by PhpStorm.
 * User: hassan
 * Date: 9/29/18
 * Time: 3:21 PM
 */

use  System\Application;

$app = Application::getInstance() ;

$app->route->add('/' , 'Home');
$app->route->add('/post/:text/:id' , 'Post/Post');


$app->route->add('/404' , 'Error/NotFound');

$app->route->notFound('/404') ;
