<?php

declare(strict_types=1);

namespace GioValentin\JsonQueryBuilder\SearchCallbacks;

use GioValentin\JsonQueryBuilder\CategorizedValues;
use Jenssegers\Mongodb\Eloquent\Builder;

class NotBetween extends AbstractCallback
{
    public static function operator(): string
    {
        return '!<>';
    }

    public function execute(Builder $builder, string $column, CategorizedValues $values): void
    {
        $this->betweenCallback($builder, $column, $values, '!<>');
    }
}
