<?php

declare(strict_types=1);

namespace Strictus\Traits;

trait Immutable
{
    private bool $immutable = false;

    public function immutable(): static
    {
        $this->immutable = true;
        $this->errorMessage .= ' And Immutability';

        return $this;
    }
}
