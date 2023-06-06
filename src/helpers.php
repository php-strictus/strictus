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
