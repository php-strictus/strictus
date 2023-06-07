<?php

use Strictus\Exceptions\StrictusTypeException;
use Strictus\Types\StrictusArray;

it('instantiates variable')
    ->expect(fn () => s_array([1, 2, 3]))
    ->toBeInstanceOf(StrictusArray::class);

it('instantiates a nullable variable', function () {
    $value = s_array(null, true);
    expect($value)
        ->toBeInstanceOf(StrictusArray::class);

    $value = sn_array(null);
    expect($value)
        ->toBeInstanceOf(StrictusArray::class);
});

it('throws exception when trying to instantiate non-nullable variable with null', function () {
    expect(fn () => s_array(null))
        ->toThrow(StrictusTypeException::class);
});

it('throws exception when trying to instantiate variable with wrong type', function () {
    expect(fn () => s_array('foo'))
        ->toThrow(StrictusTypeException::class);
});

it('returns the value correctly', function () {
    $value = s_array([1, 2, 3]);

    expect($value->value)
        ->toEqualCanonicalizing([1, 2, 3])
        ->and($value())
        ->toEqualCanonicalizing([1, 2, 3]);
});

it('updates the value correctly', function () {
    $value = s_array([1, 2, 3]);

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
