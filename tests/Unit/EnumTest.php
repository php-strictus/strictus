<?php

declare(strict_types=1);

use Strictus\Exceptions\ImmutableStrictusException;
use Strictus\Exceptions\StrictusTypeException;
use Strictus\ImmutableStrictus;
use Strictus\Strictus;
use Strictus\Types\StrictusEnum;

it('instantiates variable', function () {
    expect(Strictus::enum(MyEnum::class, MyEnum::BAR))
        ->toBeInstanceOf(StrictusEnum::class)
        ->and(Strictus::enum(MyBackedEnum::class, MyBackedEnum::BAZ))
        ->toBeInstanceOf(StrictusEnum::class);
});

it('instantiates a nullable variable', function () {
    expect(Strictus::enum(MyEnum::class, null, true))
        ->toBeInstanceOf(StrictusEnum::class)
        ->and(Strictus::nullableEnum(MyEnum::class, null))
        ->toBeInstanceOf(StrictusEnum::class)
        ->and(Strictus::enum(MyBackedEnum::class, null, true))
        ->toBeInstanceOf(StrictusEnum::class)
        ->and(Strictus::nullableEnum(MyBackedEnum::class, null))
        ->toBeInstanceOf(StrictusEnum::class);
});

it('throws exception when trying to instantiate variable with wrong enum type', function () {
    expect(fn () => Strictus::enum('foo', MyEnum::FOO))
        ->toThrow(StrictusTypeException::class);
});

it('throws exception when trying to instantiate non-nullable variable with null', function () {
    expect(fn () => Strictus::enum(MyClass::class, null))
        ->toThrow(StrictusTypeException::class)
        ->and(fn () => Strictus::enum(MyBackedEnum::class, null))
        ->toThrow(StrictusTypeException::class);
});

it('throws exception when trying to instantiate variable with wrong enum', function () {
    expect(fn () => Strictus::enum(MyEnum::class, 'foo'))
        ->toThrow(StrictusTypeException::class)
        ->and(fn () => Strictus::enum(MyBackedEnum::class, 'foo'))
        ->toThrow(StrictusTypeException::class);
});

it('returns the value correctly', function () {
    $value = Strictus::enum(MyEnum::class, MyEnum::FOO);

    expect($value)
        ->toBeInstanceOf(StrictusEnum::class)
        ->and($value->value)
        ->toBeInstanceOf(MyEnum::class)
        ->toEqual(MyEnum::FOO)
        ->and($value->value->name)
        ->toEqual(MyEnum::FOO->name)
        ->and($value())
        ->toBeInstanceOf(MyEnum::class)
        ->toEqual(MyEnum::FOO)
        ->and($value()->name)
        ->toEqual(MyEnum::FOO->name);

    $backedEnumValue = Strictus::enum(MyBackedEnum::class, MyBackedEnum::BAZ);

    expect($backedEnumValue)
        ->toBeInstanceOf(StrictusEnum::class)
        ->and($backedEnumValue->value)
        ->toBeInstanceOf(MyBackedEnum::class)
        ->toEqual(MyBackedEnum::BAZ)
        ->and($backedEnumValue->value->name)
        ->toEqual(MyBackedEnum::BAZ->name)
        ->and($backedEnumValue->value->value)
        ->toEqual(MyBackedEnum::BAZ->value)
        ->and($backedEnumValue())
        ->toBeInstanceOf(MyBackedEnum::class)
        ->toEqual(MyBackedEnum::BAZ)
        ->and($backedEnumValue()->name)
        ->toEqual(MyBackedEnum::BAZ->name)
        ->and($backedEnumValue()->value)
        ->toEqual(MyBackedEnum::BAZ->value);
});

