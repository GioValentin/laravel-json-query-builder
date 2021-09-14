<?php

declare(strict_types=1);

namespace GioValentin\JsonQueryBuilder\Tests;

use GioValentin\JsonQueryBuilder\JsonQueryServiceProvider;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [JsonQueryServiceProvider::class];
    }

    protected function getEnvironmentSetUp($app)
    {
        // perform environment setup
    }
}
