<?php

declare(strict_types=1);

namespace GioValentin\JsonQueryBuilder\RequestParameters;

use GioValentin\JsonQueryBuilder\Exceptions\JsonQueryBuilderException;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SoftDeletedParameter extends AbstractParameter
{
    public static function getParameterName(): string
    {
        return 'soft_deleted';
    }

    protected function areArgumentsValid(): void
    {
        if (count($this->arguments) != 1) {
            throw new JsonQueryBuilderException("Parameter '{$this->getParameterName()}' expects only one argument.");
        }

        if (!in_array($this->arguments[0], [1, '1', true, 'true'], true)) {
            throw new JsonQueryBuilderException("Parameter '{$this->getParameterName()}' expects to be 'true' if it is to be used.");
        }
    }

    protected function appendQuery(): void
    {
        $this->builder->withoutGlobalScope(SoftDeletingScope::class);
    }
}
