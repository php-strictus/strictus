<?php

use Strictus\Exceptions\StrictusTypeException;
use Strictus\Types\StrictusString;

it('instantiates variable')
    ->expect(fn () => sstring('foo'))
    ->toBeInstanceOf(StrictusString::class);

it('instantiates a nullable variable', function () {
    $value = sstring(null, true);
    expect($value)
        ->toBeInstanceOf(StrictusString::class);

    $value = snstring(null);
    expect($value)
        ->toBeInstanceOf(StrictusString::class);
});

it('throws exception when trying to instantiate non-nullable variable with null', function () {
    expect(fn () => sstring(null))
        ->toThrow(StrictusTypeException::class);
});

it('throws exception when trying to instantiate variable with wrong type', function () {
    expect(fn () => sstring(10))
        ->toThrow(StrictusTypeException::class);
});

it('returns the value correctly', function () {
    $value = sstring('foo');

    expect($value->value)
        ->toBe('foo')
        ->and($value())
        ->toBe('foo');
});

it('updates the value correctly', function () {
    $value = sstring('foo');

    expect($value->value)
        ->toBe('foo')
        ->and($value())
        ->toBe('foo');

    $value->value = 'bar';
    expect($value->value)
        ->toBe('bar');

    $value('test');
    expect($value())
        ->toBe('test');
});
