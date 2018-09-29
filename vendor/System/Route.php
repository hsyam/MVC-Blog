<?php
/**
 * Created by PhpStorm.
 * User: hassan
 * Date: 9/29/18
 * Time: 2:34 PM
 */

namespace System;


class Route
{
    private $app ;
    private $routes = [];
    private $notFound ;
    public function __construct(Application $app){
        $this->app = $app;

    }


    public function add($url , $action , $requestMethod = 'GET'){
        $route = [
            'url'       => $url,
            'pattern'   => $this->generatePattern($url),
            'action'    => $this->getAction($action),
            'method'    => strtoupper($requestMethod),
        ];
        $this->routes[] = $route ;
    }

    public function notFound($url){
        $this->notFound = $url;
    }

    private function generatePattern($url){
        $pattern = '#^' ;
        $pattern .= str_replace([':text' , ':id'] ,['([a-zA-z-0-9-]+)' , '(\d+)'] , $url) ;
        $pattern .= '$#';
        return $pattern;
    }

    private function getAction($action){
        $action = str_replace('/' , '\\', $action);

        return strpos($action , '@') !== false ? $action : $action . '@index' ;
    }

    public function getProperRoute(){
        foreach ($this->routes as $route) {
            if ($this->isMatching($route['pattern'])){
                $argumetns = $this->getArgumentFrom($route['pattern']);
                list($controller , $method) = explode('@' , $route['action']);
                return [$controller , $method , $argumetns];
            }
        }
    }


    private function isMatching($pattern){
        return preg_match($pattern , $this->app->request->url());
    }

    private function getArgumentFrom($pattern){
        preg_match($pattern , $this->app->request->url() , $matches) ;
        array_shift($matches);
        return $matches;
    }

}