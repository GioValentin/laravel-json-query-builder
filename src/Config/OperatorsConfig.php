<?php

declare(strict_types=1);

namespace GioValentin\JsonQueryBuilder\Config;

use GioValentin\JsonQueryBuilder\Exceptions\JsonQueryBuilderException;
use GioValentin\JsonQueryBuilder\SearchCallbacks\AbstractCallback;

class OperatorsConfig extends SearchConfig
{
    protected function configKey(): string
    {
        return 'operators';
    }

    protected function operatorCallbackMapping(): array
    {
        $operators = $this->getOperators();
        $callbacks = $this->registered;

        return array_combine($operators, $callbacks);
    }

    /**
     * Extract operators from registered 'operator' classes.
     * @return array
     */
    public function getOperators(): array
    {
        /**
         * @var AbstractCallback $callback
         */
        return array_map(fn ($callback) => $callback::operator(), $this->registered);
    }

    /**
     * @param string $operator
     * @return string
     * @throws JsonQueryBuilderException
     */
    public function getCallbackClassFromOperator(string $operator): string
    {
        if (!array_key_exists($operator, $this->operatorCallbackMapping())) {
            throw new JsonQueryBuilderException("No valid callback registered for '$operator' operator.");
        }

        return $this->operatorCallbackMapping()[$operator];
    }
}
