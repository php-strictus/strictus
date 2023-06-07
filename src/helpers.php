<?php

use Strictus\Strictus;

if (! function_exists('s_string')) {
    function s_string(mixed $string, bool $nullable = false)
    {
        return Strictus::string($string, $nullable);
    }
}

if (! function_exists('sn_string')) {
    function sn_string(mixed $string)
    {
        return Strictus::nullableString($string);
    }
}

if (! function_exists('s_int')) {
    function s_int(mixed $integer, bool $nullable = false)
    {
        return Strictus::int($integer, $nullable);
    }
}

if (! function_exists('sn_int')) {
    function sn_int(mixed $integer)
    {
        return Strictus::nullableInt($integer);
    }
}

if (! function_exists('s_float')) {
    function s_float(mixed $float, bool $nullable = false)
    {
        return Strictus::float($float, $nullable);
    }
}

if (! function_exists('sn_float')) {
    function sn_float(mixed $float)
    {
        return Strictus::nullableFloat($float);
    }
}

if (! function_exists('s_bool')) {
    function s_bool(mixed $boolean, bool $nullable = false)
    {
        return Strictus::bool($boolean, $nullable);
    }
}

if (! function_exists('sn_bool')) {
    function sn_bool(mixed $boolean)
    {
        return Strictus::nullableBool($boolean);
    }
}

if (! function_exists('s_array')) {
    function s_array(mixed $array, bool $nullable = false)
    {
        return Strictus::array($array, $nullable);
    }
}

if (! function_exists('sn_array')) {
    function sn_array(mixed $array)
    {
        return Strictus::nullableArray($array);
    }
}

if (! function_exists('s_object')) {
    function s_object(mixed $object, bool $nullable = false)
    {
        return Strictus::object($object, $nullable);
    }
}

if (! function_exists('sn_object')) {
    function sn_object(mixed $object)
    {
        return Strictus::nullableObject($object);
    }
}

if (! function_exists('s_instance')) {
    function s_instance(string $instanceType, mixed $instance, bool $nullable = false)
    {
        return Strictus::instance($instanceType, $instance, $nullable);
    }
}

if (! function_exists('sn_instance')) {
    function sn_instance(string $instanceType, mixed $instance)
    {
        return Strictus::nullableInstance($instanceType, $instance);
    }
}
