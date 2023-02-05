<?php

namespace Strictus\Strictus\Interfaces;

use Strictus\Strictus\Types\StrictusUndefined;

interface StrictusTypeInterface
{
    public function __get(string $value);

    public function __set(string $name, $value): void;

    public function __invoke(mixed $value = new StrictusUndefined());
}