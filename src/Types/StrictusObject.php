<?php

namespace Strictus\Strictus\Types;

use Strictus\Strictus\Interfaces\StrictusTypeInterface;
use Strictus\Strictus\Traits\StrictusTyping;

class StrictusObject implements StrictusTypeInterface
{
    use StrictusTyping;

    private string $instanceType = 'object';

    private string $errorMessage = 'Expected Object';

    public function __construct(private ?object $value, private bool $nullable) {
        if ($this->nullable) {
            $this->errorMessage .= ' Or Null';
        }
    }
}

