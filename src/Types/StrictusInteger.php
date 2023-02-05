<?php

declare(strict_types=1);

namespace Strictus\Types;

use Strictus\Interfaces\StrictusTypeInterface;
use Strictus\Traits\StrictusTyping;

/**
 * @internal
 */
final class StrictusInteger implements StrictusTypeInterface
{
    use StrictusTyping;

    private string $instanceType = 'integer';

    private string $errorMessage = 'Expected Integer';
}
