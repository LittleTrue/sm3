<?php
/**
 *  @department : Commercial development.
 *  @description : This file is part of DZ.
 */

namespace sm3\handler;

use sm3\libs\WordConversion;

/**
 * 小j处理类
 * Class BigJHandler.
 */
class BigJHandler extends JHandler
{
    /** @var int j的最大可用值 */
    const SMALLEST_J = 16;

    /** @var int j的最小可用值 */
    const BIGGEST_J = 63;

    /** @var string T常量 */
    const T = '7a879d8a';

    /**
     * 补充父类
     * SmallJHandler constructor.
     */
    public function __construct()
    {
        parent::__construct(self::T, self::SMALLEST_J, self::BIGGEST_J);
    }

    /**
     * 布尔函数.
     *
     * @param $X string 长度32的比特串
     * @param $Y string
     * @param $Z string
     */
    public function FF($X, $Y, $Z)
    {
        $X_and_Y = WordConversion::andConversion([$X, $Y]);
        $X_and_Z = WordConversion::andConversion([$X, $Z]);
        $Y_and_Z = WordConversion::andConversion([$Y, $Z]);

        return WordConversion::orConversion([
            $X_and_Y, $X_and_Z, $Y_and_Z,
        ]);
    }

    /**
     * 布尔函数.
     *
     * @param $X
     * @param $Y
     * @param $Z
     */
    public function GG($X, $Y, $Z)
    {
        $X_and_Y = WordConversion::andConversion([$X, $Y]);

        $not_X       = WordConversion::notConversion($X);
        $not_X_and_Z = WordConversion::andConversion([$not_X, $Z]);

        return WordConversion::orConversion([$X_and_Y, $not_X_and_Z]);
    }
}
