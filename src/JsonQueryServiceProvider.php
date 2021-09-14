<?php

declare(strict_types=1);

namespace GioValentin\JsonQueryBuilder;

use Illuminate\Support\ServiceProvider;

class JsonQueryServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/GioValentin-json-query-builder.php', 'GioValentin-json-query-builder');
    }

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->publishes([__DIR__ . '/../config/GioValentin-json-query-builder.php' => config_path('GioValentin-json-query-builder.php')]);
    }
}
