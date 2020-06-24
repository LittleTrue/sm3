<?php
/**
 *  @department : Commercial development.
 *  @description : This file is part of DZ.
 */

namespace sm3\libs;

/**
 * 配置类
 * Class Config.
 */
class Config
{
    /** @var array|mixed 动态数组 */
    private $config = [];

    public function __construct()
    {
        $this->config = require_once __DIR__ . '../config.php';
    }

    public function __get($name)
    {
        return $this->config[$name];
    }

    public function __set($name, $value)
    {
        $this->config[$name] = $value;
        return $this->config;
    }

    public function __isset($name)
    {
        return !empty($this->config[$name]);
    }
}
