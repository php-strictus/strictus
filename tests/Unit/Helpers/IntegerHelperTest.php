<?php

use Strictus\Exceptions\StrictusTypeException;
use Strictus\Types\StrictusInteger;

it('instantiates variable')
    ->expect(fn () => s_int(10))
    ->toBeInstanceOf(StrictusInteger::class);

it('instantiates a nullable variable', function () {
    $value = s_int(null, true);
    expect($value)
        ->toBeInstanceOf(StrictusInteger::class);

    $value = sn_int(null);
    expect($value)
        ->toBeInstanceOf(StrictusInteger::class);
});

it('throws exception when trying to instantiate non-nullable variable with null', function () {
    expect(fn () => s_int(null))
        ->toThrow(StrictusTypeException::class);
});

it('throws exception when trying to instantiate variable with wrong type', function () {
    expect(fn () => s_int('foo'))
        ->toThrow(StrictusTypeException::class);
});

it('returns the value correctly', function () {
    $value = s_int(10);

    expect($value->value)
        ->toBe(10)
        ->and($value())
        ->toBe(10);
});

it('updates the value correctly', function () {
    $value = s_int(10);

    expect($value->value)
        ->toBe(10)
        ->and($value())
        ->toBe(10);

    $value->value = 5;
    expect($value->value)
        ->toBe(5);

    $value(7);
    expect($value())
        ->toBe(7);
});
