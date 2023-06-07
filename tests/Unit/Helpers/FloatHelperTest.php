<?php

use Strictus\Exceptions\StrictusTypeException;
use Strictus\Types\StrictusFloat;

it('instantiates variable')
    ->expect(fn () => s_float(10.5))
    ->toBeInstanceOf(StrictusFloat::class);

it('instantiates a nullable variable', function () {
    $value = s_float(null, true);
    expect($value)
        ->toBeInstanceOf(StrictusFloat::class);

    $value = sn_float(null);
    expect($value)
        ->toBeInstanceOf(StrictusFloat::class);
});

it('throws exception when trying to instantiate non-nullable variable with null', function () {
    expect(fn () => s_float(null))
        ->toThrow(StrictusTypeException::class);
});

it('throws exception when trying to instantiate variable with wrong type', function () {
    expect(fn () => s_float('foo'))
        ->toThrow(StrictusTypeException::class);
});

it('returns the value correctly', function () {
    $value = s_float(10.5);

    expect($value->value)
        ->toBe(10.5)
        ->and($value())
        ->toBe(10.5);
});

it('updates the value correctly', function () {
    $value = s_float(10.5);

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
