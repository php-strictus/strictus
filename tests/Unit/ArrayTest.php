<?php

declare(strict_types=1);

use Strictus\Exceptions\ImmutableStrictusException;
use Strictus\Exceptions\StrictusTypeException;
use Strictus\Strictus;
use Strictus\Types\StrictusArray;

it('instantiates variable')
    ->expect(fn () => Strictus::array([1, 2, 3]))
    ->toBeInstanceOf(StrictusArray::class);

it('instantiates a nullable variable', function () {
    $value = Strictus::array(null, true);
    expect($value)
        ->toBeInstanceOf(StrictusArray::class);

    $value = Strictus::nullableArray(null);
    expect($value)
        ->toBeInstanceOf(StrictusArray::class);
});

it('throws exception when trying to instantiate non-nullable variable with null', function () {
    expect(fn () => Strictus::array(null))
        ->toThrow(StrictusTypeException::class);
});

it('throws exception when trying to instantiate variable with wrong type', function () {
    expect(fn () => Strictus::array('foo'))
        ->toThrow(StrictusTypeException::class);
});

it('returns the value correctly', function () {
    $value = Strictus::array([1, 2, 3]);

    expect($value->value)
        ->toEqualCanonicalizing([1, 2, 3])
        ->and($value())
        ->toEqualCanonicalizing([1, 2, 3]);
});

it('updates the value correctly', function () {
    $value = Strictus::array([1, 2, 3]);

    expect($value->value)
        ->toEqualCanonicalizing([1, 2, 3])
        ->and($value())
        ->toEqualCanonicalizing([1, 2, 3]);

    $value->value = [4, 5, 6];
    expect($value->value)
        ->toEqualCanonicalizing([4, 5, 6]);

    $value([7, 8, 9]);
    expect($value())
        ->toEqualCanonicalizing([7, 8, 9]);
});

it('can\'t updates the immutable value', function () {
    $value = Strictus::array([1, 2, 3])->immutable();

    expect($value->value)
        ->toBe([1, 2, 3])
        ->and($value())
        ->toBe([1, 2, 3])
        ->and(fn () => $value->value = [4, 5, 6])
        ->toThrow(ImmutableStrictusException::class)
        ->and(fn () => $value([4, 5, 6]))
        ->toThrow(ImmutableStrictusException::class);
});
