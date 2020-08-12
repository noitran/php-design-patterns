<?php

declare(strict_types=1);

namespace Noitran\Patterns\Creational\Singleton\Tests;

use Noitran\Patterns\Creational\Singleton\Exceptions\CloneNotSupportedException;
use Noitran\Patterns\Creational\Singleton\Exceptions\UnserializeNotSupportedException;
use PHPUnit\Framework\TestCase;
use Noitran\Patterns\Creational\Singleton\Logger;

class LoggerTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldTestLoggerInstances(): void
    {
        $firstInstance = Logger::getInstance();
        $secondInstance = Logger::getInstance();

        self::assertInstanceOf(Logger::class, $firstInstance);
        self::assertSame($firstInstance, $secondInstance);
    }

    /**
     * @test
     */
    public function itCantBeCloned(): void
    {
        $this->expectException(CloneNotSupportedException::class);

        $instance = Logger::getInstance();
        $clonedInstance = clone $instance;
    }

    /**
     * @test
     */
    public function itCantBeUnserialized(): void
    {
        $this->expectException(UnserializeNotSupportedException::class);

        $instance = Logger::getInstance();
        $serialized = serialize($instance);

        unserialize($serialized);
    }
}
