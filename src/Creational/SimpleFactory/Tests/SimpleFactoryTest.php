<?php

declare(strict_types=1);

namespace Noitran\Patterns\Creational\SimpleFactory\Tests;

use Monolog\Handler\SlackWebhookHandler;
use Monolog\Handler\StreamHandler;
use Noitran\Patterns\Creational\SimpleFactory\LoggerFactory;
use Noitran\Patterns\Creational\Singleton\Config;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class SimpleFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_successfully_return_class_from_factory(): void
    {
        $config = Config::getInstance();
        $config->set('channels', [
            'stream' => [
                'name' => 'main',
                'driver' => 'stream',
                'path' => '_logs/main.log',
                'level' => 'debug',
            ],
            'slack' => [
                'driver' => 'slack',
                'url' => 'https://hooks.slack.com/services/T00000000/B00000000/XXXXXXXXXXXXXXXXXXXXXXXX',
                'channel' => 'general',
                'username' => 'patrick',
                'level' => 'debug',
            ],
        ]);

        $factory = new LoggerFactory();

        $streamLogger = $factory->create($config, 'stream');
        self::assertInstanceOf(StreamHandler::class, $streamLogger->getHandlers()[0]);

        $slackLogger = $factory->create($config, 'slack');
        self::assertInstanceOf(SlackWebhookHandler::class, $slackLogger->getHandlers()[0]);

        $this->expectException(RuntimeException::class);
        $nullLogger = $factory->create($config);
    }
}
