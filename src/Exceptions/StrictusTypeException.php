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
        $typeClass = Type::class;

        return new self("Type must be an enum instance of `{$typeClass}`");
    }

    public static function becauseNotSupportedType(string $type): self
    {
        return new self("Not support {$type} type");
    }

    public static function becauseNullInstanceType(): self
    {
        return new self('Can\'t detect instanceable type');
    }
}
