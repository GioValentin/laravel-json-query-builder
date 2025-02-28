<?php

declare(strict_types=1);

namespace GioValentin\JsonQueryBuilder\Config;

use GioValentin\JsonQueryBuilder\Exceptions\JsonQueryBuilderException;
use GioValentin\JsonQueryBuilder\Types\AbstractType;

class TypesConfig extends SearchConfig
{
    protected function configKey(): string
    {
        return 'types';
    }

    /**
     * @param string $typeName
     * @return mixed
     * @throws JsonQueryBuilderException
     */
    public function getTypeClassFromTypeName(string $typeName): AbstractType
    {
        $mapping = $this->nameClassMapping();

        if (!array_key_exists($typeName, $mapping)) {
            if (!array_key_exists('generic', $mapping)) {
                throw new JsonQueryBuilderException("No valid callback for '$typeName' type.");
            }

            return new $mapping['generic'];
        }

        return new $mapping[$typeName];
    }

    protected function nameClassMapping(): array
    {
        $names = $this->getTypeNames();
        $callbacks = $this->registered;

        return array_combine($names, $callbacks);
    }

    protected function getTypeNames(): array
    {
        /**
         * @var AbstractType $type
         */
        return array_map(fn ($type) => $type::name(), $this->registered);
    }
}
