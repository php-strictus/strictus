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
