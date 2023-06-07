<?php

use Strictus\Exceptions\StrictusTypeException;
use Strictus\Types\StrictusInstance;

it('instantiates variable')
    ->expect(fn () => s_instance(MyClassA::class, new MyClassA()))
    ->toBeInstanceOf(StrictusInstance::class);

it('instantiates a nullable variable', function () {
    $value = s_instance(MyClassA::class, null, true);
    expect($value)
        ->toBeInstanceOf(StrictusInstance::class);

    $value = sn_instance(MyClassA::class, null);
    expect($value)
        ->toBeInstanceOf(StrictusInstance::class);
});

it('throws exception when trying to instantiate non-nullable variable with null', function () {
    expect(fn () => s_instance(MyClassA::class, null))
        ->toThrow(StrictusTypeException::class);
});

it('throws exception when trying to instantiate variable with wrong type', function () {
    expect(fn () => s_instance(MyClassA::class, 'foo'))
        ->toThrow(StrictusTypeException::class)
        ->and(fn () => s_instance(MyClassA::class, new TestClassA()))
        ->toThrow(StrictusTypeException::class);
});

it('returns the value correctly', function () {
    $value = s_instance(MyClassA::class, new MyClassA());

    expect($value->value)
        ->toBeInstanceOf(MyClassA::class)
        ->and($value())
        ->toBeInstanceOf(MyClassA::class);
});

it('updates the value correctly', function () {
    $value = s_instance(MyClassA::class, new MyClassA());

    expect($value->value)
        ->toBeInstanceOf(MyClassA::class)
        ->and($value())
        ->toBeInstanceOf(MyClassA::class);

    $value->value = new MyClassA();
    expect($value->value)
        ->toBeInstanceOf(MyClassA::class);

    $value(new MyClassA());
    expect($value())
        ->toBeInstanceOf(MyClassA::class);
});

class MyClassA
{
}

class TestClassA
{
}

class FooClassA
{
}
