<?php

use Strictus\Exceptions\StrictusTypeException;
use Strictus\Strictus;
use Strictus\Types\StrictusFloat;

it('instantiates variable')
    ->expect(fn () => Strictus::float(10.5))
    ->toBeInstanceOf(StrictusFloat::class);

it('instantiates a nullable variable', function () {
    $value = Strictus::float(null, true);
    expect($value)
        ->toBeInstanceOf(StrictusFloat::class);

    $value = Strictus::nullableFloat(null);
    expect($value)
        ->toBeInstanceOf(StrictusFloat::class);
});

it('throws exception when trying to instantiate non-nullable variable with null', function () {
    expect(fn () => Strictus::float(null))
        ->toThrow(StrictusTypeException::class);
});

it('throws exception when trying to instantiate variable with wrong type', function () {
    expect(fn () => Strictus::float('foo'))
        ->toThrow(StrictusTypeException::class);
});

it('returns the value correctly', function () {
    $value = Strictus::float(10.5);

    expect($value->value)
        ->toBe(10.5)
        ->and($value())
        ->toBe(10.5);
});

it('updates the value correctly', function () {
    $value = Strictus::float(10.5);

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
