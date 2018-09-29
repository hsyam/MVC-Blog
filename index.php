<?php
/**
 * Created by PhpStorm.
 * User: hassan
 * Date: 9/24/18
 * Time: 4:38 PM
 */

require  __DIR__ . '/vendor/System/Application.php';
require  __DIR__ . '/vendor/System/File.php';

use System\File;
use System\Application;


$file = new File(__DIR__);
$app = Application::getInstance($file);
$app->run();