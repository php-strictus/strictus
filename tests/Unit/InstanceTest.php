<?php

use Strictus\Exceptions\StrictusTypeException;
use Strictus\Strictus;
use Strictus\Types\StrictusInstance;
use Strictus\Tests\Mocks\MockClassOne;
use Strictus\Tests\Mocks\MockClassTwo;

it('instantiates a string variable', function () {
    $myObject = Strictus::instance(new MockClassOne());
    expect($myObject)
        ->toBeInstanceOf(StrictusInstance::class);
});

it('instantiates a nullable string variable with string method', function () {
    $myObject = Strictus::instance(null, true);
    expect($myObject)
        ->toBeInstanceOf(StrictusInstance::class);
});

it('instantiates a nullable string variable with nullableObject method', function () {
    $myObject = Strictus::nullableInstance(null);
    expect($myObject)
        ->toBeInstanceOf(StrictusInstance::class);
});

it('throws exception when trying to instantiate a string as nullable with string method', function () {
    expect(fn() => Strictus::instance(null))->toThrow(TypeError::class);
});

it('throws exception when trying to instantiate a string with wrong type', function () {
    expect(fn() => Strictus::instance(3.14))
        ->toThrow(TypeError::class);
});

it('returns value correctly', function () {
    $myObject = Strictus::instance(new MockClassOne());

    expect($myObject())->toEqual(new MockClassOne())
        ->and($myObject->value)->toEqual(new MockClassOne())
        ->and($myObject->get())->toEqual(new MockClassOne());
});

it('changes value correctly', function () {
    $myObject = Strictus::instance(new MockClassOne());

    $myObject->value = new MockClassTwo();

    expect($myObject())->toEqual(new MockClassTwo())
        ->and($myObject->value)->toEqual(new MockClassTwo())
        ->and($myObject->get())->toEqual(new MockClassTwo());

    $myObject2 = Strictus::instance(new MockClassOne());
    $myObject2(new MockClassTwo());

    expect($myObject2())->toEqual(new MockClassTwo())
        ->and($myObject2->value)->toEqual(new MockClassTwo())
        ->and($myObject2->get())->toEqual(new MockClassTwo());

    $myObject3 = Strictus::instance(new MockClassOne());
    $myObject3->set(new MockClassTwo());

    expect($myObject3())->toEqual(new MockClassTwo())
        ->and($myObject3->value)->toEqual(new MockClassTwo())
        ->and($myObject3->get())->toEqual(new MockClassTwo());
});