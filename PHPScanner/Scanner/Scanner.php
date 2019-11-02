<?php

/**
 * @author Baha2r
 * @license MIT
 * Date : 19/9/2019
 *
 * This class provides a system to get input streams from keyboard and also provides a system to read files
 **/

namespace PHPScanner\Scanner;


use PHPScanner\Exception\NumberFormatException;
use PHPScanner\InputStream\InputStream;
use GMP;
use RuntimeException;

final class Scanner extends InputStream
{
    // private fields

    private $handle;
    private $line;
    private $flag = false;
    private const MOD = "r";


    //constructor

    /**
     * [optional] Use this constructor when you want read a file through Scanner class
     *
     * <p>Initiate handle of the file (resource)</p>
     * @param  string  $file  gets a file path to scan and read
     **/
    public function __construct($file = null)
    {
        if (!is_null($file)) {
            if (!file_exists($file)) {
                throw new RuntimeException("File $file not found!");
            }
            $this->handle = fopen($file, self::MOD);
            $this->flag = true;
        }
    }


    /**
     * Gets an integer number
     *
     * @param  integer  $from  [optional] change base of entered number from $from
     * @param  integer  $radix  [optional] change base of entered number to $radix
     * @return integer return entered integer
     * @throws NumberFormatException throws exception if entered number consists alphabet
     */
    public function nextInt($from = null, $radix = null)
    {
        $val = $this->createNewInput();
        if (is_null($from) && is_null($radix)) {
            return $this->toInt($val);
        }
        return $this->toInt($this->changeRadix($val, $from, $radix));
    }


    /**
     * Gets a float number
     *
     * @param  integer  $from  [optional] change base of entered number from $from
     * @param  integer  $radix  [optional] change base of entered number to $radix
     * @return float return entered float
     * @throws NumberFormatException throws exception if entered number consists alphabet
     */
    public function nextFloat($from = null, $radix = null)
    {
        $val = $this->createNewInput();
        if (is_null($from) && is_null($radix)) {
            return $this->toFloat($val);
        }
        return $this->toFloat($this->changeRadix($val, $from, $radix));
    }


    /**
     * Gets a GMP number
     *
     * @param  integer  $from  [optional] change base of entered number from $from
     * @param  integer  $radix  [optional] change base of entered number to $radix
     * @return GMP return entered GMP number
     * @throws NumberFormatException throws exception if entered number consists alphabet
     */
    public function nextGMP($from = null, $radix = null)
    {
        $val = $this->createNewInput();
        if (is_null($from) && is_null($radix)) {
            return $this->toGMP($val);
        }
        return $this->toGMP($this->changeRadix(gmp_strval($val), $from, $radix));
    }


    /**
     * Gets a character
     *
     * @return string return entered character
     **/
    public function nextChar()
    {
        $val = $this->createNewInput();
        return $this->toChar($val);
    }


    /**
     * Gets a string
     *
     * @return string return entered string
     **/
    public function next()
    {
        $val = $this->createNewInput();
        return $this->toString($val);
    }


    // private functions

    /**
     * Returns the handle that initialized in constructor
     *
     * @return bool|resource return value of private field $handle
     **/
    private function getHandle()
    {
        return $this->handle;
    }


    /**
     * Changes radix of a number
     *
     * @param  string  $number
     * @param  integer  $from
     * @param  integer  $to
     * @return string return converted number from base $from to base $to
     */
    private function changeRadix($number, $from, $to)
    {
        return base_convert($number, $from, $to);
    }


    /**
     * Converts a string to a integer number
     *
     * @param  string  $value  the number in string format
     * @return integer return converted $value to integer
     * @throws NumberFormatException throws exception if entered number consists alphabet
     */
    private function toInt($value)
    {
        if (intval($value) === 0) {
            throw new NumberFormatException("Number Format Exception!");
        }
        return intval($value);
    }


    /**
     * Converts a string to a float number
     *
     * @param  string  $value  the number in string format
     * @return float return converted $value to float
     * @throws NumberFormatException throws exception if entered number consists alphabet
     */
    private function toFloat($value)
    {
        if (intval($value) === 0) {
            throw new NumberFormatException("Number Format Exception!");
        }
        return floatval($value);
    }


    /**
     * Converts a string to a GMP number
     *
     * @param  string  $value  the number in string format
     * @return GMP return converted $value to GMP number
     * @throws NumberFormatException throws exception if entered number consists alphabet
     **/
    private function toGMP($value)
    {
        if (gmp_init($value) === 0) {
            throw new NumberFormatException("Number Format Exception!");
        }
        return gmp_init($value);
    }


    /**
     * Returns entered string
     *
     * @param  string  $value  string value
     * @return string return $value as a string
     **/
    private function toString($value)
    {
        return $value;
    }


    /**
     * Converts a string to a character
     *
     * @param  string  $value
     * @return string return converted $value to string(character)
     **/
    private function toChar($value)
    {
        $str = str_split($value);
        return $str[0];
    }


    // files methods

    /**
     * Reads the next line of a file
     *
     * @return string return content of file
     * @throws RuntimeException throws exception if constructor parameter is null
     */
    public function nextLine()
    {
        if (!$this->flag) {
            throw new RuntimeException("Constructor Must Be Initialize With A File's Path!");
        }
        $content = $this->line;
        return $content;
    }


    /**
     * Checks if there is next line in a file or not
     *
     * @return string|boolean read file line by line and return content as string, return false if end of file achieved
     * @throws RuntimeException throws exception if constructor parameter is null
     */
    public function hasNext()
    {
        if (!$this->flag) {
            throw new RuntimeException("Constructor Must Be Initialize With A File's Path!");
        }
        return (($this->line = fgets($this->getHandle())) !== false);
    }


    /**
     * Closes opened file handle
     *
     * @throws RuntimeException throws exception if constructor parameter is null
     */
    public function close(): void
    {
        if (!$this->flag) {
            throw new RuntimeException("Constructor Must Be Initialize With A File's Path!");
        }
        fclose($this->getHandle());
    }
}