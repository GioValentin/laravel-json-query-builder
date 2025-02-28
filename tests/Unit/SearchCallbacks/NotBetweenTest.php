<?php

declare(strict_types=1);

namespace GioValentin\JsonQueryBuilder\Tests\Unit\SearchCallbacks;

use GioValentin\JsonQueryBuilder\SearchCallbacks\NotBetween;
use GioValentin\JsonQueryBuilder\SearchParser;
use GioValentin\JsonQueryBuilder\Tests\TestCase;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Mockery;

class NotBetweenTest extends TestCase
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
        $this->searchParser->values = ['123', '456'];

        new NotBetween($this->builder, $this->searchParser);

        $sql = 'select * where "test" not between ? and ?';

        $this->assertEquals($sql, $this->builder->toSql());
    }

    /** @test */
    public function fails_on_one_parameter()
    {
        $this->expectException(Exception::class);

        $this->searchParser->values = ['1 parameter only'];

        new NotBetween($this->builder, $this->searchParser);
    }

    /** @test */
    public function fails_on_more_than_two_parameters()
    {
        $this->expectException(Exception::class);

        $this->searchParser->values = ['1', '2', '3'];

        new NotBetween($this->builder, $this->searchParser);
    }
}
