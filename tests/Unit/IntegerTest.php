<?php

declare(strict_types=1);

use Strictus\Exceptions\ImmutableStrictusException;
use Strictus\Exceptions\StrictusTypeException;
use Strictus\ImmutableStrictus;
use Strictus\Strictus;
use Strictus\Types\StrictusInteger;

it('instantiates variable')
    ->expect(fn () => Strictus::int(10))
    ->toBeInstanceOf(StrictusInteger::class);

it('instantiates a nullable variable', function () {
    $value = Strictus::int(null, true);
    expect($value)
        ->toBeInstanceOf(StrictusInteger::class);

    $value = Strictus::nullableInt(null);
    expect($value)
        ->toBeInstanceOf(StrictusInteger::class);
});

it('throws exception when trying to instantiate non-nullable variable with null', function () {
    expect(fn () => Strictus::int(null))
        ->toThrow(StrictusTypeException::class);
});

it('throws exception when trying to instantiate variable with wrong type', function () {
    expect(fn () => Strictus::int('foo'))
        ->toThrow(StrictusTypeException::class);
});

it('returns the value correctly', function () {
    $value = Strictus::int(10);

    expect($value->value)
        ->toBe(10)
        ->and($value())
        ->toBe(10);
});

it('updates the value correctly', function () {
    $value = Strictus::int(10);

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

it('can\'t updates the immutable value', function () {
    $value = ImmutableStrictus::int(10);

    expect($value->value)
        ->toBe(10)
        ->and($value())
        ->toBe(10)
        ->and(fn () => $value->value = 5)
        ->toThrow(ImmutableStrictusException::class)
        ->and(fn () => $value(7))
        ->toThrow(ImmutableStrictusException::class);
});

it('can clone a new variable', function () {
    $value = Strictus::int(10);
    $newValue = $value->clone(12);

    expect($value->value)
        ->toEqual(10)
        ->and($value())
        ->toEqual(10)
        ->and($newValue->value)
        ->toEqual(12)
        ->and($newValue())
        ->toEqual(12);

    $immutableValue = ImmutableStrictus::int(10);
    $newImmutableValue = $value->clone(12);

    expect($immutableValue->value)
        ->toEqual(10)
        ->and($immutableValue())
        ->toEqual(10)
        ->and($newImmutableValue->value)
        ->toEqual(12)
        ->and($newImmutableValue())
        ->toEqual(12);
});
