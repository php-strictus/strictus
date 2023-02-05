<?php

use Strictus\Exceptions\StrictusTypeException;
use Strictus\Strictus;
use Strictus\Types\StrictusString;

it('instantiates a string variable', function () {
    $myInt = Strictus::string('hello');
    expect($myInt)
        ->toBeInstanceOf(StrictusString::class);
});

it('instantiates a nullable string variable with string method', function () {
    $myInt = Strictus::string(null, true);
    expect($myInt)
        ->toBeInstanceOf(StrictusString::class);
});

it('instantiates a nullable string variable with nullableStringeger method', function () {
    $myInt = Strictus::nullableString(null);
    expect($myInt)
        ->toBeInstanceOf(StrictusString::class);
});

it('throws exception when trying to instantiate a string as nullable with string method', function () {
    expect(fn () => Strictus::string(null))->toThrow(StrictusTypeException::class);
});

it('throws exception when trying to instantiate a string with wrong type', function () {
    expect(fn () => Strictus::string(3.14))->toThrow(StrictusTypeException::class);
});

it('returns value correctly', function () {
    $myInt = Strictus::string('hello');

    expect($myInt())->toEqual('hello')->and($myInt->value)->toEqual('hello');
});

it('changes value correctly', function () {
    $myInt = Strictus::string('hello');

    $myInt->value = 'goodbye';

    expect($myInt())->toEqual('goodbye')->and($myInt->value)->toEqual('goodbye');

    $myInt2 = Strictus::string('hello');
    $myInt2('goodbye');

    expect($myInt2())->toEqual('goodbye')->and($myInt2->value)->toEqual('goodbye');
});