<?php

use Strictus\Exceptions\StrictusTypeException;
use Strictus\Strictus;
use Strictus\Types\StrictusFloat;

it('instantiates a float variable', function () {
    $myFloat = Strictus::float(3.14);
    expect($myFloat)
        ->toBeInstanceOf(StrictusFloat::class);
});

it('instantiates a nullable float variable with float method', function () {
    $myFloat = Strictus::float(null, true);
    expect($myFloat)
        ->toBeInstanceOf(StrictusFloat::class);
});

it('instantiates a nullable boolean variable with nullableBoolean method', function () {
    $myFloat = Strictus::nullableFloat(null);
    expect($myFloat)
        ->toBeInstanceOf(StrictusFloat::class);
});

it('throws exception when trying to instantiate a boolean as nullable with boolean method', function () {
    expect(fn () => Strictus::float(null))->toThrow(StrictusTypeException::class);
});

it('throws exception when trying to instantiate a boolean with wrong type', function () {
    expect(fn () => Strictus::float('foo'))->toThrow(StrictusTypeException::class);
});

it('returns value correctly', function () {
    $myFloat = Strictus::float(3.14);

    expect($myFloat())->toEqual(3.14)->and($myFloat->value)->toEqual(3.14);
});

it('changes value correctly', function () {
    $myFloat = Strictus::float(3.14);

    $myFloat->value = 1.12;

    expect($myFloat())->toEqual(1.12)->and($myFloat->value)->toEqual(1.12);

    $myFloat2 = Strictus::float(3.14);
    $myFloat2(1.12);

    expect($myFloat2())->toEqual(1.12)->and($myFloat2->value)->toEqual(1.12);
});