<?php

declare(strict_types=1);

namespace Strictus\Types;

use Strictus\Concerns\StrictusTyping;
use Strictus\Interfaces\StrictusTypeInterface;

/**
 * @internal
 */
final class StrictusObject implements StrictusTypeInterface
{
    use StrictusTyping;

    private string $instanceType = 'object';

    private string $errorMessage = 'Expected Object';

    private function setValue(mixed $value): void
    {
        /** @var object|null $value */
        $this->value = $value
            ? clone $value
            : null;
    }
}
