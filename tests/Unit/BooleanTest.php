<?php

use Strictus\Exceptions\StrictusTypeException;
use Strictus\Strictus;
use Strictus\Types\StrictusBoolean;

it('instantiates a boolean variable', function () {
    $myArray = Strictus::boolean(true);
    expect($myArray)
        ->toBeInstanceOf(StrictusBoolean::class);
});

it('instantiates a nullable boolean variable with boolean method', function () {
    $myArray = Strictus::boolean(null, true);
    expect($myArray)
        ->toBeInstanceOf(StrictusBoolean::class);
});

it('instantiates a nullable boolean variable with nullableBoolean method', function () {
    $myArray = Strictus::nullableBoolean(null);
    expect($myArray)
        ->toBeInstanceOf(StrictusBoolean::class);
});

it('throws exception when trying to instantiate a boolean as nullable with boolean method', function () {
    expect(Strictus::boolean(null))->toThrow(StrictusTypeException::class);
});

it('throws exception when trying to instantiate a boolean with wrong type', function () {
    expect(Strictus::boolean('foo'))->toThrow(StrictusTypeException::class);
});
