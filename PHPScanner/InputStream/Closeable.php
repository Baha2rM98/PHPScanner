<?php

/**
 * @author  Baha2r
 * @license MIT
 * Date : 8/10/2019
 *
 * This interface is base closeable system for end of reading of a file
 **/

namespace PHPScanner\InputStream;


interface Closeable
{
    // Closes the open stream
    public function close();

}