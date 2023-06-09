<?php

declare(strict_types=1);

namespace Strictus\Types;

use Strictus\Interfaces\StrictusTypeInterface;
use Strictus\Traits\Cloneable;
use Strictus\Traits\StrictusTyping;

/**
 * @internal
 */
final class StrictusObject implements StrictusTypeInterface
{
    use Cloneable;
    use StrictusTyping;

    private string $instanceType = 'object';

    private string $errorMessage = 'Expected Object';
}
