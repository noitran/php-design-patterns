<?php

declare(strict_types=1);

namespace Noitran\Patterns\Creational\FactoryMethod;

class StreamLoggerFactory implements LoggerFactory
{
    public function createLogger(): LoggerInterface
    {
        $logFile = '_logs/main.log';

        return new StreamLogger($logFile);
    }
}
