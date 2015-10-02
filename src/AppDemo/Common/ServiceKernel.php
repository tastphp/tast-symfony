<?php

namespace AppDemo\Common;

class ServiceKernel
{
    private static $_instance = null;

    private $container = [];

    private $connection = null;

    static function instance()
    {
        if (!self::$_instance) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function setConnection($connection)
    {
        $this->connection = $connection;
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function registerService($name)
    {
        if (empty($this->container[$name])) {
            $service = $this->register('Service', $name);
            $this->container[$name] = $service;
        }
        return $this->container[$name];
    }

    public function registerDao($name)
    {
        if (empty($this->container[$name])) {
            $dao = $this->register('Dao', $name);
            $dao->setConnection($this->getConnection());
            $this->container[$name] = $dao;
        }
        return $this->container[$name];
    }

    private function register($type, $name)
    {
        list($module, $classType) = explode('.', $name);
        $extraDir = $type == 'Dao' ? '\\Dao' : '';
        $namespace = str_replace('\Common', '', __NAMESPACE__) . "\\Service";
        $className = $namespace . "\\" . $module . "$extraDir\\Impl\\" . $classType . "Impl";
        return new $className;
    }
}