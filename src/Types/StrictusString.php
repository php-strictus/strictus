<?php

declare(strict_types=1);

namespace Strictus\Types;

use Strictus\Interfaces\StrictusTypeInterface;
use Strictus\Traits\StrictusTyping;

final class StrictusString implements StrictusTypeInterface
{
    use StrictusTyping;

    private string $instanceType = 'string';

    private string $errorMessage = 'Expected String';

    /**
     * @param  string|null  $value
     * @param  bool  $nullable
     */
    public function __construct(private ?string $value, private bool $nullable)
    {
        if ($this->nullable) {
            $this->errorMessage .= ' Or Null';
        }
    }
}
