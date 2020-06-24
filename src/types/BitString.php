<?php
/**
 *  @department : Commercial development.
 *  @description : This file is part of DZ.
 */

namespace sm3\types;

use ArrayAccess;

/**
 * 比特串
 * 由0和1组成的二进制数字序列。
 * Class BitString.
 */
class BitString implements ArrayAccess
{
    /** @var string 一个比特串类型的变量 */
    protected $bit_string = '';

    /**
     * BitString constructor.
     *
     * @param $string string|\sm3\types\BitString|\sm3\types\Word|mixed
     */
    public function __construct($string)
    {
        if (is_object($string)) {
            $string = $string->getString();
        }

        $string = is_int($string)
            ? $string
            : strtr($string, [' ' => '']);
        $this->bit_string = $this->is_bit_string($string)
            ? $string
            : "{$this->str2bin($string)}";
    }

    public function __toString()
    {
        return $this->getString();
    }

    /**
     * 判断是否为比特串类型.
     *
     * @param \sm3\types\BitString|\sm3\types\Word|string $string
     *
     * @return bool
     */
    public function is_bit_string($string)
    {
        if (is_object($string)) {
            $string = $string->getString();
        }
        // 检查是否为字符串
        if (!is_string($string)) {
            return false;
        }
        // 检查是否为只有0和1组成的字符串
        $array = array_filter(str_split($string));
        foreach ($array as $value) {
            if (!in_array($value, [
                0, '0', 1, '1',
            ], true)) {
                return false;
            }
        }

        return true;
    }

    /**
     * 获取比特串的值
     *
     * @return string
     */
    public function getString()
    {
        return $this->bit_string;
    }

    public function offsetGet($offset)
    {
        return $this->bit_string[$offset];
    }

    /**
     * Whether a offset exists.
     *
     * @see  https://php.net/manual/en/arrayaccess.offsetexists.php
     *
     * @param mixed $offset <p>
     *                      An offset to check for.
     *                      </p>
     *
     * @return bool true on success or false on failure.
     *              </p>
     *              <p>
     *              The return value will be casted to boolean if non-boolean was returned.
     * @since 5.0.0
     */
    public function offsetExists($offset)
    {
        return isset($this->bit_string[$offset]);
    }

    /**
     * Offset to set.
     *
     * @see  https://php.net/manual/en/arrayaccess.offsetset.php
     *
     * @param mixed $offset <p>
     *                      The offset to assign the value to.
     *                      </p>
     * @param mixed $value  <p>
     *                      The value to set.
     *                      </p>
     *
     * @return \SM3\types\BitString
     * @since 5.0.0
     */
    public function offsetSet($offset, $value)
    {
        $this->bit_string[$offset] = $value;
        return $this;
    }

    /**
     * Offset to unset.
     *
     * @see  https://php.net/manual/en/arrayaccess.offsetunset.php
     *
     * @param mixed $offset <p>
     *                      The offset to unset.
     *                      </p>
     *
     * @since 5.0.0
     */
    public function offsetUnset($offset)
    {
        unset($this->bit_string[$offset]);
    }

    /**
     * 字符串转比特串.
     *
     * @param $str int|string 普通字符串
     *
     * @return string 转换为比特串
     */
    private function str2bin($str)
    {
        if (!is_string($str) && !is_int($str)) {
            return false;
        }
        if (is_int($str)) {
            return decbin($str);
        }
        $arr = preg_split('/(?<!^)(?!$)/u', $str);
        foreach ($arr as &$v) {
            $temp = unpack('H*', $v);
            $v    = base_convert($temp[1], 16, 2);
            while (strlen($v) < 8) {
                $v = '0' . $v;
            }
            unset($temp);
        }
        return join('', $arr);
    }
}
