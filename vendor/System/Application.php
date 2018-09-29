<?php
/**
 * Created by PhpStorm.
 * User: hassan
 * Date: 9/24/18
 * Time: 4:52 PM
 */

namespace System ;

class Application {

    private $container = [] ;

    private static $instance ;

    private function __construct(File $file)
    {
        $this->share('file' , $file);
        $this->registerClasses();
        $this->loadHelpers();

    }

    public function registerClasses(){
        spl_autoload_register([$this, 'load']);
    }

    public function load($class){
        if(strpos($class, 'App') === 0 ){
            $file = $class . '.php';
        }else{
            $file = 'vendor/' . $class .'.php';
        }
        if($this->file->exists($file)){
            $this->file->call($file);
        }

    }


    public function run(){

        $this->session->start();
        $this->request->prepareUrl();
        $this->file->call('App/index.php');
        list($controller , $method , $arguments) = $this->route->getProperRoute();

        $this->load->action($controller , $method , $arguments);
    }

    public static function getInstance($file = null){
        if (is_null(static::$instance)){
            static::$instance = new self($file) ;
        }
        return static::$instance ;
    }


    public function share($key , $value){
        $this->container[$key] =  $value;
    }

    public function get($key){

        if (! $this->isShering($key)){
            if ($this->isCoreAlies($key)){
                $this->share($key , $this->createNewCoreObject($key));
            }else{
                die('<b>' . $key . '</b> Not found') ;
            }
        }
        return   $this->container[$key];
    }

    private function isCoreAlies($alies){
        $coreClass = $this->coreClasses();
        return isset($coreClass[$alies]);
    }

    private function createNewCoreObject($key){
        $coreClass = $this->coreClasses();
        $object = $coreClass[$key];
        return new $object($this);
    }

    public function isShering($key){
        return isset($this->container[$key]);

    }



    public function __get($key)
    {
        return $this->get($key);
    }

    public function loadHelpers(){
        $this->file->call('vendor/helpers.php');
    }


    public function coreClasses(){
        return [
            'request'       => 'System\\Http\\Request',
            'response'      => 'System\\Http\\Response',
            'session'       => 'System\\Session',
            'route'         => 'System\\Route',
            'cookie'        => 'System\\Cookie',
            'load'          => 'System\\Loader',
            'html'          => 'System\\Html',
            'db'            => 'System\\Database',
            'view'          => 'System\\View\\ViewFactory',

        ];
    }


}