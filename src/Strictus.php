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
    /**
     * @param  mixed  $string
     * @param  bool  $nullable
     * @return StrictusString
     */
    public static function string(mixed $string, bool $nullable = false): StrictusString
    {
        return new StrictusString($string, $nullable);
    }

    /**
     * @param  mixed  $string
     * @return StrictusString
     */
    public static function nullableString(mixed $string): StrictusString
    {
        return new StrictusString($string, true);
    }

    /**
     * @param  mixed  $integer
     * @param  bool  $nullable
     * @return StrictusInteger
     */
    public static function int(mixed $integer, bool $nullable = false): StrictusInteger
    {
        return new StrictusInteger($integer, $nullable);
    }

    /**
     * @param  mixed  $integer
     * @return StrictusInteger
     */
    public static function nullableInt(mixed $integer): StrictusInteger
    {
        return new StrictusInteger($integer, true);
    }

    /**
     * @param  mixed  $float
     * @param  bool  $nullable
     * @return StrictusFloat
     */
    public static function float(mixed $float, bool $nullable = false): StrictusFloat
    {
        return new StrictusFloat($float, $nullable);
    }

    /**
     * @param  mixed  $float
     * @return StrictusFloat
     */
    public static function nullableFloat(mixed $float): StrictusFloat
    {
        return new StrictusFloat($float, true);
    }

    /**
     * @param  mixed  $boolean
     * @param  bool  $nullable
     * @return StrictusBoolean
     */
    public static function bool(mixed $boolean, bool $nullable = false): StrictusBoolean
    {
        return new StrictusBoolean($boolean, $nullable);
    }

    /**
     * @param  mixed  $boolean
     * @return StrictusBoolean
     */
    public static function nullableBool(mixed $boolean): StrictusBoolean
    {
        return new StrictusBoolean($boolean, true);
    }

    /**
     * @param  mixed  $array
     * @param  bool  $nullable
     * @return StrictusArray
     */
    public static function array(mixed $array, bool $nullable = false): StrictusArray
    {
        return new StrictusArray($array, $nullable);
    }

    /**
     * @param  mixed  $array
     * @return StrictusArray
     */
    public static function nullableArray(mixed $array): StrictusArray
    {
        return new StrictusArray($array, true);
    }

    /**
     * @param  mixed  $object
     * @param  bool  $nullable
     * @return StrictusObject
     */
    public static function object(mixed $object, bool $nullable = false): StrictusObject
    {
        return new StrictusObject($object, $nullable);
    }

    /**
     * @param  mixed  $object
     * @return StrictusObject
     */
    public static function nullableObject(mixed $object): StrictusObject
    {
        return new StrictusObject($object, true);
    }

    /**
     * @param  string  $instanceType
     * @param  mixed  $instance
     * @param  bool  $nullable
     * @return StrictusInstance
     */
    public static function instance(string $instanceType, mixed $instance, bool $nullable = false): StrictusInstance
    {
        return new StrictusInstance($instanceType, $instance, $nullable);
    }

    /**
     * @param  string  $instanceType
     * @param  mixed  $instance
     * @return StrictusInstance
     */
    public static function nullableInstance(string $instanceType, mixed $instance): StrictusInstance
    {
        return new StrictusInstance($instanceType, $instance, true);
    }

    /**
     * @param  string  $enumType
     * @param  mixed  $enum
     * @param  bool  $nullable
     * @return StrictusEnum
     */
    public static function enum(string $enumType, mixed $enum, bool $nullable = false): StrictusEnum
    {
        return new StrictusEnum($enumType, $enum, $nullable);
    }

    /**
     * @param  string  $enumType
     * @param  mixed  $enum
     * @return StrictusEnum
     */
    public static function nullableEnum(string $enumType, mixed $enum): StrictusEnum
    {
        return new StrictusEnum($enumType, $enum, true);
    }
}
