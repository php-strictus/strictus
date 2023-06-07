<?php

declare(strict_types=1);

namespace Strictus;

use Strictus\Types\StrictusArray;
use Strictus\Types\StrictusBoolean;
use Strictus\Types\StrictusEnum;
use Strictus\Types\StrictusFloat;
use Strictus\Types\StrictusInstance;
use Strictus\Types\StrictusInteger;
use Strictus\Types\StrictusObject;
use Strictus\Types\StrictusString;

final class Strictus
{
    public static function string(mixed $string, bool $nullable = false): StrictusString
    {
        return new StrictusString($string, $nullable);
    }

    public static function nullableString(mixed $string): StrictusString
    {
        return new StrictusString($string, true);
    }

    public static function int(mixed $integer, bool $nullable = false): StrictusInteger
    {
        return new StrictusInteger($integer, $nullable);
    }

    public static function nullableInt(mixed $integer): StrictusInteger
    {
        return new StrictusInteger($integer, true);
    }

    public static function float(mixed $float, bool $nullable = false): StrictusFloat
    {
        return new StrictusFloat($float, $nullable);
    }

    public static function nullableFloat(mixed $float): StrictusFloat
    {
        return new StrictusFloat($float, true);
    }

    public static function bool(mixed $boolean, bool $nullable = false): StrictusBoolean
    {
        return new StrictusBoolean($boolean, $nullable);
    }

    public static function nullableBool(mixed $boolean): StrictusBoolean
    {
        return new StrictusBoolean($boolean, true);
    }

    public static function array(mixed $array, bool $nullable = false): StrictusArray
    {
        return new StrictusArray($array, $nullable);
    }

    public static function nullableArray(mixed $array): StrictusArray
    {
        return new StrictusArray($array, true);
    }

    public static function object(mixed $object, bool $nullable = false): StrictusObject
    {
        return new StrictusObject($object, $nullable);
    }

    public static function nullableObject(mixed $object): StrictusObject
    {
        return new StrictusObject($object, true);
    }

    public static function instance(string $instanceType, mixed $instance, bool $nullable = false): StrictusInstance
    {
        return new StrictusInstance($instanceType, $instance, $nullable);
    }

    public static function nullableInstance(string $instanceType, mixed $instance): StrictusInstance
    {
        return new StrictusInstance($instanceType, $instance, true);
    }

    public static function enum(string $enumType, mixed $enum, bool $nullable = false): StrictusEnum
    {
        return new StrictusEnum($enumType, $enum, $nullable);
    }

    public static function nullableEnum(string $enumType, mixed $enum): StrictusEnum
    {
        return new StrictusEnum($enumType, $enum, true);
    }
}
