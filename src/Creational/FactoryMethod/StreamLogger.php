<?php

declare(strict_types=1);

namespace Noitran\Patterns\Creational\FactoryMethod;

/**
 * Class StreamLogger - Concrete "Product" - Implementation of "Product" interface (LoggerInterface)
 */
class StreamLogger implements LoggerInterface
{
    protected string $stream;

    public function __construct(string $stream)
    {
        $this->stream = $stream;
    }

    public function log($level, string $message, array $context = []): void
    {
        //
    }
}
