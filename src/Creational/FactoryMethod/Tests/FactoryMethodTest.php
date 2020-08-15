<?php

declare(strict_types=1);

namespace Noitran\Patterns\Creational\FactoryMethod\Tests;

use Noitran\Patterns\Creational\FactoryMethod\SlackLogger;
use Noitran\Patterns\Creational\FactoryMethod\SlackLoggerFactory;
use Noitran\Patterns\Creational\FactoryMethod\StreamLogger;
use Noitran\Patterns\Creational\FactoryMethod\StreamLoggerFactory;
use PHPUnit\Framework\TestCase;

class FactoryMethodTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_create_stream_logger(): void
    {
        $logger = (new StreamLoggerFactory())->createLogger();

        self::assertInstanceOf(StreamLogger::class, $logger);
    }

    /**
     * @test
     */
    public function it_should_create_slack_logger(): void
    {
        $logger = (new SlackLoggerFactory())->createLogger();

        self::assertInstanceOf(SlackLogger::class, $logger);
    }
}
