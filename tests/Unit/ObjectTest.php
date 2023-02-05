<?php

use Strictus\Exceptions\StrictusTypeException;
use Strictus\Strictus;
use Strictus\Types\StrictusObject;

it('instantiates a string variable', function () {
    $myObject = Strictus::object(new stdClass());
    expect($myObject)
        ->toBeInstanceOf(StrictusObject::class);
});

it('instantiates a nullable string variable with string method', function () {
    $myObject = Strictus::object(null, true);
    expect($myObject)
        ->toBeInstanceOf(StrictusObject::class);
});

it('instantiates a nullable string variable with nullableObject method', function () {
    $myObject = Strictus::nullableObject(null);
    expect($myObject)
        ->toBeInstanceOf(StrictusObject::class);
});

it('throws exception when trying to instantiate a string as nullable with string method', function () {
    expect(fn () => Strictus::object(null))->toThrow(StrictusTypeException::class);
});

it('throws exception when trying to instantiate a string with wrong type', function () {
    expect(fn () => Strictus::object(3.14))->toThrow(StrictusTypeException::class);
});

it('returns value correctly', function () {
    $myObject = Strictus::object(new stdClass());

    expect($myObject())->toEqual(new stdClass())
        ->and($myObject->value)->toEqual(new stdClass())
        ->and($myObject->get())->toEqual(new stdClass());
});

it('changes value correctly', function () {
    $myObject = Strictus::object(new stdClass());

    $myObject->value = new Exception();

    expect($myObject())->toEqual(new Exception())
        ->and($myObject->value)->toEqual(new Exception())
        ->and($myObject->get())->toEqual(new Exception());

    $myObject2 = Strictus::object(new stdClass());
    $myObject2(new Exception());

    expect($myObject2())->toEqual(new Exception())
        ->and($myObject2->value)->toEqual(new Exception())
        ->and($myObject2->get())->toEqual(new Exception());

    $myObject3 = Strictus::object(new stdClass());
    $myObject3->set(new Exception());

    expect($myObject3())->toEqual(new Exception())
        ->and($myObject3->value)->toEqual(new Exception())
        ->and($myObject3->get())->toEqual(new Exception());
});