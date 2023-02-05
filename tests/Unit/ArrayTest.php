<?php

use Strictus\Exceptions\StrictusTypeException;
use Strictus\Strictus;
use Strictus\Types\StrictusArray;

it('instantiates an array variable', function () {
    $myArray = Strictus::array([1, 2, 3]);
    expect($myArray)
        ->toBeInstanceOf(StrictusArray::class);
});

it('instantiates a nullable array variable with array method', function () {
    $myArray = Strictus::array(null, true);
    expect($myArray)
        ->toBeInstanceOf(StrictusArray::class);
});

it('instantiates a nullable array variable with nullableArray method', function () {
    $myArray = Strictus::nullableArray(null);
    expect($myArray)
        ->toBeInstanceOf(StrictusArray::class);
});

it('throws exception when trying to instantiate an array as nullable with array method', function () {
    expect(Strictus::array(null))->toThrow(StrictusTypeException::class);
});