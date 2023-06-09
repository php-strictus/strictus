<?php

declare(strict_types=1);

namespace Strictus\Types;

use Strictus\Interfaces\StrictusTypeInterface;
use Strictus\Traits\Cloneable;
use Strictus\Traits\StrictusTyping;

/**
 * @internal
 */
final class StrictusString implements StrictusTypeInterface
{
    use Cloneable;
    use StrictusTyping;

    private string $instanceType = 'string';

    private string $errorMessage = 'Expected String';
}
