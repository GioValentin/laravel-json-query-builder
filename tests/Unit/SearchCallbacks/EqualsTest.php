<?php

declare(strict_types=1);

namespace GioValentin\JsonQueryBuilder\Tests\Unit\SearchCallbacks;

use GioValentin\JsonQueryBuilder\SearchCallbacks\Equals;
use GioValentin\JsonQueryBuilder\SearchParser;
use GioValentin\JsonQueryBuilder\Tests\TestCase;
use Illuminate\Database\Eloquent\Builder;
use Mockery;

class EqualsTest extends TestCase
{
    protected Builder $builder;
    protected SearchParser $searchParser;

    public function setUp(): void
    {
        parent::setUp();

        /**
         * @var Builder $builder
         */
        $this->builder = app(Builder::class);

        $this->searchParser = Mockery::mock(SearchParser::class);
        $this->searchParser->type = 'test';
        $this->searchParser->column = 'test';
    }

    /** @test */
    public function produces_query()
    {
        $this->searchParser->values = ['123'];

        new Equals($this->builder, $this->searchParser);

        $sql = 'select * where "test" in (?)';

        $this->assertEquals($sql, $this->builder->toSql());
    }
}
