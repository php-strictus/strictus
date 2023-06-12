<?php

declare(strict_types=1);

use Strictus\Exceptions\ImmutableStrictusException;
use Strictus\Exceptions\StrictusTypeException;
use Strictus\Strictus;
use Strictus\Types\StrictusString;

it('instantiates variable')
    ->expect(fn () => Strictus::string('foo'))
    ->toBeInstanceOf(StrictusString::class);

it('instantiates a nullable variable', function () {
    $value = Strictus::string(null, true);
    expect($value)
        ->toBeInstanceOf(StrictusString::class);

    $value = Strictus::nullableString(null);
    expect($value)
        ->toBeInstanceOf(StrictusString::class);
});

it('throws exception when trying to instantiate non-nullable variable with null', function () {
    expect(fn () => Strictus::string(null))
        ->toThrow(StrictusTypeException::class);
});

it('throws exception when trying to instantiate variable with wrong type', function () {
    expect(fn () => Strictus::string(10))
        ->toThrow(StrictusTypeException::class);
});

it('returns the value correctly', function () {
    $value = Strictus::string('foo');

    expect($value->value)
        ->toBe('foo')
        ->and($value())
        ->toBe('foo');
});

it('updates the value correctly', function () {
    $value = Strictus::string('foo');

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

it('can\'t updates the immutable value', function () {
    $value = Strictus::string('foo')->immutable();

    expect($value->value)
        ->toEqual('foo')
        ->and($value())
        ->toEqual('foo')
        ->and(fn () => $value->value = 'bar')
        ->toThrow(ImmutableStrictusException::class)
        ->and(fn () => $value('bar'))
        ->toThrow(ImmutableStrictusException::class);
});
