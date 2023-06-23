<?php

declare(strict_types=1);

namespace Strictus\Enums;

enum Type
{
    case INT;
    case STRING;
    case FLOAT;
    case BOOLEAN;
    case ARRAY;
    case OBJECT;
    case INSTANCE;
    case ENUM;
}
