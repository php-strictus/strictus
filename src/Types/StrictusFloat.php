<?php

namespace Strictus\Strictus\Types;

use Strictus\Strictus\Interfaces\StrictusTypeInterface;
use Strictus\Strictus\Traits\StrictusTyping;

class StrictusFloat implements StrictusTypeInterface
{
    use StrictusTyping;

    private string $instanceType = 'float';

    private string $errorMessage = 'Expected Float';

    public function __construct(private ?float $value, private bool $nullable) {
        if ($nullable) {
            $this->errorMessage .= ' Or Null';
        }
    }
}

