<?php

use Strictus\Exceptions\StrictusTypeException;
use Strictus\Strictus;
use Strictus\Types\StrictusString;

it('instantiates a string variable', function () {
    $myString = Strictus::string('hello');
    expect($myString)
        ->toBeInstanceOf(StrictusString::class);
});

it('instantiates a nullable string variable with string method', function () {
    $myString = Strictus::string(null, true);
    expect($myString)
        ->toBeInstanceOf(StrictusString::class);
});

it('instantiates a nullable string variable with nullableStringeger method', function () {
    $myString = Strictus::nullableString(null);
    expect($myString)
        ->toBeInstanceOf(StrictusString::class);
});

it('throws exception when trying to instantiate a string as nullable with string method', function () {
    expect(fn () => Strictus::string(null))->toThrow(StrictusTypeException::class);
});

it('throws exception when trying to instantiate a string with wrong type', function () {
    expect(fn () => Strictus::string(3.14))->toThrow(StrictusTypeException::class);
});

it('returns value correctly', function () {
    $myString = Strictus::string('hello');

    expect($myString())->toEqual('hello')
        ->and($myString->value)->toEqual('hello')
        ->and($myString->get())->toEqual('hello');
});

it('changes value correctly', function () {
    $myString = Strictus::string('hello');

    $myString->value = 'goodbye';

    expect($myString())->toEqual('goodbye')
        ->and($myString->value)->toEqual('goodbye')
        ->and($myString->get())->toEqual('goodbye');

    $myString2 = Strictus::string('hello');
    $myString2('goodbye');

    expect($myString2())->toEqual('goodbye')
        ->and($myString2->value)->toEqual('goodbye')
        ->and($myString2->get())->toEqual('goodbye');

    $myString3 = Strictus::string('hello');
    $myString3->set('goodbye');

    expect($myString3())->toEqual('goodbye')
        ->and($myString3->value)->toEqual('goodbye')
        ->and($myString3->get())->toEqual('goodbye');
});