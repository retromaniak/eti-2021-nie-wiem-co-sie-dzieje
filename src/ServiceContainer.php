<?php

namespace App;

use App\Controllers\PageController;
use App\Controllers\SimpleController;

class ServiceContainer
{
    private static $instance;

    private $services;

    private function __construct()
    {
        $this->services['router'] = function() {
            return new Router(
                [
                    'homepage' => [
                        'path'=>'/',
                        //'page'=>'home'
                        'controller'=> function() {
                    return new PageController('home','default');
                }
                    ],
                    'article' => [
                        'path'=>'/article/{id}',
                        'controller'=> function() {
                            return new PageController('article','default');
                }

                    ],
                    'body' => [
                        'path'=>'/body',
                        'controller'=> function() {
                    return new PageController('body','default');
                }

                    ],
                    'responseTest' => [
                        'path'=>'/jsonTest',
                        'controller' => function() {
                    return new SimpleController();
                }

                    ]
                ]
            );
        };

    }

    /**
     * @return ServiceContainer
     */
    public static function  getInstance(): ServiceContainer
    {
        if(!isset(self::$instance)){
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @param string $id
     * @return mixed
     * @throws \Exception
     */
    public function getService(string $id)
    {
        if(!$this->has($id)){
            throw new \Exception(sprintf('Selected service %s was not found',$id));
        }

        return $this->services[$id]($this);
    }

    /**
     * @param string $id
     * @return bool
     */
    public function has(string $id)
    {
        return isset($this->services[$id]);
    }
}