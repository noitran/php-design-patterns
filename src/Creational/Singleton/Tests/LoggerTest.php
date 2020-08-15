<?php

declare(strict_types=1);

namespace Noitran\Patterns\Creational\Singleton\Tests;

use Noitran\Patterns\Creational\Singleton\Exceptions\CloneNotSupportedException;
use Noitran\Patterns\Creational\Singleton\Exceptions\UnserializeNotSupportedException;
use Noitran\Patterns\Creational\Singleton\Logger;
use PHPUnit\Framework\TestCase;

class LoggerTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_test_logger_instances(): void
    {
        $firstInstance = Logger::getInstance();
        $secondInstance = Logger::getInstance();

        self::assertInstanceOf(Logger::class, $firstInstance);
        self::assertSame($firstInstance, $secondInstance);
    }

    /**
     * @test
     */
    public function it_cant_be_cloned(): void
    {
        $this->expectException(CloneNotSupportedException::class);

        $instance = Logger::getInstance();
        $clonedInstance = clone $instance;
    }

    /**
     * @test
     */
    public function it_cant_be_unserialized(): void
    {
        $this->expectException(UnserializeNotSupportedException::class);

        $instance = Logger::getInstance();
        $serialized = serialize($instance);

        unserialize($serialized);
    }
}
