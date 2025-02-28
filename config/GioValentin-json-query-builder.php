<?php

use GioValentin\JsonQueryBuilder\RequestParameters\CountParameter;
use GioValentin\JsonQueryBuilder\RequestParameters\GroupByParameter;
use GioValentin\JsonQueryBuilder\RequestParameters\LimitParameter;
use GioValentin\JsonQueryBuilder\RequestParameters\OffsetParameter;
use GioValentin\JsonQueryBuilder\RequestParameters\OrderByParameter;
use GioValentin\JsonQueryBuilder\RequestParameters\RelationsParameter;
use GioValentin\JsonQueryBuilder\RequestParameters\ReturnsParameter;
use GioValentin\JsonQueryBuilder\RequestParameters\SearchParameter;
use GioValentin\JsonQueryBuilder\RequestParameters\SoftDeletedParameter;
use GioValentin\JsonQueryBuilder\SearchCallbacks\Between;
use GioValentin\JsonQueryBuilder\SearchCallbacks\Equals;
use GioValentin\JsonQueryBuilder\SearchCallbacks\GreaterThan;
use GioValentin\JsonQueryBuilder\SearchCallbacks\GreaterThanOrEqual;
use GioValentin\JsonQueryBuilder\SearchCallbacks\LessThan;
use GioValentin\JsonQueryBuilder\SearchCallbacks\LessThanOrEqual;
use GioValentin\JsonQueryBuilder\SearchCallbacks\NotBetween;
use GioValentin\JsonQueryBuilder\SearchCallbacks\NotEquals;
use GioValentin\JsonQueryBuilder\Types\BooleanType;
use GioValentin\JsonQueryBuilder\Types\GenericType;

return [
    /**
     * Registered request parameters.
     */
    'request_parameters'      => [
        SearchParameter::class,
        ReturnsParameter::class,
        OrderByParameter::class,
        RelationsParameter::class,
        LimitParameter::class,
        OffsetParameter::class,
        CountParameter::class,
        GroupByParameter::class,
        SoftDeletedParameter::class,
    ],

    /**
     * Registered operators/callbacks. Operator order matters!
     * Callbacks having more const OPERATOR characters must come before those with less.
     */
    'operators'              => [
        NotBetween::class,
        LessThanOrEqual::class,
        GreaterThanOrEqual::class,
        Between::class,
        NotEquals::class,
        Equals::class,
        LessThan::class,
        GreaterThan::class,
    ],

    /**
     * Registered types. Generic type is the default one and should be used if
     * no special care for type value is needed.
     */
    'types'                  => [
        GenericType::class,
        BooleanType::class,
    ],

    /**
     * List of globally forbidden columns to search on.
     * Searching by forbidden columns will throw an exception
     * This takes precedence before other exclusions.
     */
    'global_forbidden_columns' => [
        // 'id', 'created_at' ...
    ],

    /**
     * TODO: these options are currently disabled and will not work
     * Refined options for a single model.
     * Use if you want to enforce rules on a specific model without affecting globally all models.
     */
    'model_options'           => [

        /**
         * For real usage, use real models without quotes. This is only meant to show the available options.
         */
        'SomeModel::class' => [
            /**
             * If enabled, this will read from model guarded/fillable properties
             * and decide whether it is allowed to search by these parameters.
             * If guarded property is present, fillable won't be taken. Laravel standard
             * is to use one or the other, not both.
             * This takes precedence before forbidden columns, but if both are used, it
             * will behave like union of columns to be excluded.
             * Searching on forbidden columns will throw an exception.
             */
            'eloquent_exclusion' => false,
            /**
             * Disable search on specific columns. Searching on forbidden columns will throw an exception.
             */
            'forbidden_columns'  => ['column', 'column2'],
            /**
             * Array of columns to order by in 'column => direction' format.
             * 'order-by' from query string takes precedence before these values.
             */
            'order_by'           => [
                'id'         => 'asc',
                'created_at' => 'desc',
            ],
            /**
             * List of columns to return. Return values forwarded within the request will
             * override these values. This acts as a 'SELECT /return only columns/' from.
             * By default, 'SELECT *' will be ran.
             */
            'returns'           => ['column', 'column2'],
            /**
             * List of relations to load by default. These will be overridden if provided within query string.
             */
            'relations'         => ['rel1', 'rel2'],

            /**
             * TBD
             * Some column names may be different on frontend than on backend.
             * It is possible to map such columns so that the true ORM
             * property stays hidden.
             */
            'column_mapping'     => [
                'frontend_column' => 'backend_column',
            ],
        ],
    ],
];
