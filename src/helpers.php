<?php

use Strictus\Strictus;

if (! function_exists('sstring')) {
    /**
     * @return StrictusString
     */
    function sstring(mixed $string, bool $nullable = false)
    {
        return Strictus::string($string, $nullable);
    }
}

if (! function_exists('snstring')) {
    function snstring(mixed $string)
    {
        return Strictus::nullableString($string);
    }
}

if (! function_exists('sint')) {
    function sint(mixed $integer, bool $nullable = false)
    {
        return Strictus::int($integer, $nullable);
    }
}

if (! function_exists('snint')) {
    function snint(mixed $integer)
    {
        return Strictus::nullableInt($integer);
    }
}

if (! function_exists('sfloat')) {
    function sfloat(mixed $float, bool $nullable = false)
    {
        return Strictus::float($float, $nullable);
    }
}

if (! function_exists('snfloat')) {
    function snfloat(mixed $float)
    {
        return Strictus::nullableFloat($float);
    }
}

if (! function_exists('sbool')) {
    function sbool(mixed $boolean, bool $nullable = false)
    {
        return Strictus::bool($boolean, $nullable);
    }
}

if (! function_exists('snbool')) {
    function snbool(mixed $boolean)
    {
        return Strictus::nullableBool($boolean);
    }
}

if (! function_exists('sarray')) {
    function sarray(mixed $array, bool $nullable = false)
    {
        return Strictus::array($array, $nullable);
    }
}

if (! function_exists('snarray')) {
    function snarray(mixed $array)
    {
        return Strictus::nullableArray($array);
    }
}

if (! function_exists('sobject')) {
    function sobject(mixed $object, bool $nullable = false)
    {
        return Strictus::object($object, $nullable);
    }
}

if (! function_exists('snobject')) {
    function snobject(mixed $object)
    {
        return Strictus::nullableObject($object);
    }
}

if (! function_exists('sinstance')) {
    function sinstance(string $instanceType, mixed $instance, bool $nullable = false)
    {
        return Strictus::instance($instanceType, $instance, $nullable);
    }
}

if (! function_exists('sninstance')) {
    function sninstance(string $instanceType, mixed $instance)
    {
        return Strictus::nullableInstance($instanceType, $instance);
    }
}
