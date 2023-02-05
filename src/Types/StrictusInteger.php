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
