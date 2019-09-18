<?php


namespace InputStream;

use Iterator\Iterator;

abstract class InputStream implements Iterator
{
    private const in = STDIN;

    protected final function createNewInput()
    {
        return fgets(self::in);
    }
}