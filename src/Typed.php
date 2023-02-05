<?php

namespace Strictus\Strictus;

use Strictus\Strictus\Types\StrictusInteger;
use Strictus\Strictus\Types\StrictusString;
use Strictus\Strictus\Types\StrictusFloat;
use Strictus\Strictus\Types\StrictusBoolean;
use Strictus\Strictus\Types\StrictusArray;
use Strictus\Strictus\Types\StrictusObject;
use Strictus\Strictus\Types\StrictusInstance;

class Typed
{
    public static function string($string, bool $nullable = false): StrictusString
    {
        return new StrictusString($string, $nullable);
    }

    public static function nullableString($string): StrictusString
    {
        return new StrictusString($string, true);
    }

    public static function int($integer, bool $nullable = false): StrictusInteger
    {
        return new StrictusInteger($integer, $nullable);
    }

    public static function nullableInt($integer): StrictusInteger
    {
        return new StrictusInteger($integer, true);
    }

    public static function float($float, bool $nullable = false): StrictusFloat
    {
        return new StrictusFloat($float, $nullable);
    }

    public static function nullableFloat($float): StrictusFloat
    {
        return new StrictusFloat($float, true);
    }

    public static function boolean($boolean, bool $nullable = false): StrictusBoolean
    {
        return new StrictusBoolean($boolean, $nullable);
    }

    public static function nullableBoolean($boolean): StrictusBoolean
    {
        return new StrictusBoolean($boolean, true);
    }

    public static function arr($array, bool $nullable = false): StrictusArray
    {
        return new StrictusArray($array, $nullable);
    }

    public static function nullableArr($array): StrictusArray
    {
        return new StrictusArray($array, true);
    }

    public static function object($object, bool $nullable = false): StrictusObject
    {
        return new StrictusObject($object, $nullable);
    }

    public static function nullableObject($object): StrictusObject
    {
        return new StrictusObject($object, true);
    }

    public static function instance($instance, bool $nullable = false): StrictusInstance
    {
        return new StrictusInstance($instance, $nullable);
    }

    public static function nullableInstance($instance): StrictusInstance
    {
        return new StrictusInstance($instance, true);
    }
}