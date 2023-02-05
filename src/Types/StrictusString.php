<?php

namespace Strictus\Strictus\Types;
use Strictus\Strictus\Interfaces\StrictusTypeInterface;
use Strictus\Strictus\Traits\StrictusTyping;
use TypeError;

class StrictusString implements StrictusTypeInterface
{
    use StrictusTyping;

    private string $instanceType = 'string';

    private string $errorMessage = 'Expected String';

    public function __construct(public ?string $value, private bool $nullable) {
        if ($this->nullable) {
            $this->errorMessage .= ' Or Null';
        }
    }
}

