<?php

declare(strict_types=1);

namespace GioValentin\JsonQueryBuilder\Types;

class GenericType extends AbstractType
{
    public static function name(): string
    {
        return 'generic';
    }
}
