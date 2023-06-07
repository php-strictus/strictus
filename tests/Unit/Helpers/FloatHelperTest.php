<?php

use Strictus\Exceptions\StrictusTypeException;
use Strictus\Types\StrictusFloat;

it('instantiates variable')
    ->expect(fn () => sfloat(10.5))
    ->toBeInstanceOf(StrictusFloat::class);

it('instantiates a nullable variable', function () {
    $value = sfloat(null, true);
    expect($value)
        ->toBeInstanceOf(StrictusFloat::class);

    $value = snfloat(null);
    expect($value)
        ->toBeInstanceOf(StrictusFloat::class);
});

it('throws exception when trying to instantiate non-nullable variable with null', function () {
    expect(fn () => sfloat(null))
        ->toThrow(StrictusTypeException::class);
});

it('throws exception when trying to instantiate variable with wrong type', function () {
    expect(fn () => sfloat('foo'))
        ->toThrow(StrictusTypeException::class);
});

it('returns the value correctly', function () {
    $value = sfloat(10.5);

    expect($value->value)
        ->toBe(10.5)
        ->and($value())
        ->toBe(10.5);
});

it('updates the value correctly', function () {
    $value = sfloat(10.5);

    expect($value->value)
        ->toBe(10.5)
        ->and($value())
        ->toBe(10.5);

    $value->value = 5.1;
    expect($value->value)
        ->toBe(5.1);

    $value(7.55);
    expect($value())
        ->toBe(7.55);
});
