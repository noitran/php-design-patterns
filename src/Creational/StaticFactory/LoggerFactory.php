<?php

declare(strict_types=1);

namespace Noitran\Patterns\Creational\StaticFactory;

use InvalidArgumentException;
use Monolog\Handler\SlackWebhookHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger as Monolog;
use Noitran\Patterns\Creational\Singleton\Config;
use Psr\Log\LoggerInterface;

/**
 * Open/Closed principle gets broken in this pattern.
 */
final class LoggerFactory
{
    public static function create(Config $config, $loggerType = null): LoggerInterface
    {
        if (! array_key_exists($loggerType, $config->get('channels'))) {
            throw new InvalidArgumentException('No settings for logger "' . $loggerType . '" defined.');
        }

        $parameters = $config->get('channels')[$loggerType];

        switch ($loggerType) {
            case 'stream':
                return new Monolog($parameters['name'], [
                    new StreamHandler($parameters['path'], Monolog::DEBUG),
                ]);
            case 'slack':
                return new Monolog($parameters['driver'], [
                    new SlackWebhookHandler(
                        'https://hooks.slack.com/services/T00000000/B00000000/XXXXXXXXXXXXXXXXXXXXXXXX',
                        $parameters['channel'],
                        $parameters['username']
                    ),
                ]);
            default:
                throw new InvalidArgumentException('No such type of logger was found in system');
        }
    }
}
