<?php

/**
 * @author  Baha2r
 * @license MIT
 * Date : 19/9/2019
 *
 * This class provides a system to get input streams from keyboard and also provides a system to read files
 **/

namespace PHPScanner\Scanner;

use PHPScanner\Exception\FileReaderException;
use PHPScanner\Exception\NumberFormatException;
use PHPScanner\InputStream\InputStream;

final class Scanner extends InputStream
{
    // private fields

    /**
     * @var resource
     **/
    private $handle;

    /**
     * @var string
     **/
    private $line;

    /**
     * @var boolean
     **/
    private $flag = false;

    /**
     * @var string
     **/
    private const MOD = "r";


    // Constructor

    /**
     * [optional] Use this constructor when you want read a file through Scanner class
     * <p>Initiate handle of the file (resource)</p>
     *
     * @param  string  $file  Gets a file path to scan and read '</br>'
     **/
    public function __construct($file = null)
    {
        parent::__construct();
        if (!is_null($file)) {
            $this->handle = fopen($file, self::MOD);
            $this->flag = true;
        }
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
     * @param  string   $number
     * @param  integer  $to
     * @param  integer  $from
     *
     * @return string Returns converted number from base $from to base $to
     */
    private function changeRadix($number, $from, $to)
    {
        return base_convert($number, $from, $to);
    }


    /**
     * @param  string  $value
     *
     * @return integer Returns converted $value to integer
     * @throws NumberFormatException
     */
    private function toInt($value)
    {
        if (!preg_match('/^[0-9a-fA-F]+$/', $value)) {
            throw new NumberFormatException("Number Format Exception!");
        }
        return intval($value);
    }


    /**
     * @param  string  $value
     *
     * @return float Returns converted $value to float
     * @throws NumberFormatException
     */
    private function toFloat($value)
    {
        if (!preg_match('/^[0-9a-fA-F.]+$/', $value)) {
            throw new NumberFormatException("Number Format Exception!");
        }
        return floatval($value);
    }


//    /**
//     * @param  string   $value
//     * @param  integer  $scale
//     *
//     * @return string Returns converted $value to string number
//     */
//    private function toBigNumber($value, $scale)
//    {
//        if (!preg_match('/^[0-9.]+$/', $value)) {
//            throw new NumberFormatException("Number Format Exception!");
//        }
//        return bcadd($value, "0", $scale);
//    }


    /**
     * @param  mixed  $value
     *
     * @return string Returns converted $value to string
     **/
    private function toString($value)
    {
        return strval($value);
    }


    /**
     * @param  string  $value
     *
     * @return string Returns converted $value to string(character)
     **/
    private function toChar($value)
    {
        $str = str_split($value);
        $char = $str[0];
        unset($str);
        return $char;
    }


    /**
     * Returns entered integer number
     *
     * @param  integer  $from   [optional] change base of entered number from $from
     * @param  integer  $radix  [optional] change base of entered number to $radix
     *
     * @return integer|string Returns entered integer
     * @throws NumberFormatException
     */
    public function nextInt($from = null, $radix = null)
    {
        $val = $this->createNewInput();
        if (is_null($from) || is_null($radix)) {
            return $this->toInt($val);
        }
        return strval($this->changeRadix($val, $from, $radix));
    }


    /**
     * Returns entered float or double number
     *
     * @param  integer  $radix  [optional] change base of entered number to $radix
     * @param  integer  $from   [optional] change base of entered number from $from
     *
     * @return float|string Returns entered float
     * @throws NumberFormatException
     */
    public function nextFloat($from = null, $radix = null)
    {
        $val = $this->createNewInput();
        if (is_null($from) || is_null($radix)) {
            return $this->toFloat($val);
        }
        return strval($this->changeRadix($val, $from, $radix));
    }


//    /**
//     * @param  null  $from   [optional] change base of entered number from $from
//     * @param  int   $radix  [optional] change base of entered number to $radix
//     *
//     * @param  int   $scale
//     *
//     * @return string Returns entered BigNumber
//     */
//    public function nextBigNumber($from = null, $radix = null, $scale = 5)
//    {
//        $val = $this->createNewInput();
//        if (is_null($from) || is_null($radix)) {
//            return $this->toBigNumber($val, $scale);
//        }
//        return $this->changeRadix(bcadd(strval($val), "0", $scale), $from, $radix);
//    }


    /**
     * Returns entered string's first character
     *
     * @return string Returns entered character
     **/
    public function nextChar()
    {
        $val = $this->createNewInput();
        return $this->toChar($val);
    }


    /**
     * Returns entered string
     *
     * @return string Returns entered string
     **/
    public function nextString()
    {
        $val = $this->createNewInput();
        return $this->toString($val);
    }


    // files methods

    /**
     * Returns content of the file
     *
     * @return string Returns content of file
     * @throws FileReaderException
     */
    public function nextLine()
    {
        if (!$this->flag) {
            throw new FileReaderException("Constructor Must Be Initialize With A File's Path!");
        }
        $content = $this->line;
        return $content;
    }


    /**
     * Returns next line of the file, False otherwise
     *
     * @return string|boolean Returns lines of the file content as string, return false if end of file achieved
     * @throws FileReaderException
     */
    public function hasNext()
    {
        if (!$this->flag) {
            throw new FileReaderException("Constructor Must Be Initialize With A File's Path!");
        }
        return (($this->line = fgets($this->getHandle())) !== false);
    }


    /**
     * Closes opened handle
     *
     * @throws FileReaderException
     */
    public function close(): void
    {
        if (!$this->flag) {
            throw new FileReaderException("Constructor Must Be Initialize With A File's Path!");
        }
        fclose($this->getHandle());
    }
}