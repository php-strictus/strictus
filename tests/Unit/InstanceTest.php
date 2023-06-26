<?php

declare(strict_types=1);

use Strictus\Exceptions\ImmutableStrictusException;
use Strictus\Exceptions\StrictusTypeException;
use Strictus\Strictus;
use Strictus\Types\StrictusInstance;

it('instantiates variable')
    ->expect(fn () => Strictus::instance(MyClass::class, new MyClass()))
    ->toBeInstanceOf(StrictusInstance::class);

it('instantiates a nullable variable', function () {
    $value = Strictus::instance(MyClass::class, null, true);
    expect($value)
        ->toBeInstanceOf(StrictusInstance::class);

    $value = Strictus::nullableInstance(MyClass::class, null);
    expect($value)
        ->toBeInstanceOf(StrictusInstance::class);
});

it('throws exception when trying to instantiate non-nullable variable with null', function () {
    expect(fn () => Strictus::instance(MyClass::class, null))
        ->toThrow(StrictusTypeException::class);
});

it('throws exception when trying to instantiate variable with wrong type', function () {
    expect(fn () => Strictus::instance(MyClass::class, 'foo'))
        ->toThrow(StrictusTypeException::class)
        ->and(fn () => Strictus::instance(MyClass::class, new TestClass()))
        ->toThrow(StrictusTypeException::class);
});

it('returns the value correctly', function () {
    $value = Strictus::instance(MyClass::class, new MyClass());

    expect($value->value)
        ->toBeInstanceOf(MyClass::class)
        ->and($value())
        ->toBeInstanceOf(MyClass::class);
});

it('updates the value correctly', function () {
    $value = Strictus::instance(MyClass::class, new MyClass());

    expect($value->value)
        ->toBeInstanceOf(MyClass::class)
        ->and($value())
        ->toBeInstanceOf(MyClass::class);

    $value->value = new MyClass();
    expect($value->value)
        ->toBeInstanceOf(MyClass::class);

    $value(new MyClass());
    expect($value())
        ->toBeInstanceOf(MyClass::class);
});

it('can\'t updates the immutable value', function () {
    $value = Strictus::instance(MyClass::class, new MyClass())->immutable();

    expect($value->value)
        ->toBeInstanceOf(MyClass::class)
        ->and($value())
        ->toBeInstanceOf(MyClass::class)
        ->and(fn () => $value->value = new MyClass())
        ->toThrow(ImmutableStrictusException::class)
        ->and(fn () => $value(new MyClass()))
        ->toThrow(ImmutableStrictusException::class);
});

it('immutable instance', function () {
    $counter = new Counter();
    $value = Strictus::instance(Counter::class, $counter);
    expect($value->value)
        ->toBeInstanceOf(Counter::class)
        ->and($value())
        ->toBeInstanceOf(Counter::class)
        ->and($value()->getCount())
        ->toBe(1);

    $counter->increment();
    expect($value()->getCount())
        ->toBe(1);
});

class MyClass
{
}

class TestClass
{
}

class FooClass
{
}

class Counter
{
    private int $count = 1;

    public function increment(): self
    {
        $this->count++;

        return $this;
    }

    public function getCount(): int
    {
        return $this->count;
    }
}
