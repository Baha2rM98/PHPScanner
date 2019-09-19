<?php

/**
 * @author Baha2r
 * @license MIT
 * Date : 19/9/2019
 *
 * Class InputStream creates main standard IO input stream to get streams
 **/

namespace InputStream;

use Iterator\Iterator;

abstract class InputStream implements Iterator
{
    // private fields
    private static $in;


    //constructor
    protected function __construct()
    {
        self::$in = STDIN;
    }


    /**
     * This method creates a new input stream data
     * @return string|boolean return input stream data
     **/
    protected final function createNewInput()
    {
        return fgets(self::$in);
    }
}