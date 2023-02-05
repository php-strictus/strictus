<?php

namespace Strictus\Types;

use Strictus\Interfaces\StrictusTypeInterface;
use Strictus\Traits\StrictusTyping;

class StrictusFloat implements StrictusTypeInterface
{
    use StrictusTyping;

    private string $instanceType = 'float';

    private string $errorMessage = 'Expected Float';

    /**
     * @param  float|null  $value
     * @param  bool  $nullable
     */
    public function __construct(private ?float $value, private bool $nullable)
    {
        if ($nullable) {
            $this->errorMessage .= ' Or Null';
        }
    }
}
