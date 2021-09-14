<?php

declare(strict_types=1);

namespace GioValentin\JsonQueryBuilder\Config;

class RequestParametersConfig extends SearchConfig
{
    protected function configKey(): string
    {
        return 'request_parameters';
    }
}
