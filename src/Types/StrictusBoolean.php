<?php

declare(strict_types=1);

namespace Strictus\Types;

use Strictus\Interfaces\StrictusTypeInterface;
use Strictus\Traits\StrictusTyping;

/**
 * @internal
 */
final class StrictusBoolean implements StrictusTypeInterface
{
    use StrictusTyping;

    private string $instanceType = 'boolean';

    private string $errorMessage = 'Expected Boolean';
}
