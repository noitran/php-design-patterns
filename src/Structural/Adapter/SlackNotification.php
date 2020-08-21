<?php

declare(strict_types=1);

namespace Noitran\Patterns\Structural\Adapter;

use JoliCode\Slack\Api\Client;

/**
 * Acts as an Adapter to JoliCode\Slack\Api\Client class.
 */
class SlackNotification implements NotificationInterface
{
    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function send(string $title, string $message): bool
    {
        $response = $this->client->chatPostMessage([
            'username' => 'Bot',
            'channel' => 'general',
            'text' => $message,
        ]);

        // Some other logic...

        return true;
    }
}
