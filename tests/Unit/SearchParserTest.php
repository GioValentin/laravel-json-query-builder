<?php

declare(strict_types=1);

namespace GioValentin\JsonQueryBuilder\Tests\Unit\Parsers;

use GioValentin\JsonQueryBuilder\Config\ModelConfig;
use GioValentin\JsonQueryBuilder\Config\OperatorsConfig;
use GioValentin\JsonQueryBuilder\SearchParser;
use GioValentin\JsonQueryBuilder\Tests\TestCase;
use Mockery;

class SearchParserTest extends TestCase
{
    protected SearchParser $searchParser;

    public function setUp(): void
    {
        parent::setUp();

        $modelConfig = Mockery::mock(ModelConfig::class);

        $modelConfig->shouldReceive('getForbidden')->andReturn([]);
        $modelConfig->shouldReceive('getModelColumns')->andReturn([
            'test' => 'string',
        ]);

        $this->searchParser = new SearchParser(
            $modelConfig, new OperatorsConfig(), 'test', '=123;456');
    }

    /** @test */
    public function it_extracts_column()
    {
        $this->assertEquals('test', $this->searchParser->column);
    }

    /** @test */
    public function it_extracts_values_from_argument_splitting_by_separator()
    {
        $this->assertEquals(['123', '456'], $this->searchParser->values);
    }

    /** @test */
    public function it_extracts_column_types()
    {
        $this->assertEquals('string', $this->searchParser->type);
    }

    /** @test */
    public function it_extracts_operator_from_argument()
    {
        $this->assertEquals('=', $this->searchParser->operator);
    }
}
