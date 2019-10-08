<?php

/**
 * @author Baha2r
 * @license MIT
 * Date : 8/10/2019
 *
 * This interface is base closeable system for end of reading of a file
 **/

namespace PHPScanner\InputStream;


interface Closeable
{
    /**
     * close() will be implemented in child class
     **/
    public function close();

}