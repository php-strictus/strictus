<?php

namespace Strictus\Types;

use Strictus\Interfaces\StrictusTypeInterface;
use Strictus\Traits\StrictusTyping;

class StrictusBoolean implements StrictusTypeInterface
{
    use StrictusTyping;

    private string $instanceType = 'boolean';

    private string $errorMessage = 'Expected Boolean';

    /**
     * @param  bool|null  $value
     * @param  bool  $nullable
     */
    public function __construct(private ?bool $value, private bool $nullable)
    {
        if ($this->nullable) {
            $this->errorMessage .= ' Or Null';
        }
    }
}
