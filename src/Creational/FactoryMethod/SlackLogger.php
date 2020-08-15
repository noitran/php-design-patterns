<?php

declare(strict_types=1);

namespace Noitran\Patterns\Creational\FactoryMethod;

/**
 * Class SlackLogger - Concrete "Product" - Implementation of "Product" interface (LoggerInterface).
 */
class SlackLogger implements LoggerInterface
{
    protected string $webhookUrl;

    protected string $channel;

    protected string $username;

    public function __construct(string $webhookUrl, string $channel, string $username)
    {
        $this->webhookUrl = $webhookUrl;
        $this->channel = $channel;
        $this->username = $username;
    }

    public function log($level, string $message, array $context = []): void
    {
        //
    }
}
