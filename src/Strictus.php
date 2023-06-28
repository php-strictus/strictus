<?php

declare(strict_types=1);

namespace Strictus;

use Strictus\Enums\Type;
use Strictus\Types\StrictusArray;
use Strictus\Types\StrictusBoolean;
use Strictus\Types\StrictusEnum;
use Strictus\Types\StrictusFloat;
use Strictus\Types\StrictusInstance;
use Strictus\Types\StrictusInteger;
use Strictus\Types\StrictusObject;
use Strictus\Types\StrictusString;
use Strictus\Types\StrictusUnion;

final class Strictus
{
    /**
     * Create a StrictusString object.
     *
     * @param  mixed  $string  The value to be wrapped in a StrictusString object.
     * @param  bool  $nullable  Indicates if the StrictusString object can be null.
     */
    public static function string(mixed $string, bool $nullable = false): StrictusString
    {
        return new StrictusString($string, $nullable);
    }

    /**
     * Create a nullable StrictusString object.
     *
     * @param  mixed  $string  The value to be wrapped in a StrictusString object.
     */
    public static function nullableString(mixed $string): StrictusString
    {
        return new StrictusString($string, true);
    }

    /**
     * Create a StrictusInteger object.
     *
     * @param  mixed  $integer  The value to be wrapped in a StrictusInteger object.
     * @param  bool  $nullable  Indicates if the StrictusInteger object can be null.
     */
    public static function int(mixed $integer, bool $nullable = false): StrictusInteger
    {
        return new StrictusInteger($integer, $nullable);
    }

    /**
     * Create a nullable StrictusInteger object.
     *
     * @param  mixed  $integer  The value to be wrapped in a StrictusInteger object.
     */
    public static function nullableInt(mixed $integer): StrictusInteger
    {
        return new StrictusInteger($integer, true);
    }

    /**
     * Create a StrictusFloat object.
     *
     * @param  mixed  $float  The value to be wrapped in a StrictusFloat object.
     * @param  bool  $nullable  Indicates if the StrictusFloat object can be null.
     */
    public static function float(mixed $float, bool $nullable = false): StrictusFloat
    {
        return new StrictusFloat($float, $nullable);
    }

    /**
     * Create a nullable StrictusFloat object.
     *
     * @param  mixed  $float  The value to be wrapped in a StrictusFloat object.
     */
    public static function nullableFloat(mixed $float): StrictusFloat
    {
        return new StrictusFloat($float, true);
    }

    /**
     * Create a StrictusBoolean object.
     *
     * @param  mixed  $boolean  The value to be wrapped in a StrictusBoolean object.
     * @param  bool  $nullable  Indicates if the StrictusBoolean object can be null.
     */
    public static function bool(mixed $boolean, bool $nullable = false): StrictusBoolean
    {
        return new StrictusBoolean($boolean, $nullable);
    }

    /**
     * Create a nullable StrictusBoolean object.
     *
     * @param  mixed  $boolean  The value to be wrapped in a StrictusBoolean object.
     */
    public static function nullableBool(mixed $boolean): StrictusBoolean
    {
        return new StrictusBoolean($boolean, true);
    }

    /**
     * Create a StrictusArray object.
     *
     * @param  mixed  $array  The value to be wrapped in a StrictusArray object.
     * @param  bool  $nullable  Indicates if the StrictusArray object can be null.
     */
    public static function array(mixed $array, bool $nullable = false): StrictusArray
    {
        return new StrictusArray($array, $nullable);
    }

    /**
     * Create a nullable StrictusArray object.
     *
     * @param  mixed  $array  The value to be wrapped in a StrictusArray object.
     */
    public static function nullableArray(mixed $array): StrictusArray
    {
        return new StrictusArray($array, true);
    }

    /**
     * Create a StrictusObject object.
     *
     * @param  mixed  $object  The value to be wrapped in a StrictusObject object.
     * @param  bool  $nullable  Indicates if the StrictusObject object can be null.
     */
    public static function object(mixed $object, bool $nullable = false): StrictusObject
    {
        return new StrictusObject($object, $nullable);
    }

    /**
     * Create a nullable StrictusObject object.
     *
     * @param  mixed  $object  The value to be wrapped in a StrictusObject object.
     */
    public static function nullableObject(mixed $object): StrictusObject
    {
        return new StrictusObject($object, true);
    }

    /**
     * Create a StrictusInstance object.
     *
     * @param  string  $instanceType  The type of the instance.
     * @param  mixed  $instance  The value to be wrapped in a StrictusInstance object.
     * @param  bool  $nullable  Indicates if the StrictusInstance object can be null.
     */
    public static function instance(string $instanceType, mixed $instance, bool $nullable = false): StrictusInstance
    {
        return new StrictusInstance($instanceType, $instance, $nullable);
    }

    /**
     * Create a nullable StrictusInstance object.
     *
     * @param  string  $instanceType  The type of the instance.
     * @param  mixed  $instance  The value to be wrapped in a StrictusInstance object.
     */
    public static function nullableInstance(string $instanceType, mixed $instance): StrictusInstance
    {
        return new StrictusInstance($instanceType, $instance, true);
    }

    /**
     * Create a StrictusEnum object.
     *
     * @param  string  $enumType  The type of the enum.
     * @param  mixed  $enum  The value to be wrapped in a StrictusEnum object.
     * @param  bool  $nullable  Indicates if the StrictusEnum object can be null.
     */
    public static function enum(string $enumType, mixed $enum, bool $nullable = false): StrictusEnum
    {
        return new StrictusEnum($enumType, $enum, $nullable);
    }

    /**
     * Create a nullable StrictusEnum object.
     *
     * @param  string  $enumType  The type of the enum.
     * @param  mixed  $enum  The value to be wrapped in a StrictusEnum object.
     */
    public static function nullableEnum(string $enumType, mixed $enum): StrictusEnum
    {
        return new StrictusEnum($enumType, $enum, true);
    }

    /**
     * Create a StrictusUnion object.
     *
     * @param  Type[]  $types  The types included in the union.
     * @param  mixed  $value  The value to be wrapped in a StrictusUnion object.
     * @param  bool  $nullable  Indicates if the StrictusUnion object can be null.
     */
    public static function union(array $types, mixed $value, bool $nullable = false): StrictusUnion
    {
        return new StrictusUnion($types, $value, $nullable);
    }

    /**
     * Create a nullable StrictusUnion object.
     *
     * @param  Type[]  $types  The types included in the union.
     * @param  mixed  $value  The value to be wrapped in a StrictusUnion object.
     */
    public static function nullableUnion(array $types, mixed $value): StrictusUnion
    {
        return new StrictusUnion($types, $value, true);
    }
}
