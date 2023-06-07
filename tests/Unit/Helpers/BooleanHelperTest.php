<?php

use Strictus\Exceptions\StrictusTypeException;
use Strictus\Types\StrictusBoolean;

it('instantiates variable')
    ->expect(fn () => s_bool(true))
    ->toBeInstanceOf(StrictusBoolean::class);

it('instantiates a nullable variable', function () {
    $value = s_bool(null, true);
    expect($value)
        ->toBeInstanceOf(StrictusBoolean::class);

    $value = sn_bool(null);
    expect($value)
        ->toBeInstanceOf(StrictusBoolean::class);
});

it('throws exception when trying to instantiate non-nullable variable with null', function () {
    expect(fn () => s_bool(null))
        ->toThrow(StrictusTypeException::class);
});

it('throws exception when trying to instantiate variable with wrong type', function () {
    expect(fn () => s_bool('foo'))
        ->toThrow(StrictusTypeException::class);
});

it('returns the value correctly', function () {
    $value = s_bool(true);

    expect($value->value)
        ->toBeTrue()
        ->and($value())
        ->toBeTrue();
});

it('updates the value correctly', function () {
    $value = s_bool(true);

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
