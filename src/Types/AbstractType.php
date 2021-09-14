<?php

declare(strict_types=1);

namespace GioValentin\JsonQueryBuilder\Types;

abstract class AbstractType
{
    /**
     * Name of the type as it is used within Laravel migrations.
     *
     * @return string
     */
    abstract public static function name(): string;

    /**
     * Prepare/transform values for query if needed.
     *
     * @param array $values
     * @return array
     */
    public function prepare(array $values): array
    {
        foreach($values as $key => $value) 
        {
            $types = ['int', 'float', 'string'];

            foreach($types as $_ => $type) {
                $foo = $value;
                $set = settype($foo, $type);
                
                if($set) {
                    $values[$key] = $foo;
                    break 1;
                }   
            }
        }
        
        return $values;
    }
}
