<?php
/**
 *  @department : Commercial development.
 *  @description : This file is part of DZ.
 */

namespace sm3\handler;

use sm3\libs\WordConversion;
use sm3\types\Word;

/**
 * j处理抽象类
 * Class JHandler.
 */
abstract class JHandler
{
    /** @var string 常量T */
    protected $T = '';

    /** @var array j的长度区间 */
    protected $section_j = [];

    /**
     * JHandler constructor.
     *
     * @param $T        string 常量T
     * @param $smallest int j的最小可用值
     * @param $biggest  int j的最大可用值
     */
    public function __construct($T, $smallest, $biggest)
    {
        $this->setT($T);
        $this->setSectionJ($smallest, $biggest);
    }

    /**
     * 配置常量T.
     *
     * @param string $T
     */
    public function setT($T)
    {
        $this->T = WordConversion::hex2bin($T);
    }

    /**
     * 配置 继承本抽象类的子类可以处理的j的大小.
     *
     * @param $smallest int j的最小长度
     * @param $biggest  int j的最大长度
     */
    public function setSectionJ($smallest, $biggest)
    {
        $this->section_j = [$smallest, $biggest];
    }

    /**
     * 布尔函数.
     *
     * @param $X string 长度32的比特串
     * @param $Y string
     * @param $Z string
     */
    abstract public function FF($X, $Y, $Z);

    /**
     * 布尔函数.
     *
     * @param $X
     * @param $Y
     * @param $Z
     */
    abstract public function GG($X, $Y, $Z);

    /**
     * 读取常量T.
     *
     * @return \SM3\types\Word
     */
    public function getT()
    {
        return new Word($this->T);
    }
}
