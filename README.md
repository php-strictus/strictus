<div align="center">
    <img src="https://github.com/php-strictus/strictus/raw/main/art/logo.png" alt="Strictus" width="400"/>
    <h1>Strictus</h1>
    <h4>Strict Typing for local variables in PHP</h4>
</div>

<div align="center">
    <a href="https://packagist.org/packages/strictus/strictus"><img src="https://img.shields.io/packagist/v/strictus/strictus.svg?style=flat-square" alt="Packagist"></a>
    <a href="https://packagist.org/packages/strictus/strictus"><img src="https://img.shields.io/packagist/php-v/strictus/strictus.svg?style=flat-square" alt="PHP from Packagist"></a>
    <a href="https://github.com/php-strictus/strictus/actions"><img alt="GitHub Workflow Status (main)" src="https://img.shields.io/github/actions/workflow/status/php-strictus/strictus/tests.yml?branch=main&label=Tests"> </a>
</div>

<div align="center">
    <a href="#introduction">Introduction</a> |
    <a href="#installation">Installation</a> |
    <a href="#usage">Usage</a> |
    <a href="#credits">Credits</a> |
    <a href="#contributing">Contributing</a>
</div>

## Introduction

Strictus brings **strict typing** for local variables into PHP.

With Strictus, you can control the types of local variables using different patterns.

---

`💣` **The problem:**

PHP has no support for strongly typed Local Variables.

Here is an illustrative example of a basic mistake:

```php
<?php 
//Rule: Active discount of 10% or 25% for orders from $50

$total = 82.50;
$discount = 0.10; //float

if ($total >= 50) {
    $discount = '25%'; //replacing a float value with string value 🤦🏻‍♂️
}

$total = $total - ($total * $discount); //💥 Error: A float cannot be multiplied by a string
```

In the code above, nothing prevents overriding the `float` value of `$discount` a `string` value, causing a bug.

<br/>

`👍` **The solution:**  

Let's rewrite the previous example using Strictus and strongly typed variables:

```php
<?php 
//Rule: Active discount of 10% or 25% for orders from $50

use Strictus\Strictus;

$total = Strictus::float(82.50); 
$discount = Strictus::float(0.10);

if ($total() >= 50) {
    $discount(0.25); //updates the $discount value
}

$total($total() - ($total() * $discount()));

echo $total(); //61.875
```

In the code above, the variable `$discount` is an instance of `StrictusFloat::class` and  it only accepts `float` values.

An Exception `StrictusTypeException` is thrown when we try to assign anything that is not of type `float`, like a `string` for example.

See this example:

```php
<?php 
use Strictus\Strictus;

$discount = Strictus::float(0.10);
$discount('25%'); //A StrictusTypeException stops the code execution
```

## Installation

You can install the package via composer:

```bash
composer require strictus/strictus
```

Requires: PHP 8.1+

## Usage

There are a few different patterns you can use to work `Strictus`.

### Creating Your Variables

To create a variable, simply call `Strictus::*method*()`, replacing the `*method*` with the type you want to enforce.

For example:

```php
<?php
use Strictus\Strictus;

//creates a string
$name = Strictus::string('Wendell');

 //creates a nullable string
$comment = Strictus::nullableString(null);

 //creates an int
$score = Strictus::int(100);

//creates a boolean
$isActive = Strictus::boolean(true);

//creates an array
$authors = Strictus::array(['Wendell', 'Christopher']);

//creates an object
$person = Strictus::object((object) ['name' => 'Wendell', 'country' => 'BR']);

//instantiates a class
$calculator = Strictus::instance(CalculatorClass::class, new CalculatorClass());

//instantiates an enum
$role = Strictus::enum(Role::class, Role::CONTRIBUTOR);

class CalculatorClass
{
    //...
}

enum Role
{
    case CONTRIBUTOR;
}
```

