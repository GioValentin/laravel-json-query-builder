<?php

declare(strict_types=1);

namespace GioValentin\JsonQueryBuilder\RequestParameters;

class ReturnsParameter extends AbstractParameter
{
    public static function getParameterName(): string
    {
        return 'returns';
    }

    protected function appendQuery(): void
    {
        $this->builder->addSelect($this->arguments);
    }
}
