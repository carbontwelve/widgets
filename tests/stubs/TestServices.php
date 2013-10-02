<?php

class TestService
{

    public static function run()
    {
        return 'hello';
    }

    public static function more()
    {
        return 'one';
    }

    public static function ret($arg)
    {
        return strtoupper($arg);
    }

    public static function add($arg1, $arg2)
    {
        return ( $arg1 + $arg2 );
    }
}

class TestServiceTwo
{

    public static function run()
    {
        return 'world!';
    }

    public static function more()
    {
        return 'two';
    }

    public static function ret($arg)
    {
        return $arg;
    }

    public static function subtract($arg1, $arg2)
    {
        return ( $arg1 - $arg2 );
    }

}
