<?php

declare(strict_types=1);

use Strictus\Exceptions\ImmutableStrictusException;
use Strictus\Exceptions\StrictusTypeException;
use Strictus\ImmutableStrictus;
use Strictus\Strictus;
use Strictus\Types\StrictusObject;

it('instantiates variable')
    ->expect(fn () => Strictus::object((object) ['foo' => 'bar']))
    ->toBeInstanceOf(StrictusObject::class);

it('instantiates a nullable variable', function () {
    $value = Strictus::object(null, true);
    expect($value)
        ->toBeInstanceOf(StrictusObject::class);

    $value = Strictus::nullableObject(null);
    expect($value)
        ->toBeInstanceOf(StrictusObject::class);
});

it('throws exception when trying to instantiate non-nullable variable with null', function () {
    expect(fn () => Strictus::object(null))
        ->toThrow(StrictusTypeException::class);
});

it('throws exception when trying to instantiate variable with wrong type', function () {
    expect(fn () => Strictus::object('foo'))
        ->toThrow(StrictusTypeException::class);
});

it('returns the value correctly', function () {
    $value = Strictus::object((object) ['foo' => 'bar']);

    expect($value->value)
        ->toEqual((object) ['foo' => 'bar'])
        ->and($value())
        ->toEqual((object) ['foo' => 'bar']);
});

it('updates the value correctly', function () {
    $value = Strictus::object((object) ['foo' => 'bar']);

    expect($value->value)
        ->toEqual((object) ['foo' => 'bar'])
        ->and($value())
        ->toEqual((object) ['foo' => 'bar']);

    $value->value = (object) ['test' => 'testing'];
    expect($value->value)
        ->toEqual((object) ['test' => 'testing']);

    $value((object) ['bar' => 'foo']);
    expect($value())
        ->toEqual((object) ['bar' => 'foo']);
});

it('can\'t updates the immutable value', function () {
    $value = ImmutableStrictus::object((object) ['foo' => 'bar']);

    expect($value->value)
        ->toEqual((object) ['foo' => 'bar'])
        ->and($value())
        ->toEqual((object) ['foo' => 'bar'])
        ->and(fn () => $value->value = (object) ['bar' => 'foo'])
        ->toThrow(ImmutableStrictusException::class)
        ->and(fn () => $value((object) ['bar' => 'foo']))
        ->toThrow(ImmutableStrictusException::class);
});

it('can clone a new variable', function () {
    $value = Strictus::object((object) ['foo' => 'bar']);
    $newValue = $value->clone((object) ['bar' => 'foo']);
    expect($value->value)
        ->toEqual((object) ['foo' => 'bar'])
        ->and($value())
        ->toEqual((object) ['foo' => 'bar'])
        ->and($newValue->value)
        ->toEqual((object) ['bar' => 'foo'])
        ->and($newValue())
        ->toEqual((object) ['bar' => 'foo']);

    $immutableValue = ImmutableStrictus::object((object) ['foo' => 'bar']);
    $newImmutableValue = $immutableValue->clone((object) ['bar' => 'foo']);
    expect($immutableValue->value)
        ->toEqual((object) ['foo' => 'bar'])
        ->and($immutableValue())
        ->toEqual((object) ['foo' => 'bar'])
        ->and($newImmutableValue->value)
        ->toEqual((object) ['bar' => 'foo'])
        ->and($newImmutableValue())
        ->toEqual((object) ['bar' => 'foo']);
});
