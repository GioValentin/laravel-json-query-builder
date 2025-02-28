<?php

declare(strict_types=1);

namespace GioValentin\JsonQueryBuilder\SearchCallbacks;

use GioValentin\JsonQueryBuilder\CategorizedValues;
use Jenssegers\Mongodb\Eloquent\Builder;

class Equals extends AbstractCallback
{
    public static function operator(): string
    {
        return '=';
    }

    public function execute(Builder $builder, string $column, CategorizedValues $values): void
    {
        foreach ($values->andLike as $andLike) {
            $builder->where($column, 'LIKE', $andLike);
        }

        foreach ($values->notLike as $notLike) {
            $builder->where($column, 'NOT LIKE', $notLike);
        }

        if ($values->null) {
            $builder->whereNull($column);
        }

        if ($values->notNull) {
            $builder->whereNotNull($column);
        }

        if ($values->and) {
            $builder->whereIn($column, $values->and);
        }

        if ($values->not) {
            $builder->whereNotIn($column, $values->not);
        }
    }
}
