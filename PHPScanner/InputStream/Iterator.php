<?php

/**
 * @author Baha2r
 * @license MIT
 * Date : 19/9/2019
 *
 * This interface is parent iterator to iterate and scan files
 **/

namespace PHPScanner\InputStream;


interface Iterator
{

    // Gets next line of the file
    public function nextLine();

    // Checks if exists next line or not
    public function hasNext();
}