<?php
/**
 * Created by PhpStorm.
 * User: abdujabbor
 * Date: 7/10/18
 * Time: 11:32 AM
 */

namespace core;

use core\http\Request;
use core\http\Response;
use core\identity\AuthManager;

final class App
{
    private static $instance = null;
    protected $configs;
    protected $request;
    protected $response;
    protected $authManager;

    private function __construct(Configs $configs)
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->configs = $configs;
        $this->authManager = new AuthManager();
    }

    public function getAuth()
    {
        return $this->authManager;
    }

    public static function getInstance(Configs $configs = null)
    {
        if (!self::$instance) {
            self::$instance = new self($configs);
        }
        return self::$instance;
    }


    public function setConfig(Configs $config)
    {
        $this->config = $config;
    }


    protected function __sleep()
    {
        // TODO: Implement __sleep() method.
    }

    protected function __wakeup()
    {
        // TODO: Implement __wakeup() method.
    }

    protected function __clone()
    {
        // TODO: Implement __clone() method.
    }

    public function run()
    {
        extract(Request::parseRoute());
        $className = "\controllers\\$class";
        if (class_exists($className)) {
            $classObject = new $className();
            if (method_exists($classObject, $action)) {
                $classObject->$action();
            } else {
                Response::NotFound(sprintf("Action %s not exists in controller %s", $action, $class));
            }
        } else {
            Response::NotFound(sprintf("Controller %s not exists", $class));
        }
    }
}
