<?php

use Strictus\Exceptions\StrictusTypeException;
use Strictus\Strictus;
use Strictus\Types\StrictusBoolean;

it('instantiates a boolean variable', function () {
    $myArray = Strictus::boolean(true);
    expect($myArray)
        ->toBeInstanceOf(StrictusBoolean::class);
});

it('instantiates a nullable boolean variable with boolean method', function () {
    $myBoolean = Strictus::boolean(null, true);
    expect($myBoolean)
        ->toBeInstanceOf(StrictusBoolean::class);
});

it('instantiates a nullable boolean variable with nullableBoolean method', function () {
    $myBoolean = Strictus::nullableBoolean(null);
    expect($myBoolean)
        ->toBeInstanceOf(StrictusBoolean::class);
});

it('throws exception when trying to instantiate a boolean as nullable with boolean method', function () {
    expect(fn () => Strictus::boolean(null))->toThrow(StrictusTypeException::class);
});

it('throws exception when trying to instantiate a boolean with wrong type', function () {
    expect(fn () => Strictus::boolean('foo'))->toThrow(StrictusTypeException::class);
});

it('returns value correctly', function () {
    $myBoolean = Strictus::boolean(true);

    expect($myBoolean())->toBeTrue();
    expect($myBoolean->value)->toBeTrue();
    expect($myBoolean->get())->toBeTrue();
});

it('changes value correctly', function () {
    $myBoolean = Strictus::boolean(true);

    $myBoolean->value = false;

    expect($myBoolean())->toBeFalse()
        ->and($myBoolean->value)->toBeFalse()
        ->and($myBoolean->get())->toBeFalse();

    $myBoolean2 = Strictus::boolean(true);
    $myBoolean2(false);

    expect($myBoolean2())->toBeFalse()
        ->and($myBoolean2->value)->toBeFalse()
        ->and($myBoolean2->get())->toBeFalse();
});