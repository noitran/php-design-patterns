<?php

declare(strict_types=1);

namespace Noitran\Patterns\Creational\Singleton;

use Monolog\Handler\StreamHandler;
use Monolog\Logger as Monolog;

class Logger extends Singleton
{
    protected Monolog $logger;

    /**
     * LoggerSingleton constructor.
     *
     * As we will have only one singleton, there will be only one global monolog instance in application.
     */
    protected function __construct()
    {
        parent::__construct();

        $this->logger = new Monolog('main', [
            new StreamHandler('_logs/main.log', Monolog::DEBUG)
        ]);
    }

    public static function log($level, $message, array $context = []): void
    {
        $instance = static::getInstance();
        $instance->logger->log($level, $message, $context);
    }
}
