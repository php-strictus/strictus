<?php

declare(strict_types=1);

namespace Strictus\Exceptions;

use Strictus\Enums\Type;
use TypeError;

/**
 * @internal
 */
final class StrictusTypeException extends TypeError
{
    public static function becauseInvalidSupportedType(): self
    {
        return new self(sprintf('Type must be an enum instance of %s', Type::class));
    }

    public static function becauseNotSupportedType(string $type): self
    {
        return new self(sprintf('Not support %s type', $type));
    }

    public static function becauseNullInstanceType(): self
    {
        return new self('Can\'t detect instanceable type');
    }
}
