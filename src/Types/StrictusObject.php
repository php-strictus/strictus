<?php

declare(strict_types=1);

namespace Strictus\Types;

use Strictus\Interfaces\StrictusTypeInterface;
use Strictus\Traits\StrictusTyping;

/**
 * @internal
 */
final class StrictusObject implements StrictusTypeInterface
{
    use StrictusTyping;

    private string $instanceType = 'object';

    private string $errorMessage = 'Expected Object';

    /**
     * @param  mixed  $value
     * @param  bool  $nullable
     */
    public function __construct(mixed $value, private bool $nullable)
    {
        if ($this->nullable) {
            $this->errorMessage .= ' Or Null';
        }
    }
}
