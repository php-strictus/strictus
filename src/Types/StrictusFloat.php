<?php

declare(strict_types=1);

namespace Strictus\Types;

use Strictus\Interfaces\StrictusTypeInterface;
use Strictus\Traits\StrictusTyping;

/**
 * @internal
 */
final class StrictusFloat implements StrictusTypeInterface
{
    use StrictusTyping;

    private string $instanceType = 'float';

    private string $errorMessage = 'Expected Float';

    /**
     * @param  mixed  $value
     * @param  bool  $nullable
     */
    public function __construct(mixed $value, private bool $nullable)
    {
        if ($nullable) {
            $this->errorMessage .= ' Or Null';
        }
    }
}
