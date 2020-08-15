<?php

declare(strict_types=1);

namespace Noitran\Patterns\Creational\FactoryMethod;

class SlackLoggerFactory implements LoggerFactory
{
    public function createLogger(): LoggerInterface
    {
        $slackWebhookUrl = 'https://hooks.slack.com/services/T00000000/B00000000/XXXXXXXXXXXXXXXXXXXXXXXX';
        $channel = 'general';
        $username = 'dummy';

        return new SlackLogger(
            $slackWebhookUrl,
            $channel,
            $username
        );
    }
}
