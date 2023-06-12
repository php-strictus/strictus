<?php

declare(strict_types=1);

namespace Strictus\Types;

use Strictus\Concerns\StrictusTyping;
use Strictus\Interfaces\StrictusTypeInterface;

/**
 * @internal
 */
final class StrictusFloat implements StrictusTypeInterface
{
    use StrictusTyping;

    //this is the internal type name given to what we call float
    private string $instanceType = 'double';

    private string $errorMessage = 'Expected Float';
}
