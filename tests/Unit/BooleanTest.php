<?php

declare(strict_types=1);

use Strictus\Exceptions\ImmutableStrictusException;
use Strictus\Exceptions\StrictusTypeException;
use Strictus\Strictus;
use Strictus\Types\StrictusBoolean;

it('instantiates variable')
    ->expect(fn () => Strictus::bool(true))
    ->toBeInstanceOf(StrictusBoolean::class);

it('instantiates a nullable variable', function () {
    $value = Strictus::bool(null, true);
    expect($value)
        ->toBeInstanceOf(StrictusBoolean::class);

    $value = Strictus::nullableBool(null);
    expect($value)
        ->toBeInstanceOf(StrictusBoolean::class);
});

it('throws exception when trying to instantiate non-nullable variable with null', function () {
    expect(fn () => Strictus::bool(null))
        ->toThrow(StrictusTypeException::class);
});

it('throws exception when trying to instantiate variable with wrong type', function () {
    expect(fn () => Strictus::bool('foo'))
        ->toThrow(StrictusTypeException::class);
});

it('returns the value correctly', function () {
    $value = Strictus::bool(true);

    expect($value->value)
        ->toBeTrue()
        ->and($value())
        ->toBeTrue();
});

it('updates the value correctly', function () {
    $value = Strictus::bool(true);

    expect($value->value)
        ->toBeTrue()
        ->and($value())
        ->toBeTrue();

    $value->value = false;
    expect($value->value)
        ->toBeFalse();

    $value(true);
    expect($value())
        ->toBeTrue();
});

it('can\'t updates the immutable value', function () {
    $value = Strictus::bool(true)->immutable();

    expect($value->value)
        ->toBe(true)
        ->and($value())
        ->toBe(true)
        ->and(fn () => $value->value = false)
        ->toThrow(ImmutableStrictusException::class)
        ->and(fn () => $value(false))
        ->toThrow(ImmutableStrictusException::class);
});
