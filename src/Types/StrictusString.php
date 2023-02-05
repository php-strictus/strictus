<?php

declare(strict_types=1);

namespace Strictus\Types;

use Strictus\Interfaces\StrictusTypeInterface;
use Strictus\Traits\StrictusTyping;

/**
 * @internal
 */
final class StrictusString implements StrictusTypeInterface
{
    use StrictusTyping;

    private string $instanceType = 'string';

    private string $errorMessage = 'Expected String';

    /**
     * @param  mixed  $value
     * @param  bool  $nullable
     */
    public function __construct(private mixed $value, private bool $nullable)
    {
        if ($this->nullable) {
            $this->errorMessage .= ' Or Null';
        }

        $this->handleInstantiation($value);
    }

    public function get(): ?string
    {
        return $this->value;
    }

    public function set($value): void
    {
        $this->__invoke($value);
    }
}
