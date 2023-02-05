<?php

namespace Strictus\Strictus\Types;

use Strictus\Strictus\Interfaces\StrictusTypeInterface;
use Strictus\Strictus\Traits\StrictusTyping;

class StrictusInteger implements StrictusTypeInterface
{
    use StrictusTyping;

    private string $instanceType = 'integer';

    private string $errorMessage = 'Expected Integer';

    public function __construct(private ?int $value, private bool $nullable) {
        if ($this->nullable) {
            $this->errorMessage .= ' Or Null';
        }
    }
}
