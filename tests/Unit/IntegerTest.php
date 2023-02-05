<?php

use Strictus\Exceptions\StrictusTypeException;
use Strictus\Strictus;
use Strictus\Types\StrictusInteger;

it('instantiates a integer variable', function () {
    $myInt = Strictus::int(3);
    expect($myInt)
        ->toBeInstanceOf(StrictusInteger::class);
});

it('instantiates a nullable integer variable with integer method', function () {
    $myInt = Strictus::int(null, true);
    expect($myInt)
        ->toBeInstanceOf(StrictusInteger::class);
});

it('instantiates a nullable integer variable with nullableinteger method', function () {
    $myInt = Strictus::nullableInt(null);
    expect($myInt)
        ->toBeInstanceOf(StrictusInteger::class);
});

it('throws exception when trying to instantiate a integer as nullable with integer method', function () {
    expect(fn () => Strictus::int(null))->toThrow(StrictusTypeException::class);
});

it('throws exception when trying to instantiate a integer with wrong type', function () {
    expect(fn () => Strictus::int('foo'))->toThrow(StrictusTypeException::class);
});

it('returns value correctly', function () {
    $myInt = Strictus::int(3);

    expect($myInt())->toEqual(3)->and($myInt->value)->toEqual(3);
});

it('changes value correctly', function () {
    $myInt = Strictus::int(3);

    $myInt->value = 1;

    expect($myInt())->toEqual(1)
        ->and($myInt->value)->toEqual(1)
        ->and($myInt->value)->toEqual(1);

    $myInt2 = Strictus::int(3);
    $myInt2(1);

    expect($myInt2())->toEqual(1)
        ->and($myInt2->value)->toEqual(1)
        ->and($myInt2->get())->toEqual(1);

    $myInt3 = Strictus::int(3);
    $myInt3->set(1);

    expect($myInt3())->toEqual(1)
        ->and($myInt3->value)->toEqual(1)
        ->and($myInt3->get())->toEqual(1);
});