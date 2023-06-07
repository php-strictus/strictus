<?php

use Strictus\Exceptions\StrictusTypeException;
use Strictus\Types\StrictusBoolean;

it('instantiates variable')
    ->expect(fn () => sbool(true))
    ->toBeInstanceOf(StrictusBoolean::class);

it('instantiates a nullable variable', function () {
    $value = sbool(null, true);
    expect($value)
        ->toBeInstanceOf(StrictusBoolean::class);

    $value = snbool(null);
    expect($value)
        ->toBeInstanceOf(StrictusBoolean::class);
});

it('throws exception when trying to instantiate non-nullable variable with null', function () {
    expect(fn () => sbool(null))
        ->toThrow(StrictusTypeException::class);
});

it('throws exception when trying to instantiate variable with wrong type', function () {
    expect(fn () => sbool('foo'))
        ->toThrow(StrictusTypeException::class);
});

it('returns the value correctly', function () {
    $value = sbool(true);

    expect($value->value)
        ->toBeTrue()
        ->and($value())
        ->toBeTrue();
});

it('updates the value correctly', function () {
    $value = sbool(true);

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
