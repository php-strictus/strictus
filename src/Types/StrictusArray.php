<?php

declare(strict_types=1);

namespace Strictus\Types;

use Strictus\Interfaces\StrictusTypeInterface;
use Strictus\Traits\StrictusTyping;

/**
 * @internal
 */
final class StrictusArray implements StrictusTypeInterface
{
    use StrictusTyping;

    private string $instanceType = 'array';

    private string $errorMessage = 'Expected Array';
}
