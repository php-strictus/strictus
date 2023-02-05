<?php

namespace Strictus\Strictus\Types;

use Strictus\Strictus\Interfaces\StrictusTypeInterface;
use Strictus\Strictus\Traits\StrictusTyping;

class StrictusArray implements StrictusTypeInterface
{
    use StrictusTyping;

    private string $instanceType = 'array';

    private string $errorMessage = 'Expected Array';

    public function __construct(private ?array $value, private bool $nullable) {
        if ($this->nullable) {
            $this->errorMessage .= ' Or Null';
        }
    }
}

