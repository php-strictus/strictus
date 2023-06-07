<?php

use Strictus\Exceptions\StrictusTypeException;
use Strictus\Strictus;
use Strictus\Types\StrictusEnum;

it('instantiates variable')
    ->expect(fn () => Strictus::enum(MyEnum::class, MyEnum::BAR))
    ->toBeInstanceOf(StrictusEnum::class);

it('instantiates a nullable variable', function () {
    $value = Strictus::enum(MyEnum::class, null, true);
    expect($value)
        ->toBeInstanceOf(StrictusEnum::class);

    $value = Strictus::nullableEnum(MyEnum::class, null);
    expect($value)
        ->toBeInstanceOf(StrictusEnum::class);

});

it('throws exception when trying to instantiate variable with wrong enum type', function () {
    expect(fn () => Strictus::enum('foo', MyEnum::FOO))
        ->toThrow(StrictusTypeException::class);
});

it('throws exception when trying to instantiate non-nullable variable with null', function () {
    expect(fn () => Strictus::enum(MyClass::class, null))
        ->toThrow(StrictusTypeException::class);
});

it('throws exception when trying to instantiate variable with wrong enum', function () {
    expect(fn () => Strictus::enum(MyEnum::class, 'foo'))
        ->toThrow(StrictusTypeException::class);
});

it('returns the value correctly', function () {
    $value = Strictus::enum(MyEnum::class, MyEnum::FOO);

    expect($value->value)
        ->toBeInstanceOf(MyEnum::class)
        ->and($value())
        ->toBeInstanceOf(MyEnum::class);
});

it('updates the value correctly', function () {
    $value = Strictus::enum(MyEnum::class, MyEnum::FOO);

    expect($value->value)
        ->toBeInstanceOf(MyEnum::class)
        ->toEqual(MyEnum::FOO)
        ->and($value())
        ->toBeInstanceOf(MyEnum::class)
        ->toEqual(MyEnum::FOO);

    $value->value = MyEnum::BAR;
    expect($value->value)
        ->toBeInstanceOf(MyEnum::class);

    $value(MyEnum::BAR);
    expect($value())
        ->toBeInstanceOf(MyEnum::class);
});

it('updates the nullable value to enum correctly', function () {
    $value = Strictus::nullableEnum(MyEnum::class, null);

    expect($value->value)
        ->toBeNull()
        ->and($value())
        ->toBeNull();

    $value->value = MyEnum::BAR;
    expect($value->value)
        ->toBeInstanceOf(MyEnum::class);

    $value(MyEnum::BAR);
    expect($value())
        ->toBeInstanceOf(MyEnum::class);
});

it('updates the enum value to nullable correctly', function () {
    $value = Strictus::enum(MyEnum::class, MyEnum::FOO, true);

    expect($value->value)
        ->toBeInstanceOf(MyEnum::class)
        ->toEqual(MyEnum::FOO)
        ->and($value())
        ->toBeInstanceOf(MyEnum::class)
        ->toEqual(MyEnum::FOO);

    $value->value = null;
    expect($value->value)
        ->toBeNull();

    $value(null);
    expect($value())
        ->toBeNull();
});

enum MyEnum
{
    case FOO;
    case BAR;
}
