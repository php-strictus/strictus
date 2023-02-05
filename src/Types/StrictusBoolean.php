<?php

namespace Strictus\Strictus\Types;

use Strictus\Strictus\Interfaces\StrictusTypeInterface;
use Strictus\Strictus\Traits\StrictusTyping;

class StrictusBoolean implements StrictusTypeInterface
{
    use StrictusTyping;

    private string $instanceType = 'boolean';

    private string $errorMessage = 'Expected Boolean';

    public function __construct(private ?bool $value, private bool $nullable) {
        if ($this->nullable) {
            $this->errorMessage .= ' Or Null';
        }
    }
}