💡 Check out all the available [variable methods](#variable-methods).

### Getting Variable Value

To retrieve the variable value, just call it like a function:

```php
echo $name(); //Wendell

echo $score() - 10; //90

if ($isActive()) {
    //do your logic here
}

echo implode($authors(), ';'); //Wendell;Christopher
```

Alternatively, you can use the `$variable` like a Value Object:

```php
$name = Strictus::string('Christopher'); //creates a string

echo $name->value; //Christopher
```

### Update Variable Value

To update the variable value, call it like a function passing the new value as the argument:

```php
$score = Strictus::int(100);

$score($score() - 20); //updates $score

echo $score(); //80
```

Alternatively, you can use the `$variable` like a Value Object:

```php
$score = Strictus::int(100);

$score->value = 0;

echo $score(); //0
```

### Variable methods

You can use the following methods to create single type variables:

| Type       | Nullable | Method                                            |
|------------|----------|---------------------------------------------------|
| String     | No       | Strictus::string($value)                          |
| String     | Yes      | Strictus::string($value, true)                    |
| String     | Yes      | Strictus::nullableString($value)                  |
| Integer    | No       | Strictus::int($value)                             |
| Integer    | Yes      | Strictus::int($value, true)                       |
| Integer    | Yes      | Strictus::nullableInt($value)                     |
| Float      | No       | Strictus::float($value)                           |
| Float      | Yes      | Strictus::float($value, true)                     |
| Float      | Yes      | Strictus::nullableFloat($value, true)             |
| Boolean    | No       | Strictus::boolean($value)                         |
| Boolean    | Yes      | Strictus::boolean($value, true)                   |
| Boolean    | Yes      | Strictus::nullableBoolean($value)                 |
| Array      | No       | Strictus::array($value)                           |
| Array      | Yes      | Strictus::array($value, true)                     |
| Array      | Yes      | Strictus::nullableArray($value)                   |
| Object     | No       | Strictus::object($value)                          |
| Object     | Yes      | Strictus::object($value, true)                    |
| Object     | Yes      | Strictus::nullableObject($value)                  |
| Class Type | No       | Strictus::instance($instanceType, $value)         |
| Class Type | Yes      | Strictus::instance($instanceType, $value, true)   |
| Class Type | Yes      | Strictus::nullableInstance($instanceType, $value) |
| Enum Type  | No       | Strictus::enum($enumType, $value)                 |
| Enum Type  | Yes      | Strictus::enum($enumType, $value, true)           |
| Enum Type  | Yes      | Strictus::nullableEnum($enumType, $value)         |

### Union Types

`Strictus` also supports union types:

```php
use Strictus\Enums\Type;

$unionTypesVariable = Strictus::union([Type::INT, Type::STRING], 'foo');

echo $unionTypesVariable->value; //foo

echo $unionTypesVariable(); //foo

// Update variable

$unionTypesVariable->value = 100;

echo $unionTypesVariable->value; //100

// Thrown an exception if the value is wrong union types

$unionTypesVariable->value = false; //StrictusTypeException
```

### Immutable Variables

If you want to create immutable variables, you can use the `->immutable()` method. If you try to assign a new value
to an Immutable Variable, an `Strictus\Exceptions\ImmutableStrictusException` exception will be thrown:

```php
$immutableScore = Strictus::int(100)->immutable();

$immutableScore(50); //ImmutableStrictusException
$immutableScore->value = 50; //ImmutableStrictusException
```

### Error Handling

If you try to assign a value that doesn't match the type of the created variable, an
`Strictus\Exceptions\StrictusTypeException` exception will be thrown:

```php
$score = Strictus::int(100);

$score('one hundred'); //StrictusTypeException
$score->value = false; //StrictusTypeException
```

If you try to assign a new value to an Immutable Variable, an
`Strictus\Exceptions\ImmutableStrictusException` exception will be thrown:

```php
$immutableScore = Strictus::int(100)->immutable();

$immutableScore(50); //ImmutableStrictusException
$immutableScore->value = 50; //ImmutableStrictusException
```

## Motivation

Following a discussion on Twitter between **[Christopher Miller](https://twitter.com/ccmiller2018)** and
**[Wendell Adriel](https://twitter.com/wendell_adriel)** around the lack of strongly typed local variables
for PHP we quickly decided a package was the right approach whilst we could get an RFC into the core.

## Credits

- [Christopher Miller](https://github.com/chrisjumptwentyfour)
- [Wendell Adriel](https://github.com/WendellAdriel)
- [All Contributors](../../contributors)

## Contributing

We welcome contributions!

Please visit the **[Contributing Guide](CONTRIBUTING.md)** to learn more about contributing to Strictus.
