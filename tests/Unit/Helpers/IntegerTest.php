<?php

use Strictus\Exceptions\StrictusTypeException;
use Strictus\Strictus;
use Strictus\Types\StrictusInteger;

it('instantiates variable')
    ->expect(fn () => sint(10))
    ->toBeInstanceOf(StrictusInteger::class);

it('instantiates a nullable variable', function () {
    $value = sint(null, true);
    expect($value)
        ->toBeInstanceOf(StrictusInteger::class);

    $value = snint(null);
    expect($value)
        ->toBeInstanceOf(StrictusInteger::class);
});

it('throws exception when trying to instantiate non-nullable variable with null', function () {
    expect(fn () => sint(null))
        ->toThrow(StrictusTypeException::class);
});

it('throws exception when trying to instantiate variable with wrong type', function () {
    expect(fn () => sint('foo'))
        ->toThrow(StrictusTypeException::class);
});

it('returns the value correctly', function () {
    $value = sint(10);

    expect($value->value)
        ->toBe(10)
        ->and($value())
        ->toBe(10);
});

it('updates the value correctly', function () {
    $value = sint(10);

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
