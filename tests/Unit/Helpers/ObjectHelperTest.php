<?php

use Strictus\Exceptions\StrictusTypeException;
use Strictus\Types\StrictusObject;

it('instantiates variable')
    ->expect(fn () => s_object((object) ['foo' => 'bar']))
    ->toBeInstanceOf(StrictusObject::class);

it('instantiates a nullable variable', function () {
    $value = s_object(null, true);
    expect($value)
        ->toBeInstanceOf(StrictusObject::class);

    $value = sn_object(null);
    expect($value)
        ->toBeInstanceOf(StrictusObject::class);
});

it('throws exception when trying to instantiate non-nullable variable with null', function () {
    expect(fn () => s_object(null))
        ->toThrow(StrictusTypeException::class);
});

it('throws exception when trying to instantiate variable with wrong type', function () {
    expect(fn () => s_object('foo'))
        ->toThrow(StrictusTypeException::class);
});

it('returns the value correctly', function () {
    $value = s_object((object) ['foo' => 'bar']);

    expect($value->value)
        ->toEqual((object) ['foo' => 'bar'])
        ->and($value())
        ->toEqual((object) ['foo' => 'bar']);
});

it('updates the value correctly', function () {
    $value = s_object((object) ['foo' => 'bar']);

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
