<?php

declare(strict_types=1);

namespace Strictus\Interfaces;

use Strictus\Types\StrictusUndefined;

/**
 * @internal
 */
interface StrictusTypeInterface
{
    public function __get(string $value): mixed;

    public function __set(string $name, mixed $value): void;

    public function __invoke(mixed $value = new StrictusUndefined()): mixed;
}
