<?php

/**
 * @author Baha2r
 * @license MIT
 * Date : 19/9/2019
 *
 * This class provides a system to get input streams from keyboard and also provides a system to read files
 **/

namespace PHPScanner\Scanner;

use Exception;
use GMP;
use PHPScanner\InputStream\InputStream;

final class Scanner extends InputStream
{
    // private fields

    private $handle;
    private $line;
    private $flag = false;
    private const MOD = "r";


    //constructor

    /**
     * [optional] use this constructor when you want read a file through Scanner class
     * <p>Initiate handle of the file (resource)</p>
     * @param string $file gets a file path to scan and read '</br>'
     **/
    public function __construct($file = null)
    {
        if (!is_null($file)) {
            $this->handle = fopen($file, self::MOD);
            $this->flag = true;
        }
    }


    /**
     * @param null $from [optional] change base of entered number from $from
     * @param int $radix [optional] change base of entered number to $radix
     * @return integer return entered integer
     * @throws Exception
     */
    public function nextInt($from = null, $radix = null)
    {
        $val = $this->createNewInput();
        if (is_null($from) && is_null($radix))
            return $this->toInt($val);
        return $this->toInt($this->changeRadix($val, $from, $radix));
    }


    /**
     * @param int $radix [optional] change base of entered number to $radix
     * @param null $from [optional] change base of entered number from $from
     * @return float return entered float
     * @throws Exception
     */
    public function nextFloat($from = null, $radix = null)
    {
        $val = $this->createNewInput();
        if (is_null($from) && is_null($radix))
            return $this->toFloat($val);
        return $this->toFloat($this->changeRadix($val, $from, $radix));
    }


    /**
     * @param null $from [optional] change base of entered number from $from
     * @param int $radix [optional] change base of entered number to $radix
     * @return GMP return entered GMP number
     * @throws Exception
     */
    public function nextGMP($from = null, $radix = null)
    {
        $val = $this->createNewInput();
        if (is_null($from) && is_null($radix))
            return $this->toGMP($val);
        return $this->toGMP($this->changeRadix(gmp_strval($val), $from, $radix));
    }


    /**
     * @return string return entered character
     **/
    public function nextChar()
    {
        $val = $this->createNewInput();
        return $this->toChar($val);
    }


    /**
     * @return string return entered string
     **/
    public function nextString()
    {
        $val = $this->createNewInput();
        return $this->toString($val);
    }


    // private functions

    /**
     * @return bool|resource return value of private field $handle
     **/
    private function getHandle()
    {
        return $this->handle;
    }


    /**
     * @param string $number
     * @param integer $to
     * @param integer $from
     * @return string return converted number from base $from to base $to
     */
    private function changeRadix($number, $from, $to)
    {
        return base_convert($number, $from, $to);
    }


    /**
     * @param string $value
     * @return integer return converted $value to integer
     * @throws Exception
     */
    private function toInt($value)
    {
        if (preg_match("/[a-z]/i", $value))
            throw new Exception("Number Format Exception!");
        return intval($value);
    }


    /**
     * @param string $value
     * @return float return converted $value to float
     * @throws Exception
     */
    private function toFloat($value)
    {
        if (preg_match("/[a-z]/i", $value))
            throw new Exception("Number Format Exception!");
        return floatval($value);
    }


    /**
     * @param string $value
     * @return GMP return converted $value to GMP number
     * @throws Exception
     **/
    private function toGMP($value)
    {
        return gmp_init($value);
    }


    /**
     * @param string $value
     * @return string return converted $value to string
     **/
    private function toString($value)
    {
        return strval($value);
    }


    /**
     * @param string $value
     * @return string return converted $value to string(character)
     **/
    private function toChar($value)
    {
        $str = str_split($value);
        return $str[0];
    }


    // files methods

    /**
     * @return string return content of file
     * @throws Exception
     */
    public function nextLine()
    {
        if (!$this->flag)
            throw new Exception("Constructor Must Be Initialize With A File's Path!");
        $content = $this->line;
        return $content;
    }


    /**
     * @return string|boolean read file line by line and return content as string, return false if end of file achieved
     * @throws Exception
     */
    public function hasNext()
    {
        if (!$this->flag)
            throw new Exception("Constructor Must Be Initialize With A File's Path!");
        return (($this->line = fgets($this->getHandle())) !== false);
    }


    /**
     * Close opened handle
     * @return void
     * @throws Exception
     */
    public function close()
    {
        if (!$this->flag)
            throw new Exception("Constructor Must Be Initialize With A File's Path!");
        fclose($this->getHandle());
    }
}