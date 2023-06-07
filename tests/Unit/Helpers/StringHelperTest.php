<?php

use Strictus\Exceptions\StrictusTypeException;
use Strictus\Types\StrictusString;

it('instantiates variable')
    ->expect(fn () => s_string('foo'))
    ->toBeInstanceOf(StrictusString::class);

it('instantiates a nullable variable', function () {
    $value = s_string(null, true);
    expect($value)
        ->toBeInstanceOf(StrictusString::class);

    $value = sn_string(null);
    expect($value)
        ->toBeInstanceOf(StrictusString::class);
});

it('throws exception when trying to instantiate non-nullable variable with null', function () {
    expect(fn () => s_string(null))
        ->toThrow(StrictusTypeException::class);
});

it('throws exception when trying to instantiate variable with wrong type', function () {
    expect(fn () => s_string(10))
        ->toThrow(StrictusTypeException::class);
});

it('returns the value correctly', function () {
    $value = s_string('foo');

    expect($value->value)
        ->toBe('foo')
        ->and($value())
        ->toBe('foo');
});

it('updates the value correctly', function () {
    $value = s_string('foo');

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
