<?php

namespace Strictus\Types;

use Strictus\Interfaces\StrictusTypeInterface;
use Strictus\Traits\StrictusTyping;

class StrictusArray implements StrictusTypeInterface
{
    use StrictusTyping;

    private string $instanceType = 'array';

    private string $errorMessage = 'Expected Array';

    /**
     * @param  array|null  $value
     * @param  bool  $nullable
     */
    public function __construct(private ?array $value, private bool $nullable)
    {
        if ($this->nullable) {
            $this->errorMessage .= ' Or Null';
        }
    }
}
