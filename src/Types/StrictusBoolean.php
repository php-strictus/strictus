<?php

declare(strict_types=1);

namespace Strictus\Types;

use Strictus\Concerns\StrictusTyping;
use Strictus\Interfaces\StrictusTypeInterface;

/**
 * @internal
 */
final class StrictusBoolean implements StrictusTypeInterface
{
    use StrictusTyping;

    private string $instanceType = 'boolean';

    private string $errorMessage = 'Expected Boolean';
}
