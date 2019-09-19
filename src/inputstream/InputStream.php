<?php

/**
 * @author Baha2r
 * @license MIT
 * Date : 19/9/2019
 *
 * Class InputStream creates main standard IO input stream to get streams
 **/

namespace InputStream;

require_once "Iterator.php";

use Iterator\Iterator;

abstract class InputStream implements Iterator
{
    // private fields
    private const in = STDIN;


    /**
     * This method creates a new input stream data
     * @return string|boolean return input stream data
     **/
    protected final function createNewInput()
    {
        return fgets(self::in);
    }
}