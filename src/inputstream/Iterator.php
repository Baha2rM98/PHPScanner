<?php

/**
 * @author Baha2r
 * @license MIT
 * Date : 19/9/2019
 *
 * This interface is parent iterator to iterate and scan files
 **/

namespace Iterator;


interface Iterator
{
    /**
     * close() will be implemented in child class
     **/
    public function close();


    /**
     * hasNext() will be implemented in child class
     **/
    public function hasNext();
}