it('updates the value correctly', function () {
    $value = Strictus::enum(MyEnum::class, MyEnum::FOO);

    expect($value)
        ->toBeInstanceOf(StrictusEnum::class)
        ->and($value->value)
        ->toBeInstanceOf(MyEnum::class)
        ->toEqual(MyEnum::FOO)
        ->and($value->value->name)
        ->toEqual(MyEnum::FOO->name)
        ->and($value())
        ->toBeInstanceOf(MyEnum::class)
        ->toEqual(MyEnum::FOO)
        ->and($value()->name)
        ->toEqual(MyEnum::FOO->name);

    $value->value = MyEnum::BAR;
    expect($value->value)
        ->toBeInstanceOf(MyEnum::class)
        ->toEqual(MyEnum::BAR)
        ->and($value->value->name)
        ->toEqual(MyEnum::BAR->name);

    $value(MyEnum::BAR);
    expect($value())
        ->toBeInstanceOf(MyEnum::class)
        ->toEqual(MyEnum::BAR)
        ->and($value()->name)
        ->toEqual(MyEnum::BAR->name);

    $backedEnumValue = Strictus::enum(MyBackedEnum::class, MyBackedEnum::BAZ);

    expect($backedEnumValue)
        ->toBeInstanceOf(StrictusEnum::class)
        ->and($backedEnumValue->value)
        ->toBeInstanceOf(MyBackedEnum::class)
        ->toEqual(MyBackedEnum::BAZ)
        ->and($backedEnumValue->value->name)
        ->toEqual(MyBackedEnum::BAZ->name)
        ->and($backedEnumValue->value->value)
        ->toEqual(MyBackedEnum::BAZ->value)
        ->and($backedEnumValue())
        ->toBeInstanceOf(MyBackedEnum::class)
        ->toEqual(MyBackedEnum::BAZ)
        ->and($backedEnumValue()->name)
        ->toEqual(MyBackedEnum::BAZ->name)
        ->and($backedEnumValue()->value)
        ->toEqual(MyBackedEnum::BAZ->value);

    $backedEnumValue->value = MyBackedEnum::BAZZ;
    expect($backedEnumValue->value)
        ->toBeInstanceOf(MyBackedEnum::class)
        ->and($backedEnumValue->value->value)
        ->toEqual(MyBackedEnum::BAZZ->value);

    $backedEnumValue(MyBackedEnum::BAZZ);
    expect($backedEnumValue())
        ->toBeInstanceOf(MyBackedEnum::class)
        ->and($backedEnumValue()->value)
        ->toEqual(MyBackedEnum::BAZZ->value);
});

it('updates the nullable value to enum correctly', function () {
    $value = Strictus::nullableEnum(MyEnum::class, null);

    expect($value->value)
        ->toBeNull()
        ->and($value())
        ->toBeNull();

    $value->value = MyEnum::BAR;
    expect($value->value)
        ->toBeInstanceOf(MyEnum::class)
        ->toEqual(MyEnum::BAR);

    $value(MyEnum::BAR);
    expect($value())
        ->toBeInstanceOf(MyEnum::class)
        ->toEqual(MyEnum::BAR);

    $backedEnumValue = Strictus::nullableEnum(MyBackedEnum::class, null);

    expect($backedEnumValue->value)
        ->toBeNull()
        ->and($backedEnumValue())
        ->toBeNull();

    $backedEnumValue->value = MyBackedEnum::BAZ;
    expect($backedEnumValue->value)
        ->toBeInstanceOf(MyBackedEnum::class)
        ->toEqual(MyBackedEnum::BAZ);

    $backedEnumValue(MyBackedEnum::BAZ);
    expect($backedEnumValue())
        ->toBeInstanceOf(MyBackedEnum::class)
        ->toEqual(MyBackedEnum::BAZ);
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

    $backedEnumValue = Strictus::enum(MyBackedEnum::class, MyBackedEnum::BAZZ, true);

    expect($backedEnumValue->value)
        ->toBeInstanceOf(MyBackedEnum::class)
        ->toEqual(MyBackedEnum::BAZZ)
        ->and($backedEnumValue())
        ->toBeInstanceOf(MyBackedEnum::class)
        ->toEqual(MyBackedEnum::BAZZ);

    $backedEnumValue->value = null;
    expect($backedEnumValue->value)
        ->toBeNull();

    $backedEnumValue(null);
    expect($backedEnumValue())
        ->toBeNull();
});

it('can\'t updates the immutable value', function () {
    $value = ImmutableStrictus::nullableEnum(MyBackedEnum::class, MyBackedEnum::BAZZ);

    expect($value->value)
        ->toBeInstanceOf(MyBackedEnum::class)
        ->toEqual(MyBackedEnum::BAZZ)
        ->and($value())
        ->toBeInstanceOf(MyBackedEnum::class)
        ->toEqual(MyBackedEnum::BAZZ)
        ->and(fn () => $value->value = MyBackedEnum::BAZ)
        ->toThrow(ImmutableStrictusException::class)
        ->and(fn () => $value(MyBackedEnum::BAZ))
        ->toThrow(ImmutableStrictusException::class);
});

enum MyEnum
{
    case FOO;
    case BAR;
}

enum MyBackedEnum: int
{
    case BAZ = 1;
    case BAZZ = 2;
}
