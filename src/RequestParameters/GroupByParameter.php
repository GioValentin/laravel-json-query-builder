<?php

declare(strict_types=1);

namespace GioValentin\JsonQueryBuilder\RequestParameters;

class GroupByParameter extends AbstractParameter
{
    public static function getParameterName(): string
    {
        return 'group_by';
    }

    protected function appendQuery(): void
    {
        $this->builder->groupBy($this->arguments);
    }
}
